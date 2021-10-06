<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\PostImageModel;
use App\Models\Entity\PostModel;
use App\Models\Entity\SettingModel;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\File;
use DB;
class FrontPost
{
    use HasFactory;
    
    /**
     * 取得3篇文章至首頁
     */
    public function getIndexPost()
    {
        $res = PostModel::select('id','page_title','page_content','page_chosen')
                        ->where('page_status',"T")
                        ->orderBy('created_at','desc')
                         ->limit(3)->get();  
        return $res;
    }
}
