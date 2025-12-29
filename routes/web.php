<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (No authentication required)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// PUBLIC Services Page - Shows services to visitors
Route::get('/services', function () {
    $services = App\Models\Service::all();
    return view('services', compact('services'));
})->name('public.services');

// Contact Form Routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// PUBLIC BLOG ROUTES
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'publicIndex'])->name('blog.public');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Authentication required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Analytics Dashboard
    Route::get('/analytics', [App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/analytics/export', [App\Http\Controllers\AnalyticsController::class, 'exportCsv'])->name('analytics.export');
    
    // Admin Services Management
    Route::prefix('admin')->group(function () {
        Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
        Route::get('/services/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{service}/edit', [App\Http\Controllers\ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [App\Http\Controllers\ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [App\Http\Controllers\ServiceController::class, 'destroy'])->name('services.destroy');
        Route::resource('blog', App\Http\Controllers\BlogController::class)->except(['show']);
    });
});

require __DIR__.'/auth.php';
