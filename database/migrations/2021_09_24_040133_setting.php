<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Setting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //    Schema::create('setting', function (Blueprint $table) {
        //     $table->string('module')->comment('模組名稱');
        //     $table->string('setting')->comment('設定欄位');
        //     $table->string('value')->comment('值');
        //     $table->dateTime('created_at')->comment('建立時間');
        //     $table->dateTime('updated_at')->comment('修改時間');
        // });
         Schema::create('setting', function (Blueprint $table) {
            $table->increments('id')->comment('編輯主鍵');
            $table->string('community_name')->comment('社區名稱');
            $table->string('community_address')->comment('社區地址');
            $table->string('community_host')->comment('社區負責人');
            $table->string('community_contact')->comment('社區聯絡人');
            $table->string('community_phone')->comment('社區電話');
            $table->string('community_email')->comment('聯絡信箱');
            $table->string('community_facebook')->comment('FB');
            $table->string('community_instagram')->comment('IG');
            $table->longText('community_introduce')->comment('簡介');
            $table->string('community_image')->comment('社區圖片');
            $table->dateTime('created_at')->comment('建立時間');
            $table->dateTime('updated_at')->comment('修改時間');
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