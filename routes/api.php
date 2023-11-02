<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::post('/create',[ProductController::class, 'product_save']);
Route::get('/show_value',[ProductController::class, 'show_value']);
Route::post('/product_edit',[ProductController::class, 'product_edit'])->middleware('auth');
Route::post('/product_delete',[ProductController::class, 'product_delete']);




