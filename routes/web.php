<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;


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

//Route::get('/home', function () {
//    return view('index');
//})->middleware('auth')->name('home');

//Route::get('/test', function () {
//    return view('test');
//});

require __DIR__ . '/auth.php';

Route::group(['prefix' => '/', 'middleware'=>'auth'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('/home', fn()=>view('index'))->name('home');

    // Products routes
    Route::group(['prefix' => 'products'], function () {
        // redirect / to /products/index
        Route::get('', fn()=>redirect()->route('products'))->name('productsRoot');
        Route::get('index', [ProductController::class, 'products'])->name('products');
        Route::get('create', [ProductController::class, 'createProduct'])->name('createProduct');
        Route::post('create', [ProductController::class, 'storeProduct'])->name('storeProduct');
        Route::get('{id}', [ProductController::class, 'showProduct'])->name('showProduct');
        Route::get('{id}/edit', [ProductController::class, 'editProduct'])->name('editProduct');
        Route::put('{id}/edit', [ProductController::class, 'updateProduct'])->name('updateProduct');
        Route::delete('{id}/delete', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
    });

    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});
