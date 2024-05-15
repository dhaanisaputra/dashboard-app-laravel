<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperatorPageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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

Route::resource('permission', PermissionController::class);
Route::get('permission/{permissionId}/delete', [PermissionController::class, 'destroy']);

Route::resource('roles', RoleController::class);
Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// admin route list
Route::get('/admin/home', [DashboardController::class, 'index'])->middleware('admin')->name('admin.home');

// operator route list
Route::get('/operator/home', [OperatorPageController::class, 'index'])->middleware('operator')->name('operator.home');

//admin list page
Route::get('/admin/admin-list', [AdminPageController::class, 'adminList'])->name('admin.adminlist');
