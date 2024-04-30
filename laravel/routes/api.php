<?php

use App\Http\Controllers\API\V1\ChangePasswordController;
use App\Http\Controllers\API\V1\CustomerWishListController;
use App\Http\Controllers\API\V1\login;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\ReviewController;
use App\Http\Controllers\API\V1\ShoppingCartController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\ForgetpPasswordController;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('products/search', [ProductController::class, 'search']);
Route::apiResource('products' , ProductController::class);
Route::get('categories/search', [CategoryController::class, 'search']);

Route::apiResource('categories' , CategoryController::class);
Route::apiResource('orders' , OrderController::class);

Route::post('auth/login' , [login::class , 'store'])->middleware('guest:sanctum')->name('login');

Route::delete('auth/logout' , [login::class , 'logout'])->middleware('auth:sanctum')->name('logout')->middleware('auth:sanctum');

Route::post('auth/register', [RegisterController::class, 'store']);
Route::post('auth/update-password', [ChangePasswordController::class, 'changePassword'])->middleware('auth:sanctum');
Route::get('users/search', [UserController::class, 'search']);

Route::apiResource('users' , UserController::class);
Route::apiResource('reviews' , ReviewController::class)->middleware('auth:sanctum');
Route::apiResource('cart' , ShoppingCartController::class);
Route::apiResource('shipping-information' , ShoppingCartController::class);
Route::apiResource('wishlist' , CustomerWishListController::class);

Route::post('auth/forgot-password', [ForgetpPasswordController::class, 'forgotPassword']);
Route::post('auth/reset-password', [ForgetpPasswordController::class, 'resetPassword']);


