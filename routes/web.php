<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SermonController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SermonController as AdminSermonController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\BulletinController as AdminBulletinController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Models\Gallery;

// ─── Public ──────────────────────────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sermons', [SermonController::class, 'index'])->name('sermons.index');
Route::get('/sermons/{sermon}', [SermonController::class, 'show'])->name('sermons.show');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/bulletins', [BulletinController::class, 'index'])->name('bulletins.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/gallery-photos/{gallery}', function (Gallery $gallery) {
    abort_unless($gallery->is_published, 404);
    $gallery->load('photos');
    return response()->json([
        'title'  => $gallery->title,
        'photos' => $gallery->photos->map(fn($p) => [
            'url'     => Storage::url($p->file_path),
            'caption' => $p->caption,
        ]),
    ]);
})->name('gallery.photos');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

// ─── Admin Auth ───────────────────────────────────────────────────────────────

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

// ─── Admin Panel (Protected) ──────────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('sermons', AdminSermonController::class);
    Route::resource('events', AdminEventController::class);
    Route::resource('bulletins', AdminBulletinController::class)->except(['edit', 'update', 'show']);
    Route::resource('gallery', AdminGalleryController::class)->except(['show']);
    Route::resource('blog', AdminBlogController::class)->except(['show']);
});
