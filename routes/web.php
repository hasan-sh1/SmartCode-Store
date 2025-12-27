<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Landing and pages
Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/source-code', [PageController::class, 'sourceCode'])->name('source.code');

// CRUD resources
Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('services', ServiceController::class);

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
    Route::get('/checkout/bank', function () { return view('checkout.bank'); })->name('checkout.bank');
    Route::get('/checkout/paypal', function () { return view('checkout.paypal'); })->name('checkout.paypal');

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Admin routes
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\UserAdminController;

Route::middleware(['auth']) // add 'role:super-admin|admin' after publishing Spatie migrations
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Users
        Route::get('/users', [UserAdminController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserAdminController::class, 'show'])->name('users.show');
        Route::put('/users/{user}', [UserAdminController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserAdminController::class, 'destroy'])->name('users.destroy');

        // Products
        Route::get('/products', [ProductAdminController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductAdminController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductAdminController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductAdminController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductAdminController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductAdminController::class, 'destroy'])->name('products.destroy');

        // Categories
        Route::get('/categories', [CategoryAdminController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryAdminController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryAdminController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryAdminController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryAdminController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryAdminController::class, 'destroy'])->name('categories.destroy');

        // Services (source code items)
        Route::get('/services', [ServiceAdminController::class, 'index'])->name('services.index');
        Route::get('/services/create', [ServiceAdminController::class, 'create'])->name('services.create');
        Route::post('/services', [ServiceAdminController::class, 'store'])->name('services.store');
        Route::get('/services/{service}/edit', [ServiceAdminController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [ServiceAdminController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [ServiceAdminController::class, 'destroy'])->name('services.destroy');
    });
