<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\UserInfoModel;
use DB;
class UserInfo
{
    use HasFactory;
    /**
     * [新增編輯者帳號]
     *
     * @param [String] $data
     * @return array
     */
    public static function createEditor($data)
    {
        $user = new UserInfoModel;
        $user->user_name = $data['name'];
        $user->user_account = $data['account'];
        $user->user_password = sha1($data['password']);
        $user->user_phone = $data['phone'];
        $user->user_email = $data['email'];
        $user->user_permission = 'normal';
        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }

     /**
     * [取得ADMIN帳號]
     *
     * @param 
     * @return array
     */
    public static function getAdminInfo()
    {
        $selectArray = [
            "id",
            "user_name as name",
            "user_account as account",
            "user_phone as phone",
            "user_email as email",
            "user_permission as permission"
        ];
        $query = UserInfoModel::select($selectArray)
                ->where('user_permission','admin')
                ->first();
        return $query;
        
    }

    public static function updatePassword($data)
    {
       $update = UserInfoModel::where('id',$data['id'])
                        ->update(['user_password'=>sha1($data['after'])]);
        return $update;
    }

    /**
     * [驗證密碼]
     */
    public static function vaildPassword($data)
    {
        $res = UserInfoModel::select('user_password as password')
                        ->where('id',$data['id'])
                        ->first();
        if(sha1($data['before']) !== $res['password'] || $data['after']!==$data['re-after']){
            return  false;
        }else{
            return true;
        }
    }
    /**
    * [驗證帳號是否存在]
     *
     * @param  register_info
     * @return boolean
     */
    public static function vaildAccount($data)
    {
        $res = UserInfoModel::where('user_account',$data['account'])->first(); 
        return $res; 
    }

    /**
     * [驗證帳號是否存在]
     */
    public static function  getAccountToTable()
    {
        $selectArray = [
            "id",
            "user_name as name",
            "user_account as account",
            "user_phone as phone",
            "user_email as email",
            "user_permission as permission"
        ];
        $query = UserInfoModel::select($selectArray)
                ->where('user_permission','normal')
                ->orWhere('user_permission','admin')
                ->get();
        return $query;
    }


    /**
     * 
     */
    public static function updatePermission($data)
    {
        if($data['userPermission'] == "admin" || $data['userPermission'] == "normal"){
            $update = UserInfoModel::where('id',$data['userId'])
                ->update(['user_permission'=>$data['userPermission']]);
            return $update;
        }else{
            return false;
        }
        
    }
    /**
     * 刪除USER
     */
    public static function deleteUser($data)
    { 
        $count = UserInfoModel::select('user_permission')->where('id',  $data['userId'])->get();
        if($count[0]['user_permission'] !== "admin"){
            $deletedRows = UserInfoModel::where('id',  $data['userId'])->delete();
            return ['status'=>true,'data'=>$deletedRows]; 
        }else{
             return ['status'=>false]; 
        }
       
    }

    /**
     * 取得剩餘的ADMIN帳號數量
     */
    // public static function getUserCount(){
    //     $count = UserInfoModel::where('user_permission','admin')->get();
    //     return $count;
    // }
}