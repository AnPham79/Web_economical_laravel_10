<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProductPageController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\TestController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/product-detail/{slug}', [HomeController::class, 'show'])->name('product-detail');

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/contact', function() {
    return view('contact');
})->name('contact');

// ---------------------------------------------------------------- page product -------------------------------------------------------------

Route::get('/product-page', [ProductPageController::class, 'index'])->name('product-page');

Route::get('/category/{slug}', [ProductPageController::class, 'productsByCategory'])->name('category-products');
// --------------------------------------------------------------------------------------------------------------------

// ---------------------------------------------------------------- page sale ----------------------------------------------------------------

Route::get('/product-sale-page', [ProductPageController::class, 'pageProductSale'])->name('product-sale-page');

Route::get('/category-products-sale/{slug}', [ProductPageController::class, 'productsSaleByCategory'])->name('category-products-sale');

// ----------------------------------------------------------------------------------------------------------------------------------------

// ----------------------------------------------------------------------- Login ---------------------------------------------------
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/handle-login', [AuthController::class, 'handleLogin'])->name('handle-login');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/handle-register', [AuthController::class, 'handleRegister'])->name('handle-register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------------------------------------------------------------------------------------------------------------------------

Route::middleware(['checkLogin'])->group(function () {
    Route::get('/cart', function() {
        return view('cart');
    })->name('cart');
});

// ----------------------------------------------- admin middleware ----------------------------------------------------------------

Route::middleware(['AdminCheck'])->group(function () {
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/product-manager', [ProductController::class, 'index'])->name('product-mangager');
    });
});


