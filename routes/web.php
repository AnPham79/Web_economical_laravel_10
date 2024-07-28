<?php
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProductPageController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\SizeProductController;

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

Route::get('/product-detail/{slug}', [HomeController::class, 'show'])
        ->name('product-detail')
        ->middleware('ThrottleViews');

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/contact', function() {
    return view('contact');
})->name('contact');

Route::get('/search', [SearchController::class, 'index'])->name('search');

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

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'processForgotPassword']);
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('/reset-password', [AuthController::class, 'processResetPassword']);

Route::get('/Auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google-auth');
 
Route::get('/Auth/google/callback', function () {
    $user = Socialite::driver('google')->user();

    $existingUser = User::where('email', $user->email)->first();

    if ($existingUser) {
        Auth::login($existingUser);
        return redirect()->route('index');
    } else {
        session(['register_data' => [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar ?? null,
        ]]);

        return redirect()->route('register');
    }
});

// ------------------------------ end ------------------------------------------

// --------------------------đăng kí bằng git hub -----------------------------
Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
})->name('github-auth');
 
Route::get('/auth/github/callback', function () {
    $user = Socialite::driver('github')->user();

    $existingUser = User::where('email', $user->email)->first();

    if ($existingUser) {
        Auth::login($existingUser);
        return redirect()->route('index');
    } else {
        session(['register_data' => [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar ?? null,
        ]]);
        
        return redirect()->route('register');
    }
});


// ------------------------------------------------------------------------------------------------------------------------------------


// ---------------------------------------------- giỏ hàng và thanh toán -----------------------------------------------------------
Route::middleware(['checkLogin'])->group(function () {
    Route::get('/cart', [CartController::class, 'loadCart'])->name('cart');

    Route::post('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add-to-cart');

    Route::post('/increase-quantity-quantity/{slug}/{size}', [CartController::class, 'increaseQuantity'])->name('increase-quantity-product');

    Route::post('/decrease-quantity-quantity/{slug}/{size}', [CartController::class, 'decreaseQuantity'])->name('decrease-quantity-product');

    Route::post('/delete-product-in-cart/{slug}/{size}', [CartController::class , 'deleteProductInCart'])->name('delete-product-in-cart');

    Route::get('/check-out', [OrderController::class, 'checkOut'])->name('check-out');

    Route::post('/payment-confirmation', [OrderController::class, 'paymentConfirmation'])->name('payment-confirmation');

    Route::get('/use-coupon', [CartController::class, 'loadCart'])->name('use-coupon');

    Route::get('/un-use-coupon', [CouponController::class, 'unUseCoupon'])->name('un-use-coupon');

    Route::get('/thank-you', function(){
        view('thank');
    })->name('thank');
});

// ------------------------------------------------- Bình luận -----------------------------------------
Route::post('post-comment/{slug}', [CommentController::class, 'postComment'])->name('post-comment');


// -------------------------------------------------- cài đặt và quản lí các thao tác của user --------------------------------------
Route::middleware(['checkLogin'])->group(function () {
    Route::get('/order-history', [UserController::class, 'orderHistory'])->name('order-history');

    Route::get('/order-detail/{id}', [UserController::class, 'orderDetail'])->name('order-detail');

    Route::post('/cancel-order/{id}', [UserController::class, 'cancelOrder'])->name('cancel-order');
});

// -----------------------------------------------------------------------------------------------------------------------------------




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

    // -------------------------- Quản lí danh mục ---------------------------------------------------------------
    Route::get('/category-manager', [CategoryController::class, 'index'])->name('category.category-manager');
    Route::get('/create-category', [CategoryController::class, 'create'])->name('category.category-create');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('category.category-store');
    Route::get('/edit-category/{category_slug_name}', [CategoryController::class, 'edit'])->name('category.category-edit');
    Route::put('/update-category/{category_slug_name}', [CategoryController::class, 'update'])->name('category.category-update');
    Route::delete('/destroy-category/{category_slug_name}', [CategoryController::class, 'destroy'])->name('category.category-destroy');

    // ------------------------- Quản lí user ----------------------------------------------------------------------
    Route::get('user-manager', [UserController::class, 'userManager'])->name('user-manager');
    Route::post('change-status-account/{user_name}', [UserController::class, 'changeStatusAccount'])->name('change-status-account');

    // ------------------------ Quản lí đơn hàng --------------------------------------------------------------------
    Route::get('order-manager', [OrderDetailController::class , 'orderManager'])->name('order-manager');

    Route::post('update-order-status/{id}', [OrderDetailController::class, 'updateOrderStatus'])->name('update-order-status');

    Route::get('order-manager-detail/{id}', [OrderDetailController::class, 'orderDetailManager'])->name('order-manager-detail');

    // ------------------------- Quản lí mã giảm giá -------------------------------------------------------

    Route::get('coupon-manager', [CouponController::class, 'index'])->name('coupon-manager');
    Route::get('create-coupon-manager', [CouponController::class, 'create'])->name('create-coupon-manager');
    Route::post('store-coupon-manager', [CouponController::class, 'store'])->name('store-coupon-manager');
    Route::get('edit-coupon-manager/{id}', [CouponController::class, 'edit'])->name('edit-coupon-manager');
    Route::put('update-coupon-manager/{id}', [CouponController::class, 'update'])->name('update-coupon-manager');
    Route::delete('delete-coupon-manager/{id}', [CouponController::class, 'destroy'])->name('destroy-coupon-manager');

    // ----------------------------------------- quản lí bình luận -----------------------------------------------------
    Route::get('comment-manager', [CommentController::class, 'commentManager'])->name('comment-manager');
    Route::post('change-status-comment/{id}', [CommentController::class, 'changeStatusComment'])->name('change-status-comment');

    // ---------------------------------------- chart BAOANSTORE -------------------------------------------------------
    Route::get('chart-baoanstore', [ChartController::class, 'chartBaoanstore'])->name('chart-baoanstore');

    // -------------------------------------- xuất file sản phẩm ra exel và csv------------------------------------------------------------------
    Route::post('export-excel-product', [ProductController::class, 'exportExcel'])->name('export-excel-product');

    Route::post('export-csv-product', [ProductController::class, 'exportCSV'])->name('export-csv-product');

    Route::post('import-product-data-form', [ProductController::class, 'importExcelForm'])->name('import-product-data-form');

    Route::post('import-product-data', [ProductController::class, 'importExcel'])->name('import-product-data');
});


