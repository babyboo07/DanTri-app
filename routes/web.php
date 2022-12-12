<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShortVideoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index');
    Route::get('category/create', 'create');
    Route::post('category/create', 'store')->name('category.create');
    Route::get('category/edit/{id}', 'edit')->name('category.edit');
    Route::put('category/update/{id}', 'update')->name('category.update');
    Route::post('category/updateStatus/{id}', 'updateStatus')->name('category.updateStatus');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return view('admin.dashboard');
});


Route::get('/weathers', function () {
    return view('client.weather');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/post', 'index')->middleware();
    Route::post('/post', 'search')->name('post.search');
    Route::get('/cate', 'getCateParent')->name('getCateParent');
    Route::get('/catechil', 'getCateAll')->name('getCateAll');
    Route::get('post/create', 'create');
    Route::get('post/edit/{id}', 'edit');
    Route::post('post/create', 'store')->name('post.create');
    Route::put('post/edit/{id}', 'update')->name('post.update');
    Route::delete('post/delete/{id}', 'destroy')->name('post.destroy');
    Route::get('post/approved/{id}', 'show')->name('post.approved');
    Route::post('post/approved/{id}', 'updateStatus')->name('post.status');
    Route::get('news/detail/{id}', 'newsDetail')->name('news');
    Route::post('increase/views/{id}', 'increaseViews')->name('increaseViews');
    Route::get('post/sreachcategory/{id}', 'sreachByCategory')->name('sreachByCategory');
});

Route::controller(PostCommentController::class)->group(function () {
    Route::post('/postcommnet', 'store')->name('postcommnet.store');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('post/comment', 'store')->name('client.comment');
    Route::get('/comment', 'index');
    Route::get('/commentvideo', 'commentOfVideo');
    Route::get('comment/approved/{id}', 'show');
    Route::get('/commentvideo/{id}', 'showVideoComment');
    Route::post('comment/status/{id}', 'updateStatus')->name('Acceptedcomment');
    Route::delete('comment/delete/{id}', 'destroy')->name('deleteComment');
    Route::post('comment/like/{id}', 'likeComment')->name('likeComment');
    Route::post('comment/video', 'createCommentOfVideo')->name('video.comment');
});

Route::controller(ShortVideoController::class)->group(function () {
    Route::get('/video', 'index');
    Route::get('/video/create', 'create');
    Route::post('video/create', 'store')->name('video.create');
    Route::get('video/approved/{id}', 'show');
    Route::post('video/approved/{id}', 'updateStatus')->name('video.status');
    Route::delete('video/disable/{id}', 'destroy')->name('video.delete');
    Route::get('video/detail/{id}', 'details')->name('video.details');
    Route::get('shortvideo/detail/{id}', 'shortVideo')->name('shortvideo.details');
    Route::post('video/like/{id}', 'likeVideo')->name('likeVideo');
    Route::post('increase/copy/{id}', 'increaseCopy')->name('increaseCopy');
});


Route::controller(UserController::class)->group(function () {
    Route::get('/author', 'index');
    Route::get('/author/create', 'create');
    Route::post('/author/create', 'store')->name('createMember');
    Route::put('author/update/role/{id}', 'update')->name('updateRole');
});


Route::controller(HomeController::class)->group(function () {
    Route::get('/dashboard', 'adminPage');
    Route::get('/search', 'page');
    Route::post('/search', 'searchPage')->name('search');
});
