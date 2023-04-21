<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*

Routes for testing
*/

Route::get('/debug', [ProductController::class, 'debug'])->name('debug');

Route::post('/products/search_submit', [ProductController::class, 'search_submit'])->name('products.search_submit');

Route::post('/products/general_search_submit', [ProductController::class, 'general_search_submit'])->name('products.general_search_submit');

//Route::post('/products/search_submit', [ProductController::class, 'searchResult'])->name('products.search_submit');

Route::resource('test', 'App\Http\Controllers\TestController');

Route::get('view', [TestController::class, 'index']);
//Route::post('create', [TestController::class, 'create']);

Route::get('test', [TestController::class, 'index']);


/*

Routes for Cart
*/
Route::get('cart', [CartController::class, 'cart']);

Route::get('remove', [CartController::class, 'destroy']);

Route::get('addToCart', [CartController::class, 'addToCart']);

/*

Routes for product viewing, searching and creating
*/
//Route::post('addToCart', [ProductController::class, 'addToCart']);

Route::get('/products/create', [ProductController::class, 'create']);

Route::post('/products/destroy', [ProductController::class, 'destroy']);

Route::get('/products/destroy_page', [ProductController::class, 'destroy_page']);

Route::get('/products/search', [ProductController::class, 'search']);

Route::get('/products/searchResult', [ProductController::class, 'searchResult']);


Route::resource('products', 'App\Http\Controllers\ProductController');

/*

Check auth
*/
Route::get('/check-auth', function() {
    return response()->json(['authenticated' => auth()->check()]);
})->middleware('auth');

/*

Home routes
*/

Route::get('/view_products', [App\Http\Controllers\HomeController::class, 'view_products']);

Route::get('/', [ProductController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


