<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('Dynamic_auth')->group(function () { logoutAdmin

    Route::post('adminlogin', [AdminController::class,'adminlogin'])->name('adminlogin');

    Route::post('v1/loginUser', [AdminController::class,'loginUser'])->name('loginUser');

    Route::post('v1/userProfile', [AdminController::class,'userProfile'])->name('userProfile');



    Route::post('logoutAdmin', [AdminController::class,'logoutAdmin'])->name('logoutAdmin');


    Route::post('v1/users/post-all/{type}', [PostController::class, 'saveAll'])->name('{type}');


    Route::post('v1/users/get-all/{type}', [ReadController::class, 'getAll'])->name('post.getAll');

       Route::post('v1/users/get/{type}/{id}', [ReadController::class, 'get'])->name('post.get');


    Route::group([

    'middleware' => ['auth:admin-api', 'Dynamic_auth'],

    'prefix' => 'v1/admin'

], function ($router) {

Route::post('/post-all/{type}', [PostController::class, 'saveAll'])->name('{type}');

Route::delete('/delete/{type}/{id}', [PostController::class, 'delete'])->name('delete.{type}');

Route::put('/update-all/{type}/{id}', [PostController::class, 'update'])->name('{type}');

Route::post('/get-all/{type}', [ReadController::class, 'getAll'])->name('post.getAll');

Route::post('/get/{type}/{id}', [ReadController::class, 'get'])->name('post.get');
});

// Route::get('/v1/admin/get/{type}/{id}', [ReadController::class, 'get'])->name('{type}');
Route::post('/v1/admin/post-all/{type}', [PostController::class, 'saveAll'])->name('{type}');



Route::group([

    'middleware' => ['auth:user-api', 'Dynamic_auth'],

    'prefix' => 'v1/user'

], function ($router) {

    Route::delete('/delete/{type}/{id}', [PostController::class, 'delete'])->name('delete.{type}');

Route::post('/post-all/{type}', [PostController::class, 'saveAll'])->name('{type}');

Route::post('/post-all/{type}/deposit', [PaymentController::class, 'deposit'])->name('{type}');


Route::put('/update-all/{type}/{id}', [PostController::class, 'update'])->name('{type}');

Route::post('/get-all/{type}', [ReadController::class, 'getAll'])->name('post.getAll');

Route::post('/get/{type}/{id}', [ReadController::class, 'get'])->name('post.get');


Route::post('post-all/user/changePassword/{id}', [AdminController::class, 'changePasswordUser'])->name('changePasswordUser');

});
