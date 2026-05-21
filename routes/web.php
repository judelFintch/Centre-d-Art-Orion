<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormationAdminController;
use App\Http\Controllers\Admin\EvenementAdminController;
use App\Http\Controllers\Admin\GalerieAdminController;
use App\Http\Controllers\Admin\MessageAdminController;
use App\Http\Controllers\Admin\EquipeAdminController;

// ─── Site Public ───────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');

Route::prefix('formations')->name('formations.')->group(function () {
    Route::get('/', [FormationController::class, 'index'])->name('index');
    Route::get('/{formation:slug}', [FormationController::class, 'show'])->name('show');
});

Route::prefix('galerie')->name('galerie.')->group(function () {
    Route::get('/', [GalerieController::class, 'index'])->name('index');
});

Route::prefix('evenements')->name('evenements.')->group(function () {
    Route::get('/', [EvenementController::class, 'index'])->name('index');
    Route::get('/{evenement:slug}', [EvenementController::class, 'show'])->name('show');
});

Route::get('/equipe', [EquipeController::class, 'index'])->name('equipe');

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// ─── Back-office Admin ─────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('formations', FormationAdminController::class);
    Route::resource('evenements', EvenementAdminController::class);
    Route::resource('galerie', GalerieAdminController::class);
    Route::resource('messages', MessageAdminController::class)->only(['index', 'show', 'destroy']);
    Route::resource('equipe', EquipeAdminController::class);
});

// ─── Auth (Laravel Breeze / Fortify future) ────────────────────
Route::get('/admin/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');
