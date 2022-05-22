<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

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

Route::controller(CategoryController::class)->group(function(){
    Route::get('/categories', 'index');
    Route::get('/category/{id}', 'searchCategory');
    Route::post('/category', 'createCategory');
    Route::put('/category/{id}', 'updateCategory');
    Route::delete('/category/{id}', 'deleteCategory');
});