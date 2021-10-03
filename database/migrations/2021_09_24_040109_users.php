<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //   Schema::create('user', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('user_name');
        //     $table->string('user_account');
        //     $table->string('user_password');
        //     $table->string('user_phone');
        //     $table->string('user_email');
        //     $table->string('user_permission')->comment('權限{root:系統開發者,admin:網站管理者,normal:一般管理員}');
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