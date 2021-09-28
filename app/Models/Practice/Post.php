<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\PostModel;
use DB;
class Post
{
    use HasFactory;
    /**
     * [新增文章]
     *
     * @param [String] $data
     * @return post_id
     */
    public static function addNewPost($data)
    {
        $post = new PostModel;
        $post->page_title = $data['title'];
        $post->page_content = $data['content'];
        $post->page_status = $data['status'];
        $post->category_id = 1;
        $post->page_chosen ="";
        if ($post->save()) {
            return $post->id;
        } else {
            return false;
        }
    }
    /**
     * [新增精選圖片]
     *
     * @param [String,String] 圖片路徑,文章ID
     * @return array
     */
    public function uploadChosenImage($fileName,$postID)
    {
       $query =  PostModel::where('id',$postID)
                ->update(['page_chosen'=>'uploads/'.$fileName]);
        return $query;
    }
}
