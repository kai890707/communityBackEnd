<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Entity\SettingModel;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BASEMODULE=array(
            [
                "module"=>"BASE",
                "setting"=>"community_name",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
                "module"=>"BASE",
                "setting"=>"community_address",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
                "module"=>"BASE",
                "setting"=>"community_host",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
                "module"=>"BASE",
                "setting"=>"community_contact",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
                "module"=>"BASE",
                "setting"=>"community_phone",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
                "module"=>"BASE",
                "setting"=>"community_email",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
                "module"=>"BASE",
                "setting"=>"community_facebook",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
                "module"=>"BASE",
                "setting"=>"community_instagram",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
                "module"=>"BASE",
                "setting"=>"community_introduce",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
                "module"=>"BASE",
                "setting"=>"community_image",
                "value"=>"",
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            );
            SettingModel::insert($BASEMODULE);
    }
}
