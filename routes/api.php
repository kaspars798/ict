<?php

use App\Http\Controllers\Api\AttributeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

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

Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('products', ProductController::class);
    Route::get('products/{product}/attributes', [ProductController::class, 'productAttributes']);

    Route::resource('attributes', AttributeController::class)->only(['store', 'destroy']);
});

