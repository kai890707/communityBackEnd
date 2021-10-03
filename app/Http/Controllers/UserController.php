<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Practice\UserInfo;
use Exception;
class UserController extends Controller
{

    /**
     * [新增編輯者帳號]
     *
     * @return object
     */
    public function createUserAccount(Request $request)
    {
        $input = $this->decodeArray($request->input('data'));
        $r = UserInfo::createUserAccount($input);
        return response()->json([
            'success'=>$r
        ]);
    }
    /**
     * [取得網站管理員帳號資訊]
     *
     * @return object
     */
    public function getAdminInfo()
    {
        $result = UserInfo::getAdminInfo();
        if(count((array) $result) == 0){
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
        }else{
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
                'data'=>$result,
            ]);
        }
        
    }
    /**
     * [更換密碼]
     *
     * @return object
     */
    public function updatePassword(Request $request)
    {
        $data = $request->all();
        $vaildPassword = UserInfo::vaildPassword($data);
        if($vaildPassword){
            try{
                $result = UserInfo::updatePassword($data);
                return response()->json([
                    'status'=>$this::$REQUEST_SUCCESS,
                    'r'=>$data
                ]);
            }catch(Exception $e){
                return response()->json([
                    'status'=>$this::$REQUEST_ERROR,
                    'message'=>$e
                ]);
            }
        }else{
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
                'd'=>$data
            ]);
        }
        
    }
}
