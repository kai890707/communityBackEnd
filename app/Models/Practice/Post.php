<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\PostModel;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;
class Post
{
    use HasFactory;


    /**
     * [後台取得所有文章]
     *
     * @param [String] $data
     * @return Array
     */
    public static function getAllList()
    {
        $selectArray=[
            "page.id as id",
            "page.page_title as title",
            "page.page_status as status",
            "page.created_at as created_at",
            "page.updated_at as updated_at",
            "category.category_name as category_name"
        ];
        $query = PostModel::select($selectArray)
                ->join('category', 'category.id', '=', 'page.category_id')
                ->where('page.category_id',1)
                ->get();
        
        return $query;
        
    }
    /**
     * [後台取得各文章列表]
     *
     * @param [String] category_ids
     * @return Array
     * id 1	社區公告
       id 2	社區特色
       id 3	社區特產
       id 4	社區景點
     */
    public function getAllListByCategory($categoryId)
    {
        $selectArray=[
            "page.id as id",
            "page.page_title as title",
            "page.page_status as status",
            "page.created_at as created_at",
            "page.updated_at as updated_at",
            "category.category_name as category_name"
        ];
        $query = PostModel::select($selectArray)
        ->join('category', 'category.id', '=', 'page.category_id')
        ->where('page.category_id',$categoryId)
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
        $post->category_id = $data['category_id'];
        $post->page_chosen ="";
        $post->created_at = now();
        $post->updated_at = now();
        if ($post->save()) {
            return $post->id;
        } else {
            return false;
        }
    }
    /**
     * [後台取得文章資訊]
     *
     * @param [String] pageID文章ID
     * @return array
     */
    public static function getPostToEditById($pageId)
    {
        $selectArray=[
            "page.id as id",
            "page.page_title as title",
            "page.page_status as status",
            "page.page_content as content",
            "page.page_chosen as chosen",
        ];
        $query = PostModel::select($selectArray)
                // ->join('pageImage', 'page.id', '=', 'pageImage.pageId')
                ->where('page.id',$pageId)
                ->first();
        return $query;
    }
    /**
     * [後台取得文章照片]
     *
     * @param [String] pageID文章ID
     * @return array
     */
    public static function getPostImgToEditById($pageId)
    {
        $selectArray=[
            "pageImage_name as img",
        ];
        $query = DB::table('pageImage')
                ->select($selectArray)
                ->where('pageId',$pageId)
                ->get();
        return $query;
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

    /**
     * [更新文章資訊]
     * @param [Array] 文章資料
     * @return void
     */
    public function updatePost($data)
    {
        
        $query = PostModel::where('id',$data['postId'])
                ->update([
                    "page_title"=>$data['title'],
                    "page_content"=>$data['content'],
                    "page_status"=>$data['status'],
                    "category_id"=>1,
                    "created_at"=>now(),
                    "updated_at"=>now(),
                ]);
        return $query;
    }
    /**
     * [刪除文章]
     * @param [String] 文章id
     * @return void
     */
    public function deletePost($pageId)
    {

        try {
            $query = PostModel::find($pageId);
            $query->delete();
            $res = true;
        } catch(Exception $e) {
            $res = false;
        }
       
        return $res;
    }
}
