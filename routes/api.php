<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Authorization Controller
Route::post('login', [AuthController::class, 'authenticate']);

// Products Controller
Route::get('products/list/{query?}', [ProductsController::class, 'read'])->middleware('auth:sanctum');
Route::post('products/create', [ProductsController::class, 'create'])->middleware('auth:sanctum');
Route::post('products/upload', [ProductsController::class, 'upload'])->middleware('auth:sanctum');
Route::put('products/{id}/update', [ProductsController::class, 'update'])->middleware('auth:sanctum');
Route::delete('products/{id}/delete', [ProductsController::class, 'delete'])->middleware('auth:sanctum');

// Brand Controller
Route::get('brands/list/{query?}', [BrandController::class, 'read'])->middleware('auth:sanctum');
Route::post('brands/create', [BrandController::class, 'create'])->middleware('auth:sanctum');
Route::put('brands/{id}/update', [BrandController::class, 'update'])->middleware('auth:sanctum');
Route::delete('brands/{id}/delete', [BrandController::class, 'delete'])->middleware('auth:sanctum');

// Category
Route::get('category/list/{query?}', [CategoryController::class, 'read'])->middleware('auth:sanctum');
Route::post('category/create', [CategoryController::class, 'create'])->middleware('auth:sanctum');
Route::put('category/{id}/update', [CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('category/{id}/delete', [CategoryController::class, 'delete'])->middleware('auth:sanctum');

// Customers
Route::get('customer/list/{query?}', [CustomerController::class, 'read'])->middleware('auth:sanctum');
Route::post('customer/create', [CustomerController::class, 'create'])->middleware('auth:sanctum');
Route::put('customer/{id}/update', [CustomerController::class, 'update'])->middleware('auth:sanctum');
Route::delete('customer/{id}/delete', [CustomerController::class, 'delete'])->middleware('auth:sanctum');

// Order
Route::get('order/list/{query?}', [OrderController::class, 'read'])->middleware('auth:sanctum');
Route::post('order/create', [OrderController::class, 'create'])->middleware('auth:sanctum');
Route::put('order/{id}/update', [OrderController::class, 'update'])->middleware('auth:sanctum');
Route::delete('order/{id}/delete', [OrderController::class, 'delete'])->middleware('auth:sanctum');

// Payment
Route::get('payment/list/{query?}', [PaymentController::class, 'read'])->middleware('auth:sanctum');
Route::post('payment/create', [PaymentController::class, 'create'])->middleware('auth:sanctum');
Route::put('payment/{id}/update', [PaymentController::class, 'update'])->middleware('auth:sanctum');
Route::delete('payment/{id}/delete', [PaymentController::class, 'delete'])->middleware('auth:sanctum');

// Order Address
Route::get('order-address/list/{query?}', [OrderAddressController::class, 'read'])->middleware('auth:sanctum');
Route::post('order-address/create', [OrderAddressController::class, 'create'])->middleware('auth:sanctum');
Route::put('order-address/{id}/update', [OrderAddressController::class, 'update'])->middleware('auth:sanctum');
Route::delete('order-address/{id}/delete', [OrderAddressController::class, 'delete'])->middleware('auth:sanctum');