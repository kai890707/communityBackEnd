<?php

namespace App\Models\Verify;
use App\Models\Entity\AuthModel;
use DB;

class Auth
{
    public static function checkUser($account,$password)
    {
        $user = AuthModel::where('user_account',$account)->where('user_password',sha1($password))->first();
        return $user;
    }
}
