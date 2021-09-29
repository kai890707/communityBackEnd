<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use JWTAuth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * [靜態變數 請求Response Code]
     */
    public static $REQUEST_LOGIN_SUCCESS = "SUCCESS";
    public static $REQUEST_LOGIN_ERROR = "ERROR";
    public static $REQUEST_SUCCESS = 1;
    public static $REQUEST_ERROR = 0;
    public static $REQUEST_VERIFY_FAILD = 3;
    /**
     * [公用方法 json格式轉物件再轉陣列]
     *
     * @param [String] $data
     * @return array
     */
    public function decodeArray($data) {
        return (array)json_decode($data);
    }
    /**
     * [公用方法 引入 HTMLPurifier 再過濾 Request]
     *
     * @param array $array
     * @return array
     */
    public function xss(array $array) {
        foreach ($array as &$value){
			if(is_array($value)){
				$value = clean($value);
			}else{
				$value = clean($value);
			}
		}
        return $array;
    }
      /**
     * [公用方法 取得JWT資訊]
     *
     * @return object
     */
    public function getJWTUser() {
        $token = JWTAuth::getToken();
        return JWTAuth::authenticate($token);
    }
    /**
     * [公用方法 取得JWT的user主鍵]
     *
     * @return String user.id
     */
    public function getJWTUserId() {
        $token = JWTAuth::getToken();
        return JWTAuth::authenticate($token)["id"];
    }
}
