<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Entity\CategoryModel;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $CATEGORYSEETING=array(
            [
            "id"=>1,
            "category_name"=>"社區公告",
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
            "id"=>2,
            "category_name"=>"社區特色",
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
            "id"=>3,
            "category_name"=>"社區特產",
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
            [
            "id"=>4,
             "category_name"=>"社區景點",
             "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
             "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ],
        );
        CategoryModel::insert($CATEGORYSEETING);
    }
}
