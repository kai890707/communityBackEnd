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
use Carbon\Carbon;
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
        $result = $this->post_model->getAllList();
        foreach($result as $array){
            if($array['status']=="T"){
                $array['status']="已發佈";
            }
            Carbon::setLocale('tw');
            $now = Carbon::now();
            $timestamp = '2021-09-09 17:34:00';
            // $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp,'Asia/Taipei');
            // $date->setTimezone('Asia/Taipei');
            $array['dd'] =Carbon::now()->toDateString('Y-m-d H:i:s');
            // $array['created_at'] =  Carbon::createFromFormat('Y-m-d H:i:s', $array['created_at']);
            // $array['updated_at'] = Carbon::parse($array['updated_at']);
            // $array['created'] = Carbon::parse($array['created_at'])->format('Y-m-d H:m:s');
            // $array['updated'] = Carbon::parse($array['updated_at'])->format('Y-m-d H:m:s');
            $array['created'] = Carbon::parse($array['created_at'])->format('Y-m-d');
            $array['updated'] = Carbon::parse($array['updated_at'])->format('Y-m-d');
        }
        return response()->json([
            'status'=>$this::$REQUEST_SUCCESS,
            'data'=>$result
        ]);
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
            return response()->json([
                'status'=>$this::$REQUEST_SUCCESS,
            ]);
        }else{
            return response()->json([
                'status'=>$this::$REQUEST_ERROR,
            ]);
        }
        
    }
   
}
