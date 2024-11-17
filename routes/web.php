<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\PostController as UserPostController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('preLogin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::controller(BaseController::class)->group(function() {
//     Route::get('/dashboard', 'index')->name('index.dashboard');
//     Route::get('/dashboardu', 'indexu')->name('index.dashboardu');
// });

Route::prefix('A')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::controller(BaseController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('index.dashboard');
    });
    Route::controller(AdminUserController::class)->group(function() {
        Route::get('/data-user', 'dataUser')->name('index.user');
        Route::get('/data-user/form-user', 'createUser')->name('index.create.user');
        Route::post('/data-user/form-user/create', 'tambahUser')->name('index.tambah.user');
        Route::get('/data-user/form-user/edit/{id}', 'editUser')->name('index.edit.user');
        Route::put('/data-user/form-user/update/{id}', 'updateUser')->name('index.update.user');
        Route::delete('/data-user/form-user/delete/', 'deleteUser')->name('index.delete.user');
        Route::get('/data-user/{id}', 'showUser')->name('index.show.user');
    });
    Route::controller(AdminController::class)->group(function() {
        Route::get('/data-admin', 'dataAdmin')->name('index.admin');
        Route::get('/data-admin/form-admin', 'createadmin')->name('index.create.admin');
        Route::post('/data-admin/form-admin/create', 'tambahadmin')->name('index.tambah.admin');
        Route::get('/data-admin/form-admin/edit/{id}', 'editadmin')->name('index.edit.admin');
        Route::put('/data-admin/form-admin/update/{id}', 'updateadmin')->name('index.update.admin');
        Route::delete('/data-admin/form-admin/delete/', 'deleteadmin')->name('index.delete.admin');
        Route::get('/data-admin/{id}', 'showadmin')->name('index.show.admin');
    });
    Route::controller(PostController::class)->group(function() {
        Route::get('/post', 'index')->name('index.post');
        Route::get('/post/create', 'create')->name('create.post');
        Route::post('/post/simpan', 'store')->name('simpan.post');
        Route::get('/post/edit/{id}', 'edit')->name('edit.post');
        Route::put('/post/update/{id}', 'update')->name('update.post');
        Route::delete('/post/delete/', 'delete')->name('delete.post');
        Route::post('/upload-image', 'uploadImage')->name('upload.image');
        Route::post('/upload-ck', 'upload')->name('ckeditor.upload');
    });
});

Route::prefix('U')->middleware(['auth', 'isUser'])->group(function(){
    Route::controller(UserPostController::class)->group(function() {
        Route::get('/home', 'index')->name('index.home');
        Route::get('/draft', 'indexdraft')->name('index.draft');
        Route::get('/home/{id}', 'show')->name('show.post');
        Route::get('/create-post', 'create')->name('user.create.post');
        Route::post('/upload-ck', 'upload')->name('user.ckeditor.upload');
        Route::post('/store-post', 'store')->name('user.store.postt');
        Route::post('/search', 'search')->name('user.search');
        Route::post('/post/{postId}/comment', 'storeComment')->name('comments.store');
    });
    Route::controller(UserController::class)->group(function() {
        Route::get('/profile/{id}', 'show')->name('profile.show');
        Route::get('/profile/edit/{id}', 'edit')->name('profile.edit');
        Route::put('/profile/edit/{id}', 'update')->name('profile.update');
    });
});