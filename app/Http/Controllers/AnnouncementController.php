<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Form\ImageValidation;
use App\Models\Form\PostValidation;
use App\Models\Practice\Post;
use App\Models\Practice\Image;
use Illuminate\Support\Facades\Validator;
class AnnouncementController extends Controller
{
    public $post_model;
    public $image_model;
    public function __construct()
    {
        $this->post_model = new Post;
        $this->image_model = new Image;
    }
    /**
   * [取得所有文章列表]
   */
    public function getAllList()
    {
        try {
            $p_id = $this->getJWTUserId();
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'token expired',
            ], 401);
        }
        return response()->json([
                'status' => 1,
                'data' =>$p_id,
            ]);
    }
    /**
     * [新增社區公告]
     * @param Request $request
     * @return void
     */
    public function add(Request $request)
    {
        $data = $request->all();
        $form = new PostValidation($data);
        if ($form->isValid()) {
            return response()->json([
                $form->getErrors()
            ]);
        }
        $form = new ImageValidation($request->file());
        if ($form->isValid()) {
            return response()->json([
                $form->getErrors()
            ]);
        }
        $addPostResult = $this->post_model->addNewPost($data); //獲取文章ID
        if($addPostResult){
            if ($request->hasFile('img')) {
                
                $file = $request->file('img');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $location = 'uploads';//資料夾
                $file->move($location,$filename);
                $r = $this->post_model->uploadChosenImage($filename,$addPostResult);
            }
            if($request->has('carousel')){
                foreach ($request->file('carousel') as $file) {
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'uploads';
                    $file->move($location,$filename);
                    $this->image_model->addImage($filename,$addPostResult);
                }
              
            
            }
        }
        
    }
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $form = new ImageValidation($request->file());
            if ($form->isValid()) {
                return response()->json([
                    $form->getErrors()
                ]);
            }

            $upload_path = public_path('uploads');
            $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move($upload_path, $generated_new_name);

            // $id = $this->getJWTUserId();
            // $result = UserNews::setImg($id, $generated_new_name);
            // if ($result) {
            //     $info_id = Hashids::encode($id);
            //     if (Cache::has("info-$info_id")) {
            //         $info = Cache::get("info-$info_id");
            //         $info['user_img'] = url('/').'/uploads/'.$generated_new_name;
            //         Cache::put("info-$info_id", $info);
            //     }
                return response()->json([
                    'status' => 1,
                    'path' => url('/').'/uploads/'.$generated_new_name,
                    'aaa' => $upload_path
                ]);
            // } else {
            //     return response()->json([
            //         'status' => 0,
            //     ]);
            // }
        }
    }
   
}
