<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group(['middleware' => ['jwt_refresh']], function () {
  
// });


Route::group(['prefix' => 'auth'], function () {
    Route::post('userProfile', [AuthController::class, 'userProfile']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});


// 後臺帳號設定Service
Route::group(['prefix' => 'account'], function () {
    Route::post('createUserAccount', [UserController::class, 'createUserAccount']);
});
// 後臺文章Service
Route::group(['prefix' => 'announcement', 'middleware' => 'jwt_refresh'], function () {
    Route::get('list', [AnnouncementController::class, 'getAllList']);
    Route::post('add', [AnnouncementController::class, 'add']);
    Route::post('uploadImage', [AnnouncementController::class, 'uploadImage']);
});