<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\SettingModel;
use DB;
class Setting
{
    use HasFactory;



    /**
     * [取得網站設定]
     * @return array
     */
    public static function getConfig()
    {
        $r = SettingModel::first();
        return $r;
    }

    /**
     * [修改網站設定]
     * @return array
     */
    public static function updateConfig($data)
    {
        if(isset($data['filename'])){
            $updateArray = [
            "community_name"=>$data['name'],
            "community_address"=>$data['address'],
            "community_host"=>$data['host'],
            "community_contact"=>$data['contact'],
            "community_phone"=>$data['phone'],
            "community_email"=>$data['email'],
            "community_facebook"=>$data['facebook'],
            "community_instagram"=>$data['instagram'],
            "community_introduce"=>$data['introduce'],
            "community_image"=>$data['filename'],
            "updated_at"=>now() 
        ];
        }else{
            $updateArray = [
            "community_name"=>$data['name'],
            "community_address"=>$data['address'],
            "community_host"=>$data['host'],
            "community_contact"=>$data['contact'],
            "community_phone"=>$data['phone'],
            "community_email"=>$data['email'],
            "community_facebook"=>$data['facebook'],
            "community_instagram"=>$data['instagram'],
            "community_introduce"=>$data['introduce'],
            "community_image"=>"",
            "updated_at"=>now() 
        ];
        }
        
        $r = SettingModel::where('id',1)->update($updateArray);
        return $r;
    }
}