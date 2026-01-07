<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (No authentication required)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $testimonials = App\Models\Testimonial::latest()->take(3)->get();
    return view('home', compact('testimonials'));
});

Route::get('/home', function () {
    $testimonials = App\Models\Testimonial::latest()->take(3)->get();
    return view('home', compact('testimonials'));
});

Route::get('/about', function () {
    $testimonials = App\Models\Testimonial::latest()->get();
    $teamMembers = App\Models\TeamMember::all();
    return view('about', compact('testimonials', 'teamMembers'));
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

    // Admin Services Management & Blog Management
    Route::prefix('admin')->group(function () {
        // Services
        Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
        Route::get('/services/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{service}/edit', [App\Http\Controllers\ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [App\Http\Controllers\ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [App\Http\Controllers\ServiceController::class, 'destroy'])->name('services.destroy');

        // Blog
        Route::resource('blog', App\Http\Controllers\BlogController::class)->except(['show']);

        // Testimonials
        Route::resource('testimonials', App\Http\Controllers\TestimonialController::class);

        // Team Members
        Route::resource('team-members', App\Http\Controllers\TeamMemberController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Local-only debug route to test service creation without auth/CSRF
if (app()->environment('local')) {
    Route::post('/debug/services/create', function () {
        $validated = request()->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'icon' => 'nullable|max:50',
            'price' => 'nullable|max:100',
            'show_price' => 'nullable|boolean'
        ]);

        $validated['show_price'] = request()->has('show_price') || !empty(request('show_price'));

        $service = \App\Models\Service::create($validated);

        return response()->json($service);
    });
}