<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageController;
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
Route::group(['prefix' => 'account', 'middleware' => 'jwt_refresh'], function () {
    Route::get('getAdminInfo', [UserController::class, 'getAdminInfo']);
    Route::get('getConfig', [SettingController::class, 'getConfig']);
    Route::get('getAccountToTable', [UserController::class, 'getAccountToTable']);
    Route::post('updatePassword', [UserController::class, 'updatePassword']);
    Route::post('updatePermission', [UserController::class, 'updatePermission']);
    Route::post('createEditor', [UserController::class, 'createEditor']);
     Route::post('deleteUser', [UserController::class, 'deleteUser']);
    Route::post('updateConfig', [SettingController::class, 'updateConfig']);
});
// 後臺文章Service
Route::group(['prefix' => 'announcement', 'middleware' => 'jwt_refresh'], function () {
    Route::get('list', [AnnouncementController::class, 'getAllList']);
    Route::post('add', [AnnouncementController::class, 'add']);
    Route::post('edit', [AnnouncementController::class, 'edit']);
    Route::post('delete', [AnnouncementController::class, 'delete']);
    Route::get('getAllListByCategory/{category_id}', [AnnouncementController::class, 'getAllListByCategory']);
    Route::get('getCategory', [AnnouncementController::class, 'getCategory']);
    Route::get('getPostToEditById/{pageId}', [AnnouncementController::class, 'getPostToEditById']);
    Route::post('uploadImage', [AnnouncementController::class, 'uploadImage']);
    Route::get('downloadPPT', [PageController::class, 'downloadPPT']);
});

Route::group(['prefix' => 'page'], function () {
    Route::get('getIndexData', [PageController::class, 'getIndexData']);
    Route::get('getNewsPage/{catrgory_id}', [PageController::class, 'getNewsPage']);
    Route::get('getNewsDetailPage/{post_id}', [PageController::class, 'getNewsDetailPage']);
});
Route::get('uploads/{img_name}', [AnnouncementController::class, 'getImg']);