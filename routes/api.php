<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
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

Route::post('login', [AuthController::class, 'authenticate']);

Route::get('products/list', [ProductsController::class, 'list'])->middleware('auth:sanctum');
Route::get('products/search/{query}', [ProductsController::class, 'search'])->middleware('auth:sanctum');
Route::post('products/create', [ProductsController::class, 'create'])->middleware('auth:sanctum');
Route::put('products/{id}/update', [ProductsController::class, 'update'])->middleware('auth:sanctum');
Route::delete('products/{id}/delete', [ProductsController::class, 'delete'])->middleware('auth:sanctum');