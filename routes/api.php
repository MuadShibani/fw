<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\InvestorController;
use App\Http\Controllers\Api\StartupController;
use App\Http\Controllers\Api\CohortController;
use App\Http\Controllers\Api\WiifPortfolioController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\StatController;
use App\Http\Controllers\Api\ProgramController;

/*
|--------------------------------------------------------------------------
| Public Routes — no authentication required
|--------------------------------------------------------------------------
*/

// Auth
Route::post('/auth/login', [AuthController::class, 'login']);

// Public read endpoints (used by the frontend)
Route::get('/news',              [NewsController::class,         'index']);
Route::get('/news/{id}',         [NewsController::class,         'show']);

Route::get('/blog',              [BlogController::class,         'index']);
Route::get('/blog/{id}',         [BlogController::class,         'show']);

Route::get('/library',           [LibraryController::class,      'index']);
Route::get('/library/{id}',      [LibraryController::class,      'show']);

Route::get('/events',            [EventController::class,        'index']);
Route::get('/events/{id}',       [EventController::class,        'show']);

Route::get('/investors',         [InvestorController::class,     'index']);
Route::get('/investors/{id}',    [InvestorController::class,     'show']);

Route::get('/startups',          [StartupController::class,      'index']);
Route::get('/startups/{id}',     [StartupController::class,      'show']);

Route::get('/cohorts',           [CohortController::class,       'index']);
Route::get('/cohorts/{id}',      [CohortController::class,       'show']);

Route::get('/wiif-portfolio',    [WiifPortfolioController::class,'index']);
Route::get('/wiif-portfolio/{id}',[WiifPortfolioController::class,'show']);

Route::get('/pages',             [PageController::class,         'index']);
Route::get('/pages/{key}',       [PageController::class,         'show']);

Route::get('/stats',             [StatController::class,         'index']);
Route::get('/programs',          [ProgramController::class,      'index']);
Route::get('/programs/{id}',     [ProgramController::class,      'show']);

Route::get('/settings',          [SettingController::class,      'index']);
Route::get('/settings/{key}',    [SettingController::class,      'show']);

// Public: submit contact form
Route::post('/messages',         [MessageController::class,      'store']);

/*
|--------------------------------------------------------------------------
| Protected Routes — require Sanctum token (admin only)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::get('/auth/me',                  [AuthController::class,          'me']);
    Route::post('/auth/logout',             [AuthController::class,          'logout']);
    Route::post('/auth/change-password',    [AuthController::class,          'changePassword']);

    // Dashboard
    Route::get('/dashboard',               [DashboardController::class,     'index']);

    // News — write operations
    Route::post('/news',                   [NewsController::class,           'store']);
    Route::put('/news/{id}',               [NewsController::class,           'update']);
    Route::delete('/news/{id}',            [NewsController::class,           'destroy']);

    // Blog — write operations
    Route::post('/blog',                   [BlogController::class,           'store']);
    Route::put('/blog/{id}',               [BlogController::class,           'update']);
    Route::delete('/blog/{id}',            [BlogController::class,           'destroy']);

    // Library — write operations
    Route::post('/library',                [LibraryController::class,        'store']);
    Route::put('/library/{id}',            [LibraryController::class,        'update']);
    Route::delete('/library/{id}',         [LibraryController::class,        'destroy']);

    // Events — write operations
    Route::post('/events',                 [EventController::class,          'store']);
    Route::put('/events/{id}',             [EventController::class,          'update']);
    Route::delete('/events/{id}',          [EventController::class,          'destroy']);

    // Investors — write operations
    Route::post('/investors',              [InvestorController::class,       'store']);
    Route::put('/investors/{id}',          [InvestorController::class,       'update']);
    Route::delete('/investors/{id}',       [InvestorController::class,       'destroy']);

    // Startups — write operations
    Route::post('/startups',               [StartupController::class,        'store']);
    Route::put('/startups/{id}',           [StartupController::class,        'update']);
    Route::delete('/startups/{id}',        [StartupController::class,        'destroy']);

    // Cohorts — write operations
    Route::post('/cohorts',                [CohortController::class,         'store']);
    Route::put('/cohorts/{id}',            [CohortController::class,         'update']);
    Route::delete('/cohorts/{id}',         [CohortController::class,         'destroy']);

    // WIIF Portfolio — write operations
    Route::post('/wiif-portfolio',         [WiifPortfolioController::class,  'store']);
    Route::put('/wiif-portfolio/{id}',     [WiifPortfolioController::class,  'update']);
    Route::delete('/wiif-portfolio/{id}',  [WiifPortfolioController::class,  'destroy']);

    // Pages — admin update only (pages are not created/deleted, only edited)
    Route::put('/pages/{key}',             [PageController::class,           'update']);

    // Messages — admin read / manage
    Route::get('/messages',                [MessageController::class,        'index']);
    Route::put('/messages/{id}/read',      [MessageController::class,        'markRead']);
    Route::delete('/messages/{id}',        [MessageController::class,        'destroy']);

    // Settings — write operations
    Route::post('/settings',               [SettingController::class,        'upsert']);
    Route::post('/settings/batch',         [SettingController::class,        'updateMany']);

    // Stats — write operations
    Route::post('/stats',                  [StatController::class,           'store']);
    Route::put('/stats/{id}',              [StatController::class,           'update']);
    Route::delete('/stats/{id}',           [StatController::class,           'destroy']);

    // Programs — write operations
    Route::post('/programs',               [ProgramController::class,        'store']);
    Route::put('/programs/{id}',           [ProgramController::class,        'update']);
    Route::delete('/programs/{id}',        [ProgramController::class,        'destroy']);
});
