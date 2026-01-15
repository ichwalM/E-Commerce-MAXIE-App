<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/shop', [LandingController::class, 'shop'])->name('shop');
Route::get('/best-sellers', [LandingController::class, 'bestSellers'])->name('best-sellers');
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'id'])) {
        abort(400);
    }
    Session::put('locale', $locale);
    return redirect()->back();
})->name('lang.switch');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);

    // OTP Verification Routes
    Route::get('verify-otp', [App\Http\Controllers\Auth\VerifyOtpController::class, 'show'])->name('verification.notice');
    Route::post('verify-otp', [App\Http\Controllers\Auth\VerifyOtpController::class, 'verify'])->name('verification.verify');
    Route::post('resend-otp', [App\Http\Controllers\Auth\VerifyOtpController::class, 'resend'])->name('verification.resend');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/distributors', [App\Http\Controllers\Admin\DistributorController::class, 'index'])->name('distributors.index');
        Route::post('/distributors/{user}/approve', [App\Http\Controllers\Admin\DistributorController::class, 'approve'])->name('distributors.approve');
        Route::post('/distributors/{user}/reject', [App\Http\Controllers\Admin\DistributorController::class, 'reject'])->name('distributors.reject');
        Route::patch('/distributors/{user}/deactivate', [App\Http\Controllers\Admin\DistributorController::class, 'deactivate'])->name('distributors.deactivate');
        
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
        
        Route::get('/stock', [App\Http\Controllers\Admin\StockController::class, 'index'])->name('stock.index');
        Route::post('/stock', [App\Http\Controllers\Admin\StockController::class, 'update'])->name('stock.update');
        
        Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);
        
        Route::post('/ai/generate', [App\Http\Controllers\Admin\AiController::class, 'generate'])->name('ai.generate');
    });

    Route::middleware(['auth'])->prefix('distributor')->name('distributor.')->group(function () {
        Route::get('/orders', [App\Http\Controllers\Distributor\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/create', [App\Http\Controllers\Distributor\OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [App\Http\Controllers\Distributor\OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}', [App\Http\Controllers\Distributor\OrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/cancel', [App\Http\Controllers\Distributor\OrderController::class, 'cancel'])->name('orders.cancel');

        Route::get('/stock', [App\Http\Controllers\Distributor\StockController::class, 'index'])->name('stock.index');
        
        Route::resource('sales', App\Http\Controllers\Distributor\SalesController::class)
            ->parameters(['sales' => 'order'])
            ->only(['index', 'show', 'update']);
        
        Route::get('/reports', [App\Http\Controllers\Distributor\ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export', [App\Http\Controllers\Distributor\ReportController::class, 'export'])->name('reports.export');
    });

    Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
         Route::get('/products', [App\Http\Controllers\Customer\ProductController::class, 'index'])->name('products.index');
         
         Route::get('/orders', [App\Http\Controllers\Customer\OrderController::class, 'index'])->name('orders.index');
         Route::get('/orders/create', [App\Http\Controllers\Customer\OrderController::class, 'create'])->name('orders.create');
         Route::post('/orders', [App\Http\Controllers\Customer\OrderController::class, 'store'])->name('orders.store');
         Route::get('/orders/{order}', [App\Http\Controllers\Customer\OrderController::class, 'show'])->name('orders.show');
         Route::patch('/orders/{order}/cancel', [App\Http\Controllers\Customer\OrderController::class, 'cancel'])->name('orders.cancel');
    });

    Route::middleware(['auth'])->name('chat.')->group(function () {
        Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('index');
        Route::get('/chat/create/{user}', [App\Http\Controllers\ChatController::class, 'create'])->name('create');
        Route::get('/chat/{conversation}', [App\Http\Controllers\ChatController::class, 'show'])->name('show');
        Route::post('/chat', [App\Http\Controllers\ChatController::class, 'store'])->name('store');
    });
});
