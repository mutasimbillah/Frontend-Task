<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/test', function () {
    return "Server ok. Current server time is " . now();
});

Route::apiResource('category', CategoryController::class)->only(array('index', 'show'));
Route::apiResource('product', ProductController::class)->only(array('index', 'show'));
