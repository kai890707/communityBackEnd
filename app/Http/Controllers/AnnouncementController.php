<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Form\ImageValidation;
use App\Models\Form\PostValidation;
use App\Models\Practice\Post;
use App\Models\Practice\Image;
use App\Models\Practice\Category;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;

class AnnouncementController extends Controller
{
    public $post_model;
    public $image_model;
    public $category_model;
    public function __construct()
    {
        $this->post_model = new Post;
        $this->image_model = new Image;
        $this->category_model = new Category;
    }
    /**
   * [取得所有文章列表]
   */
    public function getAllList()
    {
        try{
            $result = $this->post_model->getAllList();
            foreach($result as $array){
                if($array['status']=="T"){
                    $array['status']="已發佈";
                }
            }
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
                'data'=>$result,
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
        }
       
        
    }
    /**
   * [以分類取得所有文章列表]
   * 
   */
    public function getAllListByCategory($category_id)
    {
        
        try{
            $result = $this->post_model->getAllListByCategory($category_id);
            foreach($result as $array){
                if($array['status']=="T"){
                    $array['status']="已發佈";
                }
            }
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
                'data'=>$result,
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
        }
    }
    /**
     * [以文章ID取得社區公告資料]
     * @param Request $request
     * @return {$REQUEST_SUCCESS(1)=>成功,$REQUEST_ERROR(0)=>失敗}
     */
    public function getPostToEditById($id)
    {
        try{
            $info = $this->post_model->getPostToEditById($id);
            $img = $this->post_model->getPostImgToEditById($id);
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
                'data'=>$info,
                'img'=>$img
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
                'data'=>$info,
                'img'=>$img
            ]); 
        }
    }
    /**
     * [新增社區公告
     * 取得所有資訊，驗證文字後驗證圖片
     * 再將文章新增，取得文章ID後將圖片塞入對應文章
     * ]
     * @param Request $request
     * @return {$REQUEST_SUCCESS(1)=>成功,$REQUEST_ERROR(0)=>失敗,$REQUEST_VERIFY_FAILD(3)=>驗證失敗}
     */
    public function add(Request $request)
    {
        $data = $request->all();
        $form = new PostValidation($data);
        if ($form->isValid()) {
            return response()->json([
                'status'=>$this::$REQUEST_VERIFY_FAILD,
                'message'=>$form->getErrors()
            ]);
        }
        $form = new ImageValidation($request->file());
        if ($form->isValid()) {
            return response()->json([
                'status'=>$this::$REQUEST_VERIFY_FAILD,
                'message'=>$form->getErrors()
            ]);
        }
        $addPostResult = $this->post_model->addNewPost($data); //獲取文章ID
        if($addPostResult){
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $location = 'uploads';//資料夾
                $file->move($location,$filename);
                $this->post_model->uploadChosenImage($filename,$addPostResult);
            }
            if($request->has('carousel')){
                foreach ($request->file('carousel') as $index => $file) {
                    $filename = $index.time().'.'.$file->getClientOriginalExtension();
                    $location = 'uploads';
                    $file->move($location,$filename);
                    $this->image_model->uploadImage($filename,$addPostResult);
                }
            }
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
            ]);
        }else{
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
        }
        
    }
    /**
     * [修改社區公告 ]
     * @param Request $request
     * @return {$REQUEST_SUCCESS(1)=>成功,$REQUEST_ERROR(0)=>失敗,$REQUEST_VERIFY_FAILD(3)=>驗證失敗}
     */
    public function edit(Request $request)
    {
        $data = $request->all();
        $form = new PostValidation($data);
        if ($form->isValid()) {
            return response()->json([
                'status'=>$this::$REQUEST_VERIFY_FAILD,
                'message'=>$form->getErrors()
            ]);
        }
        $form = new ImageValidation($request->file());
        if ($form->isValid()) {
            return response()->json([
                'status'=>$this::$REQUEST_VERIFY_FAILD,
                'message'=>$form->getErrors()
            ]);
        }
        /**圖片關聯初始化 */
        $resultWithDelImg =  $this->image_model->initImageRelation($data['postId']);
        $result = $this->post_model->updatePost($data);
        /**添加圖片關聯進DB */
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = 'uploads';//資料夾
            $file->move($location,$filename);
            $this->post_model->uploadChosenImage($filename,$data['postId']);
        }
        if($request->has('carousel')){
            foreach ($request->file('carousel') as $index => $file) {
                $filename = $index.time().'.'.$file->getClientOriginalExtension();
                $location = 'uploads';
                $file->move($location,$filename);
                $this->image_model->uploadImage($filename,$data['postId']);
            }
        }
        if($result){
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
            ]);
        }else{
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
        }
    }
     /**
     * [刪除社區公告 ]
     * @param Request $request
     * @return {$REQUEST_SUCCESS(1)=>成功,$REQUEST_ERROR(0)=>失敗,$REQUEST_VERIFY_FAILD(3)=>驗證失敗}
     */
    public function delete(Request $request)
    {
        $data = $request->all();
        $imgDelResult =  $this->image_model->initImageRelation($data['pageId']);
        $postDelResult =  $this->post_model->deletePost($data['pageId']);
        
        if($imgDelResult && $postDelResult){
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
            ]);
        }else{
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
        }
       
    }
    /**
     * [取得圖片實體]
     */
    public function getImg($img_name)
    {
        // dd(response()->file($img_name));
        return response()->file('uploads/'.$img_name);
    }

    /**
     * [取得所有分類]
     */
    public function getCategory()
    {
        
        try{
            $res = $this->category_model->getCategory();
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
                'data'=> $res
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
        }
        
    }
}
