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
}
