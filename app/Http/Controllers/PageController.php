<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Practice\UserInfo;
use App\Models\Practice\Setting;
use App\Models\Practice\FrontPost;
use App\Models\Practice\Category;
use Exception;
class PageController extends Controller
{
    public $setting_model;
    public $post_model;
    public $category_model;
    public function __construct()
    {
        $this->setting_model = new Setting;
        $this->post_model = new FrontPost;
        $this->category_model = new Category;
    }

    /**
     * [取得首頁資料]
     *  @return object
     */
    public function getIndexData()
    {
        $communityName = $this->setting_model->getCommunityName();
        $nav = $this->getNavData();
        $banner = $this->getIndexBanner();
        $main = $this->getIndexMain();
        $footer = $this->getFooter();
        $data=[
            "name"=>$communityName['community_name'],
            "pageData"=>[
                "Nav"=>$nav,
                "Banner"=>$banner,
                "Main"=>$main,
                "Footer"=>$footer

            ]
            ];
        return $data;
    }

    /**
     * [取得Nav]
     * @return object
     */
    public function getNavData()
    {
        $communityName = $this->setting_model->getCommunityName();
        $data = [
           
                "data"=>[
                    "title"=>$communityName['community_name'],
                    "list"=>[
                        [
                            "name"=>"首頁",
                            "path"=>"/"
                        ],
                        [
                            "name"=>"社區特色",
                            "path"=>"/社區特色"
                        ],
                        [
                            "name"=>"社區公告",
                            "path"=>"/社區公告"
                        ],[
                            "name"=>"社區景點",
                            "path"=>"/社區景點"
                        ],
                        [
                            "name"=>"社區特產",
                            "path"=>"/社區特產"
                        ]
                    ]
                ]
            
        ];
        return $data;
    }
    /**
     * [取得Footer]
     * @return object
     */
    public function getFooter()
    {
        $community = $this->setting_model->getFooter();
        $data = [
           
                "data"=>[
                   "contact"=>[
                       "name"=>$community['community_name'],
                       "directorName"=>$community['community_host'],
                       "secretary"=>$community['community_contact'],
                       "address"=>$community['community_address'],
                       "email"=>$community['community_email'],
                       "phone"=>$community['community_phone'],
                       "facebook"=>$community['community_facebook'],
                       "instagram"=>$community['community_instagram'],
                   ]
                ]
            
        ];
        return $data;
    }
    /**
     * [取得首頁Banner]
     *  @return object
     */
   public function getIndexBanner()
   {
    $community = $this->setting_model->getIndexBanner();
    $data = [
    
            "data"=>[
                "name"=>$community['community_name'],
                "Introduction"=>$community['community_introduce'],
                "image"=>url('/').DIRECTORY_SEPARATOR.$community['community_image']
            ]
        
    ];
    return $data;
   }
   /**
     * [取得頁面Banner，透過分類編號取得不同頁面資訊]
     *  @param category_id
     *  @return object
     */
    public function getPageBanner($category_id)
    {
        $community = $this->setting_model->getPageBanner($category_id);

        $data = [
     
             "data"=>[
                 "name"=>$community['community_name']."-".$community['category_name'],
                 "image"=>url('/').DIRECTORY_SEPARATOR.$community['community_image']
             ]
         
        ];
     return $data;
    }
    /**
     * [取得貼文Banner，透過文章編號取得不同頁面資訊]
     *  @param category_id
     *  @return object
     */
    public function getDetailBanner($post_id)
    {
        $community = $this->post_model->getDetailBanner($post_id);

        $data = [
     
             "data"=>[
                 "name"=>$community[0]['page_title'],
                 "image"=>url('/').DIRECTORY_SEPARATOR.$community['img']
             ]
         
        ];
     return $data;
    }
   /**
    * [取得首頁Main]
    * @return object
    */
   public function getIndexMain()
   {
        $news =  $this->post_model->getIndexPost();
        foreach($news as $re){
            if($re['page_chosen']==""){
                $re['page_chosen'] = url('/').DIRECTORY_SEPARATOR."default/default.jpg";
            }else{
                $re['page_chosen'] = url('/').DIRECTORY_SEPARATOR.$re['page_chosen'];
            }
           
        }
        $community = $this->setting_model->getIndexAboutUs();
        $data = [
     
                "data"=>[
                   "news"=> $news,
                    "aboutUs"=>[
                        "name"=>$community['community_name'],
                        "Introduction"=>$community['community_introduce'],
                        "image"=>url('/').DIRECTORY_SEPARATOR.$community['community_image'],
                        "address"=>$community['community_address'],
                        "phone"=>$community['community_phone'],
                    ]
                ]
            
        ];
         return  $data;
   }
   /**
    * [取得頁面Main]
    * @param category_id
    * @return object
    */
    public function getPageMain($category_id)
    {
         $news =  $this->post_model->getPagePost($category_id);
         $categoryName = $this->category_model->getCategoryName($category_id);
        foreach($news as $re){
            if(empty($re['page_chosen'])){
                $re['page_chosen'] = url('/').DIRECTORY_SEPARATOR."default/default.jpg";
            }else{
                $re['page_chosen'] = url('/').DIRECTORY_SEPARATOR.$re['page_chosen'];
            }
            $re['href']= $categoryName.DIRECTORY_SEPARATOR.$re['id'];
        }
         $data = [
      
                 "data"=>[
                    "news"=> $news
                 ]
             
         ];
          return  $data;
    }
    /**
    * [取得頁面Main]
    * @param category_id
    * @return object
    */
    public function getDetailMain($post_id)
    {
         $news =  $this->post_model->getPostDetail($post_id);
         $image = $this->post_model->getPostDetailImage($post_id);
        //  $categoryName = $this->category_model->getCategoryName($post_id);

            if(empty($news['page_chosen'])){
                $news['page_chosen'] = url('/').DIRECTORY_SEPARATOR."default/default.jpg";
            }else{
                $news['page_chosen'] = url('/').DIRECTORY_SEPARATOR.$news['page_chosen'];
            }
            // $re['href']= $categoryName.DIRECTORY_SEPARATOR.$re['id'];
        foreach($image as $re){
            $re['image'] = url('/').DIRECTORY_SEPARATOR.$re['image'] ;
        }
        $news['images'] =  $image ;
         $data = [
                 "data"=>
                    $news
         ];
          return  $data;
    }
   /**
    * [取得社區公告頁面]
    * @return object
    */
    public function getNewsPage($category_id)
    {
        $communityName = $this->setting_model->getCommunityName();
        $nav = $this->getNavData();
        $banner = $this->getPageBanner($category_id);
        $main = $this->getPageMain($category_id);
        $footer = $this->getFooter();
        $data=[
            "name"=>$communityName['community_name'],
            "pageData"=>[
                "Nav"=>$nav,
                "Banner"=>$banner,
                "Main"=>$main,
                "Footer"=>$footer

            ]
            ];
        return $data; 
    }
    /**
    * [取得社區公告頁面]
    * @return object
    */
    public function getNewsDetailPage($post_id)
    {
        $communityName = $this->setting_model->getCommunityName();
        $nav = $this->getNavData();
        $banner = $this->getDetailBanner($post_id);
        $main = $this->getDetailMain($post_id);
        $footer = $this->getFooter();
        $data=[
            "name"=>$communityName['community_name'],
            "pageData"=>[
                "Nav"=>$nav,
                "Banner"=>$banner,
                "Main"=>$main,
                "Footer"=>$footer

            ]
            ];
        return $data; 
    }
    /**
     * 下載說明書
     */
    public function downloadPPT()
    {
        // $file= public_path(). "/files/education2.pptx";

        // $headers = array(
        //         'Content-Type: application/pdf',
        //         );

        // return Response::download($file, 'education2.pptx', $headers);
        // $file_path = public_path('/files/education2.pptx');
        // return response()->download($file_path);
        return response()->file('files/education2.pptx');
    }
}