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
         //  Schema::create('pageImage', function (Blueprint $table) {
        //     // $table->increments('id');
        //     $table->integer('pageId')->unsigned()->comment('文章ID');
        //     $table->foreign('pageId')->references('id')->on('page');
        //     // $table->string('pageImage_name')->comment('圖片名稱');
        //     // $table->timestamps();
        // });
         Schema::table('pageImage', function (Blueprint $table) {

            $table->integer('pageId')->unsigned()->comment('文章ID');
            $table->foreign('pageId')->references('id')->on('page');

        });
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