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
    public function createEditor(Request $request)
    {
        $data = $request->all();
        $hasAccount = UserInfo::vaildAccount($data);
        if(count((array) $hasAccount) !== 0){
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
                'd'=>$hasAccount
            ]);
        }else{
            $isCreate = UserInfo::createEditor($data);
            if($isCreate){
                return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
                ]);
            }else{
                return response()->json([
                'status'=>$this::$REQUEST_ERROR,
                'd'=>0
            ]);
            }
        }
        
      
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

    /**
     * 取得編輯者帳號
     * @return object
     */
    public function getAccountToTable()
    {
        $result = UserInfo::getAccountToTable();
        
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
     * 
     */
    public function updatePermission(Request $request)
    {
        $data = $request->all();
      
        try{
            $result = UserInfo::updatePermission( $data );
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
                'r'=>$result
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
                'message'=>$e
            ]);
        }
    }

    public function deleteUser(Request $request)
    {
        $data = $request->all();
       
            if($data['userPermission']=="admin"){
                try{
                    $result = UserInfo::deleteUser( $data );
                    if($result['status']){
                        return response()->json([
                            'status'=>$this::$REQUEST_SUCCESS,
                            'r'=>$result
                        ]);
                    }else{
                        return response()->json([
                            'status'=>$this::$REQUEST_ADMIN_DEFAULT,
                            'message'=>'網站管理員無法刪除'
                        ]);
                    }
                }catch(Exception $e){
                    return response()->json([
                        'status'=>$this::$REQUEST_ERROR,
                        'message'=>$e
                    ]);
                }
                
            }else{
                return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
            }
        
        
            
        
        
    }
}