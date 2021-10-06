<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Practice\UserInfo;
use App\Models\Practice\Setting;
use App\Models\Practice\FrontPost;
use Exception;
class PageController extends Controller
{
    public $setting_model;
    public $post_model;
    public function __construct()
    {
        $this->setting_model = new Setting;
        $this->post_model = new FrontPost;
    }


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
                   ]
                ]
            
        ];
        return $data;
    }
   public function getIndexBanner()
   {
    $community = $this->setting_model->getIndexBanner();
    $data = [
    
            "data"=>[
                "name"=>$community['community_name'],
                "Introduction"=>$community['community_introduce'],
                "image"=>$community['community_image']
            ]
        
    ];
    return $data;
   }
   public function getIndexMain()
   {
        $news =  $this->post_model->getIndexPost();
        $community = $this->setting_model->getIndexAboutUs();
        $data = [
     
                "data"=>[
                   "news"=> $news,
                    "aboutUs"=>[
                        "name"=>$community['community_name'],
                        "Introduction"=>$community['community_introduce'],
                        "image"=>$community['community_image'],
                        "address"=>$community['community_address'],
                        "phone"=>$community['community_phone'],
                    ]
                ]
            
        ];
         return  $data;
   }
    // public function getIndexAboutUs()
    // {
        
    //     $data = [
    //         "aboutUs"=>[
    //             "name"=>$community['community_name'],
    //             "Introduction"=>$community['community_introduce'],
    //             "image"=>$community['community_image'],
    //             "address"=>$community['community_address'],
    //             "phone"=>$community['community_phone'],
    //         ]
    //     ];
    //     return $data;
    // }
}