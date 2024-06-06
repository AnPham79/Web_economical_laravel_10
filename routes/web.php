<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProductPageController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\SizeProductController;

use App\Http\Controllers\CategoryController;

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

Route::get('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
Route::put('/process-change-password', [AuthController::class, 'processChangePassword'])->name('process-change-password');

// ------------------------------------------------------------------------------------------------------------------------------------

Route::middleware(['checkLogin'])->group(function () {
    Route::get('/cart', [CartController::class, 'loadCart'])->name('cart');

    Route::post('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add-to-cart');

    Route::post('/increase-quantity-quantity/{slug}', [CartController::class, 'increaseQuantity'])->name('increase-quantity-product');

    Route::post('/decrease-quantity-quantity/{slug}', [CartController::class, 'decreaseQuantity'])->name('decrease-quantity-product');

    Route::post('/delete-product-in-cart/{slug}', [CartController::class , 'deleteProductInCart'])->name('delete-product-in-cart');
});

// ----------------------------------------------- admin middleware ----------------------------------------------------------------

Route::middleware(['AdminCheck'])->group(function () {
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/product-manager', [ProductController::class, 'index'])->name('product-manager');

        Route::get('/create-product', [ProductController::class, 'create'])->name('create-product');

        Route::post('/store-product', [ProductController::class, 'store'])->name('store-product');

        Route::get('/edit-product/{slug}', [ProductController::class, 'edit'])->name('edit-product');

        Route::put('/update-product/{slug}', [ProductController::class, 'update'])->name('update-product');

        Route::delete('/delete-product/{slug}', [ProductController::class, 'destroy'])->name('delete-product');
    });

    Route::prefix('size')->group(function () {
        Route::get('/product-manager', [SizeProductController::class, 'index'])->name('size.product-manager.index');

        Route::get('/create-product', [SizeProductController::class, 'create'])->name('size.product-manager.create');

        Route::post('/store-product', [SizeProductController::class, 'store'])->name('size.product-manager.store');

        Route::get('/edit-product/{id}', [SizeProductController::class, 'edit'])->name('size.product-manager.edit');

        Route::put('/update-product/{id}', [SizeProductController::class, 'update'])->name('size.product-manager.update');

        Route::delete('/delete-product/{id}', [SizeProductController::class, 'destroy'])->name('size.product-manager.destroy');
    });

    Route::get('/category-manager', [CategoryController::class, 'index'])->name('category.category-manager');
    Route::get('/create-category', [CategoryController::class, 'create'])->name('category.category-create');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('category.category-store');
    Route::get('/edit-category/{category_slug_name}', [CategoryController::class, 'edit'])->name('category.category-edit');
    Route::put('/update-category/{category_slug_name}', [CategoryController::class, 'update'])->name('category.category-update');
    Route::delete('/destroy-category/{category_slug_name}', [CategoryController::class, 'destroy'])->name('category.category-destroy');
});


