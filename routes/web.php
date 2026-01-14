<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/distributors', [App\Http\Controllers\Admin\DistributorController::class, 'index'])->name('distributors.index');
        Route::post('/distributors/{user}/approve', [App\Http\Controllers\Admin\DistributorController::class, 'approve'])->name('distributors.approve');
        
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
        
        Route::get('/stock', [App\Http\Controllers\Admin\StockController::class, 'index'])->name('stock.index');
        Route::post('/stock', [App\Http\Controllers\Admin\StockController::class, 'update'])->name('stock.update');
        
        Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);
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
