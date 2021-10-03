<?php

namespace App\Models\Practice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entity\CategoryModel;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\File;
use DB;
class Category
{
    use HasFactory;
    /**
     * [取得所有分類]
     */
    public function getCategory()
    {
        $query = CategoryModel::select('id','category_name as name')
                                ->get();
        return $query;
    }

}
