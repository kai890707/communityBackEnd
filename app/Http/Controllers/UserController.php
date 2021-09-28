<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Practice\UserInfo;
class UserController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }
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
}
