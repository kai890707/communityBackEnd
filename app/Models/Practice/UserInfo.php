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
    public static function createUserAccount($data)
    {
        $user = new UserInfoModel;
        $user->user_name = $data['name'];
        $user->user_account = $data['account'];
        $user->user_password = $data['password'];
        $user->user_phone = $data['phone'];
        $user->user_email = $data['email'];
        $user->user_permission = 1;
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
}
