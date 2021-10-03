<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //  Schema::create('category', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('category_name')->comment('文章類別');
        //     $table->dateTime('created_at')->comment('建立時間');
        //     $table->dateTime('updated_at')->comment('修改時間');
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