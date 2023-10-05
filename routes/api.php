<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandController;
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