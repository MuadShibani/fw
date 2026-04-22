<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageViewController;
use App\Http\Controllers\Web\BlogWebController;
use App\Http\Controllers\Web\EventsWebController;
use App\Http\Controllers\Web\LibraryWebController;
use App\Http\Controllers\Web\MediaWebController;
use App\Http\Controllers\Web\ContactWebController;
use App\Http\Controllers\Web\LanguageController;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController as AdminNews;
use App\Http\Controllers\Admin\BlogController as AdminBlog;
use App\Http\Controllers\Admin\EventsController as AdminEvents;
use App\Http\Controllers\Admin\LibraryController as AdminLibrary;
use App\Http\Controllers\Admin\YainController;
use App\Http\Controllers\Admin\AcceleratorController;
use App\Http\Controllers\Admin\WiifController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\DocumentUploadController;
use App\Http\Controllers\Admin\StatsController;

Route::post('/lang', [LanguageController::class, 'switch'])->name('lang.switch');

Route::middleware(['web', \App\Http\Middleware\SetLanguage::class])->group(function () {
    Route::get('/',            [HomeController::class,     'index'])->name('home');
    Route::get('/about',       [PageViewController::class, 'about'])->name('about');
    Route::get('/accelerator', [PageViewController::class, 'accelerator'])->name('accelerator');
    Route::get('/yain',        [PageViewController::class, 'yain'])->name('yain');
    Route::get('/wiif',        [PageViewController::class, 'wiif'])->name('wiif');
    Route::get('/sil',         [PageViewController::class, 'sil'])->name('sil');
    Route::get('/blog',        [BlogWebController::class,    'index'])->name('blog.index');
    Route::get('/blog/{id}',   [BlogWebController::class,    'show'])->name('blog.show');
    Route::get('/events',      [EventsWebController::class,  'index'])->name('events.index');
    Route::get('/library',     [LibraryWebController::class, 'index'])->name('library.index');
    Route::get('/media',       [MediaWebController::class,   'index'])->name('media.index');
    Route::get('/contact',     [ContactWebController::class, 'index'])->name('contact.index');
    Route::post('/contact',    [ContactWebController::class, 'store'])->name('contact.store');
});

// Admin guest
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AdminAuth::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminAuth::class, 'login'])->name('login.post');
});

// Admin protected
Route::prefix('admin')->name('admin.')->middleware(\App\Http\Middleware\AdminAuthenticated::class)->group(function () {
    Route::post('/logout',   [AdminAuth::class,       'logout'])->name('logout');
    Route::get('/',          fn() => redirect('/admin/dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/news',              [AdminNews::class, 'index'])->name('news.index');
    Route::get('/news/create',       [AdminNews::class, 'create'])->name('news.create');
    Route::post('/news',             [AdminNews::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit',    [AdminNews::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}',         [AdminNews::class, 'update'])->name('news.update');
    Route::delete('/news/{id}',      [AdminNews::class, 'destroy'])->name('news.destroy');

    Route::get('/blog',              [AdminBlog::class, 'index'])->name('blog.index');
    Route::get('/blog/create',       [AdminBlog::class, 'create'])->name('blog.create');
    Route::post('/blog',             [AdminBlog::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}/edit',    [AdminBlog::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{id}',         [AdminBlog::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}',      [AdminBlog::class, 'destroy'])->name('blog.destroy');

    Route::get('/events',            [AdminEvents::class, 'index'])->name('events.index');
    Route::get('/events/create',     [AdminEvents::class, 'create'])->name('events.create');
    Route::post('/events',           [AdminEvents::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit',  [AdminEvents::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}',       [AdminEvents::class, 'update'])->name('events.update');
    Route::delete('/events/{id}',    [AdminEvents::class, 'destroy'])->name('events.destroy');

    Route::get('/library',           [AdminLibrary::class, 'index'])->name('library.index');
    Route::get('/library/create',    [AdminLibrary::class, 'create'])->name('library.create');
    Route::post('/library',          [AdminLibrary::class, 'store'])->name('library.store');
    Route::get('/library/{id}/edit', [AdminLibrary::class, 'edit'])->name('library.edit');
    Route::put('/library/{id}',      [AdminLibrary::class, 'update'])->name('library.update');
    Route::delete('/library/{id}',   [AdminLibrary::class, 'destroy'])->name('library.destroy');

    Route::get('/yain',                      [YainController::class, 'index'])->name('yain.index');
    Route::get('/yain/investors/create',     [YainController::class, 'createInvestor'])->name('yain.investors.create');
    Route::post('/yain/investors',           [YainController::class, 'storeInvestor'])->name('yain.investors.store');
    Route::get('/yain/investors/{id}/edit',  [YainController::class, 'editInvestor'])->name('yain.investors.edit');
    Route::put('/yain/investors/{id}',       [YainController::class, 'updateInvestor'])->name('yain.investors.update');
    Route::delete('/yain/investors/{id}',    [YainController::class, 'destroyInvestor'])->name('yain.investors.destroy');
    Route::get('/yain/startups/create',      [YainController::class, 'createStartup'])->name('yain.startups.create');
    Route::post('/yain/startups',            [YainController::class, 'storeStartup'])->name('yain.startups.store');
    Route::get('/yain/startups/{id}/edit',   [YainController::class, 'editStartup'])->name('yain.startups.edit');
    Route::put('/yain/startups/{id}',        [YainController::class, 'updateStartup'])->name('yain.startups.update');
    Route::delete('/yain/startups/{id}',     [YainController::class, 'destroyStartup'])->name('yain.startups.destroy');

    Route::get('/accelerator',                   [AcceleratorController::class, 'index'])->name('accelerator.index');
    Route::get('/accelerator/cohorts/create',    [AcceleratorController::class, 'createCohort'])->name('accelerator.cohorts.create');
    Route::post('/accelerator/cohorts',          [AcceleratorController::class, 'storeCohort'])->name('accelerator.cohorts.store');
    Route::get('/accelerator/cohorts/{id}/edit', [AcceleratorController::class, 'editCohort'])->name('accelerator.cohorts.edit');
    Route::put('/accelerator/cohorts/{id}',      [AcceleratorController::class, 'updateCohort'])->name('accelerator.cohorts.update');
    Route::delete('/accelerator/cohorts/{id}',   [AcceleratorController::class, 'destroyCohort'])->name('accelerator.cohorts.destroy');
    Route::post('/accelerator/page',             [AcceleratorController::class, 'updatePage'])->name('accelerator.page.update');

    Route::get('/wiif',              [WiifController::class, 'index'])->name('wiif.index');
    Route::get('/wiif/create',       [WiifController::class, 'create'])->name('wiif.create');
    Route::post('/wiif',             [WiifController::class, 'store'])->name('wiif.store');
    Route::get('/wiif/{id}/edit',    [WiifController::class, 'edit'])->name('wiif.edit');
    Route::put('/wiif/{id}',         [WiifController::class, 'update'])->name('wiif.update');
    Route::delete('/wiif/{id}',      [WiifController::class, 'destroy'])->name('wiif.destroy');

    Route::get('/pages',            [PagesController::class, 'index'])->name('pages.index');
    Route::get('/pages/{key}/edit', [PagesController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{key}',      [PagesController::class, 'update'])->name('pages.update');

    Route::get('/messages',           [MessagesController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}',      [MessagesController::class, 'show'])->name('messages.show');
    Route::put('/messages/{id}/read', [MessagesController::class, 'markRead'])->name('messages.read');
    Route::delete('/messages/{id}',   [MessagesController::class, 'destroy'])->name('messages.destroy');

    Route::get('/settings',          [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings',         [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/password',[SettingsController::class, 'changePassword'])->name('settings.password');

    // Stats
    Route::get('/stats',              [StatsController::class, 'index'])->name('stats.index');
    Route::get('/stats/create',       [StatsController::class, 'create'])->name('stats.create');
    Route::post('/stats',             [StatsController::class, 'store'])->name('stats.store');
    Route::get('/stats/{id}/edit',    [StatsController::class, 'edit'])->name('stats.edit');
    Route::put('/stats/{id}',         [StatsController::class, 'update'])->name('stats.update');
    Route::delete('/stats/{id}',      [StatsController::class, 'destroy'])->name('stats.destroy');

    // Image upload (AJAX)
    Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('upload.image');

    // Document/PDF upload (AJAX)
    Route::post('/upload-document', [DocumentUploadController::class, 'upload'])->name('upload.document');

    // YouTube metadata fetch (AJAX)
    Route::post('/library/youtube-info', [\App\Http\Controllers\Admin\LibraryController::class, 'youtubeInfo'])->name('library.youtube-info');
});
