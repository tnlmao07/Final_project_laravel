<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard',[AdminController::class,'displayUsers'])->middleware(['auth'])->name('dashboard');

/* User Management */
Route::get('/add-user',[AdminController::class,'addUsersForm']);
Route::post('/add-user',[AdminController::class,'addUsersFormPost']);
Route::delete('/user-management/delete/{id}',[AdminController::class,'deleteUser']);
Route::get('/user-management/edit/{id}',[AdminController::class,'editUser']);
Route::post('/user-management/update/{id}',[AdminController::class,'updateUser']);
/* Category Management */
Route::get('/category',[AdminController::class,'displayCategory']);
Route::get('/add-category',[AdminController::class,'addCategoryForm']);
Route::post('/add-category',[AdminController::class,'addCategoryFormPost']);
Route::delete('/category/delete/{id}',[AdminController::class,'deleteCategory']);
Route::get('/category/edit/{id}',[AdminController::class,'editCategory']);
Route::post('/category/update/{id}',[AdminController::class,'updateCategory']);
/* Banner Management */
Route::get('/banner',[AdminController::class,'displayBanner']);
Route::get('/add-banner',[AdminController::class,'addBannerForm']);
Route::post('/add-banner',[AdminController::class,'addBannerFormPost']);
Route::delete('/banner/delete/{id}',[AdminController::class,'deleteBanner']);
Route::get('/banner/edit/{id}',[AdminController::class,'editBanner']);
Route::post('/banner/update/{id}',[AdminController::class,'updateBanner']);
/* Contact Us */
Route::get('/contact-us',[AdminController::class,'displayContactUs']);
Route::delete('/contact/delete/{id}',[AdminController::class,'deleteQuery']);
/* Coupon Management */
Route::get('/coupon',[AdminController::class,'displayCoupon']);
Route::get('/add-coupon',[AdminController::class,'addCouponForm']);
Route::post('/add-coupon',[AdminController::class,'addCouponFormPost']);
Route::delete('/coupon/delete/{id}',[AdminController::class,'deleteCoupon']);
Route::get('/coupon/edit/{id}',[AdminController::class,'editCoupon']);
Route::post('/coupon/update/{id}',[AdminController::class,'updateCoupon']);
/* Product Management */
Route::get('/product',[AdminController::class,'displayProduct']);
Route::get('/add-product',[AdminController::class,'addProductForm']);
Route::post('/add-product',[AdminController::class,'addProductFormPost']);
Route::delete('/product/delete/{id}',[AdminController::class,'deleteProduct']);
Route::get('/product/display-images/{id}',[AdminController::class,'displayImages']);
Route::get('/product/edit/{id}',[AdminController::class,'editProduct']);
Route::post('/product/update/{id}',[AdminController::class,'updateProduct']);
/* cms */
Route::get('/cms',[AdminController::class,'cms']);
Route::get('/cms-form',[AdminController::class,'cmsForm']);
Route::post('/cms-form',[AdminController::class,'cmsFormPost']);
Route::delete('/cms/delete/{id}',[AdminController::class,'cmsDelete']);
Route::get('/cms/edit/{id}',[AdminController::class,'cmsEdit']);
Route::post('/cms/update/{id}',[AdminController::class,'cmsUpdate']);
/* orders */
Route::get('/orders',[AdminController::class,'order']);