<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperatorPageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route auth
// Route::group(['middleware' => 'guest'], function () {
//     Route::get('/register', [AuthController::class, 'register'])->name('register');
//     Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
//     Route::get('/login', [LoginController::class, 'login'])->name('login');
//     Route::post('/login', [LoginController::class, 'loginPost'])->name('loginPost');
// });

// Route::group(['middleware' => 'auth'], function () {
//     Route::delete('/logout', [LoginController::class, 'logout'])->name('logout');
//     Route::get('/home', [DashboardController::class, 'index'])->name('index');
//     // Route::resource('/post', \App\Http\Controllers\PostController::class);
// });

Route::group(['middleware' => ['admin']], function () {

    Route::resource('permission', PermissionController::class);
    Route::get('permission/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permission', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permission', [RoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

    // group route category controller
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/category', 'index')->name('get.category');
        Route::get('/admin/category/create', 'create')->name('create.category');
        Route::post('/admin/category', 'store')->name('post.category');
        Route::get('/admin/category/{category}/edit', 'edit')->name('det.category');
        Route::put('/admin/category/{category}', 'update');
    });
    // category route
    // Route::get('/admin/category', [CategoryController::class, 'index'])->name('get.category');
    // Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('create.category');
    // Route::post('/admin/category', [CategoryController::class, 'store'])->name('post.category');
    Route::controller(ArticlesController::class)->group(function () {
        Route::get('/admin/article', 'index')->name('get.article');
        Route::get('/admin/article/create', 'create')->name('create.article');
        Route::post('/admin/article', 'store')->name('post.article');
        Route::get('/admin/article/{article}/edit', 'edit')->name('det.article');
        Route::put('/admin/article/{article}', 'update');
    });
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// login admin : admin1@gmail.com | pass: admin1
// login operator : operator@gmail.com | pass: operator
// login superadmin : superadmin123@gmail.com | pass : superadmin123


// admin route list
Route::get('/admin/home', [DashboardController::class, 'index'])->middleware('admin')->name('admin.home');

// operator route list
Route::get('/operator/home', [OperatorPageController::class, 'index'])->middleware('operator')->name('operator.home');
Route::get('/blog-ykfingerboard', [OperatorPageController::class, 'index']);

Route::get('/blog', function () {
    return view('front.pages.example');
});
//admin list page
Route::get('/admin/admin-list', [AdminPageController::class, 'adminList'])->name('admin.adminlist');
