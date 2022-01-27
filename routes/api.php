<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Role;
use App\Models\Contact;
use App\Models\Category;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'authenticate']);
Route::get('open', [DataController::class,'open']);
Route::get('category',[UserController::class,'category']);
Route::get('product',[UserController::class,'product']);
Route::get('cms',[UserController::class,'cms']);
Route::post('contactus',[UserController::class,'contactUs']);
Route::post('/order',[UserController::class,'order']);
Route::post('/address',[UserController::class,'address']);
Route::get('/coupons',[UserController::class,'coupon']);
Route::get('/categories/{id}',[UserController::class,'categoryProducts']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', [UserController::class,'getAuthenticatedUser']);
    Route::get('closed', [DataController::class,'closed']);
    
    Route::get('coupon/{id}',[UserController::class,'coupon']);
    Route::post('logout', [UserController::class,'logout']);

});
