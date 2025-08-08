<?php

use App\Http\Controllers\AboutPublicController;
use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\HeaderSettingController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\PortfolioImageController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BlogController; // 👈 Frontend blogs view controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicePublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\StrengthController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\AttachmentController;

// === Public Pages ===
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/gioi-thieu', [AboutPublicController::class, 'show'])->name('about.public');
Route::view('/lien-he', 'contact')->name('contact');
Route::get('/du-an', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/du-an/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::resource('portfolios', PortfolioController::class);
Route::get('/lien-he', [ContactController::class, 'show'])->name('contact');
Route::post('/lien-he', [ContactController::class, 'send'])->name('contact.send');

// Public routes
Route::get('/dich-vu', [ServicePublicController::class, 'index'])->name('services.index');
Route::get('/dich-vu/{slug}', [ServicePublicController::class, 'show'])->name('services.show');

// === Dashboard (Optional for Admin) ===
Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// === Authenticated User (Profile) ===
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::resource('users', UserController::class);
});

// === Admin Panel ===
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('blogs', AdminBlogController::class);
    Route::get('header-settings', [HeaderSettingController::class, 'edit'])->name('header.edit');
    Route::post('header-settings', [HeaderSettingController::class, 'update'])->name('header.update');
    Route::post('hero-sliders/update-order', [HeroSliderController::class, 'updateOrder'])->name('hero-sliders.update-order');
    Route::resource('hero-sliders', HeroSliderController::class)->names('hero-sliders');
    Route::post('hero-sliders/update-order', [HeroSliderController::class, 'updateOrder'])->name('hero-sliders.update-order');
    Route::get('about-settings', [AboutSettingController::class, 'edit'])->name('about.edit');
    Route::post('about-settings', [AboutSettingController::class, 'update'])->name('about.update');
    Route::resource('portfolios', \App\Http\Controllers\Admin\PortfolioController::class)->names('portfolios');
    Route::resource('strengths', StrengthController::class)->names('strengths');
    Route::resource('services', ServiceController::class)->names('services');
    Route::resource('testimonials', TestimonialController::class)->names('testimonials');

    Route::get('contact-setting', [ContactSettingController::class, 'edit'])->name('contact.edit');
    Route::post('contact-setting', [ContactSettingController::class, 'update'])->name('contact.update');
    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::resource('team-members', TeamMemberController::class)->names('team-members');
    Route::resource('service-categories', ServiceCategoryController::class)
        ->names('service-categories');

    Route::resource('portfolio-categories', PortfolioCategoryController::class)
        ->names('portfolio-categories');

    Route::put('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::get('/service-categories/{id}/toggle-status', [ServiceCategoryController::class, 'toggleStatus'])->name('service-categories.toggle-status');
    Route::get('/portfolio-categories/{id}/toggle-status', [PortfolioCategoryController::class, 'toggleStatus'])->name('portfolio-categories.toggle-status');
    Route::patch('/admin/service-categories/{id}/toggle', [\App\Http\Controllers\Admin\ServiceCategoryController::class, 'toggleStatus'])->name('service-categories.toggle');
    Route::delete('portfolios/album/{id}', [PortfolioImageController::class, 'destroy'])
        ->name('portfolios.album.destroy');
    Route::put('portfolios/album/{id}/note', [PortfolioImageController::class, 'updateNote'])->name('portfolios.album.updateNote');
    Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
    Route::post('portfolios/album/update-order', [PortfolioImageController::class, 'updateOrder'])->name('portfolios.album.updateOrder');

    Route::post('/attachments/upload', [AttachmentController::class, 'upload'])->name('attachments.upload');
    Route::get('portfolios/{id}/update-album', [\App\Http\Controllers\Admin\PortfolioController::class, 'updateAlbum'])->name('portfolios.updateAlbum');
    Route::delete('attachments/{id}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');
    Route::put('portfolios/{portfolio}/description', [\App\Http\Controllers\Admin\PortfolioController::class, 'updateDescription'])
        ->name('portfolios.updateDescription');

    Route::delete('blog-attachments/{id}', [\App\Http\Controllers\Admin\BlogAttachmentController::class, 'destroy'])->name('blog-attachments.destroy');
    Route::get('blogs/{id}/edit-album', [\App\Http\Controllers\Admin\BlogController::class, 'editAlbum'])->name('blogs.editAlbum');
    Route::put('blogs/{id}/update-description', [\App\Http\Controllers\Admin\BlogController::class, 'updateDescription'])->name('blogs.updateDescription');

// Upload route
    Route::post('blog-attachments/upload', [\App\Http\Controllers\Admin\BlogAttachmentController::class, 'upload'])->name('blog.attachments.upload');

// Delete route (you might already have this)
    Route::delete('blog-attachments/{id}', [\App\Http\Controllers\Admin\BlogAttachmentController::class, 'destroy'])->name('blog.attachments.destroy');

});
require __DIR__.'/auth.php';
