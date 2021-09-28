<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('page', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('page_title')->comment('文章標題');
        //     $table->string('page_content')->comment('文章內容');
        //     $table->string('page_status')->comment('文章狀態{T:發佈 F:未發佈}');
         //     $table->string('page_chosen')->comment('精選圖片');
        //     // $table->integer('category_id')->unsigned()->comment('分類ID');
        //     // $table->foreign('category_id')->references('id')->on('category');
        //     $table->timestamps();
        // });
        // Schema::table('page', function (Blueprint $table) {
            
        //     // $table->integer('category_id')->unsigned()->comment('分類ID');
        //     // $table->foreign('category_id')->references('id')->on('category');

        // });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}