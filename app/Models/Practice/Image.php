<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\PostImageModel;
use App\Models\Entity\PostModel;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\File;
use DB;
class Image
{
    use HasFactory;
    /**
     * [新增輪播圖片於資料表]
     *
     * @param [String,String] 圖片路徑,文章ID
     * @return array
     */
    public function uploadImage($fileName,$postID)
    {
        $image = new PostImageModel;
        $image->pageImage_name = 'uploads/'.$fileName;
        $image->pageId = $postID;
        if ($image->save()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * [清除圖片關聯]
     *
     * @param [String,String] 文章ID
     * @return array
     */
    public function initImageRelation($pageId)
    {
        $a = PostImageModel::where('pageId',$pageId)->get();
        foreach($a as $b ){
            if(File::exists($b['pageImage_name'])){
                unlink($b['pageImage_name']);
            }
        }
        try {
            $query =PostImageModel::where('pageId',$pageId)
            ->delete();
            $res = true;
        } catch(Exception $e) {
            $res = false;
        }
       
        return $res;
    }

}
