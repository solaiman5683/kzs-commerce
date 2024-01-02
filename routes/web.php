<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\VariationController;

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
        Route::post('{id}/edit', [ProductController::class, 'updateProduct'])->name('updateProduct');
        Route::get('{id}/delete', [ProductController::class, 'deleteProduct'])->name('deleteProduct');


    });

    // attribute
    Route::match(['get','post'],'/addAttribute',[AttributeController::class,'addAttribute'])->name('addAttribute');
    Route::match(['get'],'/allAttribute',[AttributeController::class,'allAttribute'])->name('allAttribute');

    //end attribute
    //addVariation
    Route::match(['get','post'],'/addVariation',[VariationController::class,'addVariation'])->name('addVariation');
    Route::match(['get'],'/allVariation',[VariationController::class,'allVariation'])->name('allVariation');
    //endVariation

    Route::group(['prefix' => 'categories'], function () {
        // redirect / to /products/index
        Route::get('', fn()=>redirect()->route('categories'))->name('categoriesRoot');
        Route::get('index', [CategoryController::class, 'categories'])->name('categories');
        Route::get('create', [CategoryController::class, 'createCategory'])->name('createCategory');
        Route::post('create', [CategoryController::class, 'storeCategory'])->name('storeCategory');
        Route::get('{id}', [CategoryController::class, 'showCategory'])->name('showCategory');
        Route::get('{id}/edit', [CategoryController::class, 'editCategory'])->name('editCategory');
        Route::post('{id}/edit', [CategoryController::class, 'updateCategory'])->name('updateCategory');
        Route::get('{id}/delete', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    });

    // Inventory routes
    Route::group(['prefix' => 'inventory'], function () {
        // redirect / to /products/index
        Route::get('', fn()=>redirect()->route('inventory'))->name('inventoryRoot');
        Route::get('index', [InventoryController::class, 'inventory'])->name('inventory');
        Route::get('create', [InventoryController::class, 'createInventory'])->name('createInventory');
        Route::post('create', [InventoryController::class, 'storeInventory'])->name('storeInventory');
        Route::get('{id}', [InventoryController::class, 'showInventory'])->name('showInventory');
        Route::get('{id}/edit', [InventoryController::class, 'editInventory'])->name('editInventory');
        Route::post('{id}/edit', [InventoryController::class, 'updateInventory'])->name('updateInventory');
        Route::get('{id}/delete', [InventoryController::class, 'deleteInventory'])->name('deleteInventory');
    });

    // Customers routes
    Route::group(['prefix' => 'customers'], function () {
        // redirect / to /products/index
        Route::get('', fn()=>redirect()->route('customers'))->name('customersRoot');
        Route::get('index', [CustomerController::class, 'index'])->name('index');
        Route::get('create', [CustomerController::class, 'createCustomer'])->name('createCustomer');
        Route::post('create', [CustomerController::class, 'storeCustomer'])->name('storeCustomer');
        Route::get('{id}', [CustomerController::class, 'showCustomer'])->name('showCustomer');
        Route::get('{id}/edit', [CustomerController::class, 'editCustomer'])->name('editCustomer');
        Route::post('{id}/edit', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
        Route::get('{id}/delete', [CustomerController::class, 'deleteCustomer'])->name('deleteCustomer');
    });
    // Orders routes
    Route::group(['prefix' => 'orders'], function () {
        // redirect / to /products/index
        Route::get('', fn()=>redirect()->route('orders'))->name('ordersRoot');
        Route::get('index', [OrderController::class, 'index'])->name('index');
        Route::get('create', [OrderController::class, 'createOrder'])->name('createOrder');
        Route::post('create', [OrderController::class, 'storeOrder'])->name('storeOrder');
        Route::get('{id}', [OrderController::class, 'showOrder'])->name('showOrder');
        Route::get('{id}/edit', [OrderController::class, 'editOrder'])->name('editOrder');
        Route::post('{id}/edit', [OrderController::class, 'updateOrder'])->name('updateOrder');
        Route::get('{id}/delete', [OrderController::class, 'deleteOrder'])->name('deleteOrder');
        Route::get('{id}/printOrder', [OrderController::class, 'printOrder'])->name('printOrder');
    });

    // Reports Routes
    Route::group(['prefix' => 'reports'], function () {
        // redirect / to /products/index
        Route::get('/', fn()=>redirect()->route('index'))->name('reportsRoot');
        Route::get('index', [ReportsController::class, 'index'])->name('index');
        Route::post('date-range', [ReportsController::class, 'dateRange'])->name('dateRange');
    });

    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});
