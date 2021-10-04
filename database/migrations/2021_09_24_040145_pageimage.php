<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pageimage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //   Schema::create('pageImage', function (Blueprint $table) {
        //     $table->increments('id');
        //     // $table->integer('pageId')->unsigned()->comment('文章ID');
        //     // $table->foreign('pageId')->references('id')->on('page');
        //     $table->string('pageImage_name')->comment('圖片名稱');
        //     $table->dateTime('created_at')->comment('建立時間');
        //     $table->dateTime('updated_at')->comment('修改時間');
        // });
        //  Schema::table('pageImage', function (Blueprint $table) {

        //     $table->integer('pageId')->unsigned()->nullable()->comment('文章ID');
        //     $table->foreign('pageId')->references('id')->on('page');

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