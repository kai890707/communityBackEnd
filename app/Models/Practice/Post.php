<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\PostModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Post
{
    use HasFactory;


    /**
     * [後台取得所有文章]
     *
     * @param [String] $data
     * @return post_id
     */
    public static function getAllList()
    {
        $selectArray=[
            "page.id as id",
            "page.page_title as title",
            "page.page_status as status",
            // DB::raw ("DATE_FORMAT(page.created_at,'%d-%m-%Y') as  created_at"),
            // DB::raw ("DATE_FORMAT(page.updated_at,'%d-%m-%Y') as  updated_at"),
            "page.created_at as created_at",
            "page.updated_at as updated_at",
            "category.category_name as category_name"
        ];
        $query = PostModel::select($selectArray)
                ->join('category', 'category.id', '=', 'page.category_id')
                ->get();
        
        return $query;
        
    }

    /**
     * [後台新增文章]
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
     * [後台新增精選圖片]
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
