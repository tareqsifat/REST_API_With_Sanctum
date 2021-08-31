<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\ProductReview;

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

// Review Index
Route::get('/product_review', [ProductReviewController::class, 'index']);

// create Review
Route::post('/product_review/create', [ProductReviewController::class, 'store']);

//  Show Review
Route::get('/product_review/show/{id}', [ProductReviewController::class, 'show']);

// update revire
Route::get('/product_review/update', [ProductReviewController::class, 'store']);

// Delete Review
Route::delete('/product_review/delete', [ProductReviewController::class, 'delete']);





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
