<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\PostImageModel;
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
    public static function addImage($fileName,$postID)
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
}
