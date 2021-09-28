<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;
use App\Models\Verify\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // $acc = $request->input('account');
        // $pass = $request->input('password');

        // $re = $this->user_model->checkUser($acc,$pass);
        // if(!$re){
        //     return response()->json('incorrect', 422);
        // }
        // return $this->createNewToken(JWTAuth::fromUser($re));
        
        $input = $this->decodeArray($request->input('data'));
        $messages = [
            'account.required' => '帳號欄位未填寫',
            'password.required' => '密碼欄位未填寫',
        ];
        $validator = Validator::make($input, [
            'account' => 'bail|required|string',
            'password' => 'bail|required|string',
        ], $messages);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()->all(),
            ];
            return response()->json($response, 403);
        } else {
            $result = Auth::checkUser($input['account'], $input['password']);
            if (count((array) $result) == 0) {
                return response()->json([
                    'success' => false,
                    'message' => '帳號密碼錯誤',
                ], 403);
            } else {
                return response()->json([
                    'success' => true,
                    'token' => JWTAuth::fromUser($result),
                    // 'u_id' => Hashids::encode($result->personal_info_id)
                ], 200);
            }
        }
    }
    /**
     * [JW取得all資訊]
     *
     * @param Request $request
     * @return void
     */
    public function me(Request $request)
    {
        // $user = JWTAuth::parseToken()->authenticate();
        $token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token);
        $user = JWTAuth::authenticate($token);
        return response()->json([
            'success' => true,
            'data' => $user,
            'ip' => $request->ip(),
            'payload' => $payload,
            // 'timeout' => date("Y-m-d H:i:s", $payload['exp'])
        ], 200);
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }
    public function ww(Request $request)
    {
        return 1;
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 1
        ]);
    }
}
