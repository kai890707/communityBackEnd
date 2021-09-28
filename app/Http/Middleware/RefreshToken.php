<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
// use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
// use Tymon\JWTAuth\Exceptions\TokenExpiredException;
// use Tymon\JWTAuth\Exceptions\TokenInvalidException;
class RefreshToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next) {

        $this->checkForToken($request); // 檢查 request header access token
        try {
            if ($this->auth->parseToken()->authenticate()) { // check user
                return $next($request); // 驗證有效 request success
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $b) { // token驗證失敗
            return response()->json([
                'status' => 2,
                'message' => '未登入的狀態，請重新登入！',
            ], 403);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $t) { // token 已過期 == 使用者未登入
            $payload = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray();
            $key = 'block_refresh_token_for_user_' . $payload['sub'];
            $cachedBefore = (int) Cache::has($key); //在Cache確認token 驗證編號是否存在
            /**
             * JWT_BLACKLIST_GRACE_PERIOD(在config/jwt.php的設定參數)
             * 意思是說如果在這個參數規定的秒數內重複 request 那通過第一次 第二次不通過(因為我已經發過一次最新的token)
             */
            if ($cachedBefore) {
                \Auth::onceUsingId($payload['sub']); // 使用一次性登錄以保證此次請求的成功
                return response()->json([
                    'status' => 0,
                    'message' => 'Server已經發送新的授權書，目前授權已過期，請先刷新Token！',
                ], 401);
            }
            try {
                $newtoken = $this->auth->refresh();
                $gracePeriod = $this->auth->manager()->getBlacklist()->getGracePeriod();
                $expiresAt = Carbon::now()->addSeconds($gracePeriod);
                Cache::put($key, $newtoken, $expiresAt);
            } catch (JWTException $e) {
                // 如果捕獲到此異常，代表 refresh 也過期了，無法刷新令牌，需要重新登錄
                return response()->json([
                    'status' => 2,
                    'message' => '授權登入時間過期！請再次重新登入！！',
                ], 403);
            }
        }
        return response()->json([
            'status' => 2,
            'message' => '登入時效已過，請重新登入！',
        ], 401)
        ->header('Access-Control-Expose-Headers', 'authorization')
        ->header('Authorization', $newtoken);
        // return response('', 401)
        //         ->header('Access-Control-Expose-Headers', 'authorization')
        //         ->header('Authorization', $newtoken);

    }
}