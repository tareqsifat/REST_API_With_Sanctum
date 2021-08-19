<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;


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

Route::get('/products', [ProductController::class, 'index'])->name('product_index');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product_show');

Route::get('/products/search/{name}', [ProductController::class, 'search'])->name('product_search');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);



Route::group(['middleware'=> ['auth:sanctum']], function () {

    Route::post('/products', [ProductController::class, 'store'])->name('product_store');

    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product_update');

    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product_delete');

    Route::post('/logout', [AuthController::class, 'logout']);

});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
