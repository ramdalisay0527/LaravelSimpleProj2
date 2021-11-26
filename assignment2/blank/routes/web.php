<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\Review;
use App\Models\User;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewLikesController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\FollowUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// routes for all controllers
Route::resource('product', ProductController::class);
Route::resource('review', ReviewController::class);
Route::resource('reviewlikes', ReviewLikesController::class);
Route::resource('productimages', ProductImagesController::class);
Route::resource('followuser', FollowUserController::class);
Route::get('reviewlikes/storelike/{id}', [ReviewLikesController::class,'storereviewlike']);
Route::get('reviewlikes/storedislike/{id}', [ReviewLikesController::class,'storereviewdislike']);
Route::get('review/create/{id}', [ReviewController::class,'createnewreviewfromshowpage']);
Route::get('productimages/create/{id}', [ProductImagesController::class,'uploadphotofromshowpage']);
Route::get('followuser/showreviews/{id}', [FollowUserController::class,'showreviewsofuser']);

Route::get('/', [ProductController::class, 'index']); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
