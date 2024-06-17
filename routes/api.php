<?php

use App\Http\Controllers\Api\CartsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
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
Route::get('/showp', [ProductsController::class, 'showProducts'])->name('showp');
Route::post('/filterprod', [ProductsController::class, 'productsCategory']);

Route::post('/addprod', [CartsController::class, 'addToCart'])->name('cart.addprod');
Route::get('/getall', [CartsController::class, 'getCart']);
Route::post('/cart', [OrdersController::class, 'store'])->name('cart.store');
Route::post('/updateitem', [CartsController::class, 'updateitem'])->name('cart.updateitem');
Route::post('/deleteitem', [CartsController::class, 'deleteitem'])->name('cart.deleteitem');
Route::get('/calculateTotalAmount', [CartsController::class, 'calculateTotalAmount'])->name('cart.calculateTotalAmount');
Route::post('/store', [OrdersController::class, 'store'])->name('cart.storeorder');

Route::post('/saveproduct', [ProductsController::class, 'addprod'])->name('product.newproduct');
Route::post('/updateProduct', [ProductsController::class, 'updateproduct'])->name('product.updateproduct');
