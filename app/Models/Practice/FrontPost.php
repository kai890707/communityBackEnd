<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\PostImageModel;
use App\Models\Entity\PostModel;
use App\Models\Entity\SettingModel;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
class FrontPost
{
    use HasFactory;
    
    /**
     * 取得3篇文章至首頁
     */
    public function getIndexPost()
    {
        $res = PostModel::select('id','page_title','page_content','page_chosen')
                        ->where('page_status',"T")
                        ->orderBy('created_at','desc')
                        ->where('category_id',1)
                         ->limit(3)->get();  
        return $res;
    }
    /**
     * 取得3篇文章至首頁
     */
    public function getPagePost($category_id)
    {
        // $category_name = DB::table('category')->select('category_name')->where('id',$category_id)->first();
        $res = PostModel::select('id','page_title','page_content','page_chosen','created_at')
                        ->where('page_status',"T")
                        ->where('category_id',$category_id)
                        ->orderBy('created_at','desc')
                         ->get();  
        // $res['category_name']=$category_name->category_name;
        return $res;
    }
    /**
     * [取得Page banner 資料]
     */
    public function getDetailBanner($post_id)
    {
        $res = PostModel::select('page_title')
        ->where('id',$post_id)
         ->get();
        $img = SettingModel::select('community_image')->where('id',1)->first();   
        $res['img'] = $img->community_image;
        return $res;
    }


    /**
     * 取得文章內容
     */
    public function getPostDetail($post_id)
    {
        $res = PostModel::select('id','page_title','page_content','page_chosen','created_at')
                        ->where('id',$post_id)
                        ->first();  

        return $res;
    }

    /**
     * 取得文章關聯圖片
     */
    public function getPostDetailImage($post_id)
    {
        $res = PostImageModel::select('id','pageImage_name as image')
        ->where('pageId',$post_id)
        ->get();  
        return $res;
    }
}
