<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\OrderApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});
//Register & Login
Route::post('/userRegister',[UserAuthController::class,'userRegister'])->name('userRegister');
Route::post('/userLogin',[UserAuthController::class,'userLogin'])->name('userLogin');


Route::group(['middleware' => ['jwtAuth']], function () {
   //Order
Route::post('/order',[OrderApiController::class,'order'])->name('order');
Route::get('/orderGet',[OrderApiController::class,'orderGet'])->name('orderGet');
});
