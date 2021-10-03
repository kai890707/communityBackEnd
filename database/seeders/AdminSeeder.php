<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Entity\UserInfoModel;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ADMIN=array(
            [
            "user_name"=>"l0726",
            "user_account" =>  "l0726",
            "user_password" =>sha1("l07260726l"),
            "user_phone" =>"",
            "user_email" =>"s18113223@stu.edu.tw",
            "user_permission" =>"root",
            "created_at" => now(),
            "updated_at" => now(),
            ]
        );
        UserInfoModel::insert($ADMIN);
    }
}
