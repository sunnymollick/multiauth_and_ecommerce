<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\Brand\BrandController;
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

Route::get('/', function () {
    return view('frontend.pages.index');
});

Route::group(['prefix' => 'admin', 'middleware'=>['admin:admin']], function () {
    Route::get('/login',[AdminController::class,'loginForm']);
    Route::post('/login',[AdminController::class,'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin_backend.pages.index');
})->name('dashboard');

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('user_backend.pages.index');
})->name('dashboard');



// User Routes Go Here
Route::get('user/logout',[MainUserController::class,'Logout'])->name('user.logout');
Route::get('user/profile',[MainUserController::class,'userProfile'])->name('user.profile');
Route::get('edit/user/profile',[MainUserController::class,'editUserProfile'])->name('edit.user.profile');
Route::post('update/user/profile',[MainUserController::class,'userProfileUpdate'])->name('user.update');
Route::get('change/user/password',[MainUserController::class,'userPasswordChange'])->name('user.password.change');
Route::post('update/user/password',[MainUserController::class,'updateUserPassword'])->name('update.user.password');

// Admin Routes Go Here

Route::get('admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('admin/profile',[MainAdminController::class,'adminProfile'])->name('admin.profile');
Route::get('edit/admin/profile',[MainAdminController::class,'editAdminProfile'])->name('edit.admin.profile');
Route::post('update/admin/profile',[MainAdminController::class,'adminProfileUpdate'])->name('admin.update');
Route::get('change/admin/password',[MainAdminController::class,'adminPasswordChange'])->name('admin.password.change');
Route::post('update/admin/password',[MainAdminController::class,'updateAdminPassword'])->name('update.admin.password');

// Category routes go here
Route::get('admin/category',[CategoryController::class,'category'])->name('categories');
Route::post('store/category',[CategoryController::class,'storeCategory'])->name('store.category');
Route::get('delete/category/{id}',[CategoryController::class,'categoryDelete'])->name('delete.category');
Route::get('edit/category/{id}',[CategoryController::class,'categoryEdit'])->name('edit.category');
Route::post('update/category/{id}',[CategoryController::class,'categoryUpdate'])->name('update.category');

// Brands Route Go Here
Route::get('admin/brand',[BrandController::class,'brand'])->name('brands');
Route::post('admin/store/brand',[BrandController::class,'storeBrand'])->name('store.brand');
Route::get('delete/brand/{id}',[BrandController::class,'brandDelete'])->name('delete.brand');
Route::get('edit/brand/{id}',[BrandController::class,'brandEdit'])->name('edit.brand');
Route::post('update/brand/{id}',[BrandController::class,'brandUpdate'])->name('update.brand');


// Sub Categories Routes Go Here
Route::get('admin/sub/category',[SubCategoryController::class,'subCategory'])->name('sub.category');
Route::post('store/sub/category',[SubCategoryController::class,'storeSubCategory'])->name('store.sub.category');
Route::get('delete/sub/category/{id}',[SubCategoryController::class,'subCategoryDelete'])->name('delete.sub.category');
Route::get('edit/sub/category/{id}',[SubCategoryController::class,'subCategoryEdit'])->name('edit.sub.category');
Route::post('update/sub/category/{id}',[SubCategoryController::class,'subCategoryUpdate'])->name('update.sub.category');
