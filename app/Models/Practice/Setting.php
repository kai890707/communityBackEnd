<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\SettingModel;
use Illuminate\Support\Facades\DB;
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

    /**
     * [取得社區名稱]
     * @return array
     */
    public function getCommunityName()
    {
        $name = SettingModel::select('community_name')->where('id',1)->first(); 
        return $name;  
    }
    /**
     * [取得社區簡介]
     * @return array
     */
    public function getCommunityIntroduction()
    {
        $introduction = SettingModel::select('community_introduce')->where('id',1)->first(); 
        return $introduction;
    }
    /**
     * [取得社區圖片]
     * @return array
     */
    public function getCommunityImage()
    {
        $image = SettingModel::select('community_image')->where('id',1)->first(); 
        return $image;
    }
    /**
     * [取得footer 資料]
     */
    public function getFooter()
    {
        $res = SettingModel::select('community_name','community_host','community_contact','community_address','community_email','community_phone','community_facebook','community_instagram')->where('id',1)->first(); 
        return $res; 
    }
    /**
     * [取得Index banner 資料]
     */
    public function getIndexBanner()
    {
        $res = SettingModel::select('community_name','community_introduce','community_image')->where('id',1)->first(); 
        return $res; 
    }
     /**
     * [取得Page banner 資料]
     */
    public function getPageBanner($category_id)
    {
        $category_name = DB::table('category')
        ->select('category_name')
        ->where('id',$category_id)
        ->first();
        $res = SettingModel::select('community_name','community_image')->where('id',1)->first(); 
        $res['category_name'] = $category_name->category_name;
        return $res;
    }
 
    public function getIndexAboutUs()
    {
        $res = SettingModel::select('community_name','community_introduce','community_address','community_image','community_phone')->where('id',1)->first(); 
        return $res; 
    }
}