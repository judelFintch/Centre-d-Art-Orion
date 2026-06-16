<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormationAdminController;
use App\Http\Controllers\Admin\EvenementAdminController;
use App\Http\Controllers\Admin\GalerieAdminController;
use App\Http\Controllers\Admin\MessageAdminController;
use App\Http\Controllers\Admin\EquipeAdminController;
use App\Http\Controllers\Admin\HeroSlideAdminController;
use App\Http\Controllers\Admin\BlogPostAdminController;
use App\Http\Controllers\Admin\PodcastAdminController;
use App\Http\Controllers\BilletterieController;
use App\Http\Controllers\Admin\BilletAdminController;
use App\Http\Controllers\Admin\BilletCategorieAdminController;
use App\Http\Controllers\Admin\PaiementSettingAdminController;
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Admin\AbonnementAdminController;
use App\Http\Controllers\Admin\AnalyticsAdminController;
use App\Http\Controllers\Admin\MailSettingAdminController;
use App\Http\Controllers\Admin\PageSettingAdminController;
use App\Http\Controllers\Admin\ProfileAdminController;

// ─── Site Public ───────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/podcasts', [PodcastController::class, 'index'])->name('podcasts.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/categorie/{category}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

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
Route::get('/equipe/{equipe}', [EquipeController::class, 'show'])->name('equipe.show');

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    // Limite : 5 soumissions par minute par IP, puis 30 s de blocage
    Route::post('/', [ContactController::class, 'store'])->name('store')->middleware('throttle:5,1');
});

// ─── Billetterie ───────────────────────────────────────────────
Route::prefix('billetterie')->name('billetterie.')->group(function () {
    Route::get('/', [BilletterieController::class, 'index'])->name('index');
    Route::get('/confirmation/{reference}', [BilletterieController::class, 'confirmation'])->name('confirmation');
    Route::get('/{evenement:slug}', [BilletterieController::class, 'show'])->name('show');
    Route::post('/{evenement:slug}/reserver', [BilletterieController::class, 'store'])->name('store')->middleware('throttle:10,1');
});

// ─── Abonnements ───────────────────────────────────────────────
// Limite : 5 soumissions par minute par IP
Route::post('/abonnement', [AbonnementController::class, 'store'])->name('abonnement.store')->middleware('throttle:5,1');
Route::get('/abonnement/desinscription/{token}', [AbonnementController::class, 'unsubscribe'])->name('abonnement.unsubscribe');

// ─── Analytics (tracking côté client) ─────────────────────────
Route::prefix('analytics')->name('analytics.')->middleware('throttle:60,1')->group(function () {
    Route::post('/track',  [AnalyticsController::class, 'track'])->name('track');
    Route::post('/update', [AnalyticsController::class, 'update'])->name('update');
});

// ─── Back-office Admin ─────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileAdminController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileAdminController::class, 'update'])->name('profile.update');
    Route::resource('formations', FormationAdminController::class);
    Route::resource('evenements', EvenementAdminController::class);
    Route::patch('evenements/{evenement}/toggle', [EvenementAdminController::class, 'toggleActif'])->name('evenements.toggle');
    Route::resource('galerie', GalerieAdminController::class);
    Route::resource('blog', BlogPostAdminController::class);
    Route::resource('podcasts', PodcastAdminController::class);
    Route::resource('messages', MessageAdminController::class)->only(['index', 'show', 'destroy']);
    Route::get('abonnements', [AbonnementAdminController::class, 'index'])->name('abonnements.index');
    Route::delete('abonnements/{abonnement}', [AbonnementAdminController::class, 'destroy'])->name('abonnements.destroy');

    // Analytics
    Route::get('analytics', [AnalyticsAdminController::class, 'index'])->name('analytics.index');

    // Configuration mail
    Route::get('mail', [MailSettingAdminController::class, 'index'])->name('mail.index');
    Route::put('mail', [MailSettingAdminController::class, 'update'])->name('mail.update');
    Route::post('mail/test', [MailSettingAdminController::class, 'test'])->name('mail.test');
    Route::resource('equipe', EquipeAdminController::class);
    Route::patch('equipe/{equipe}/toggle', [EquipeAdminController::class, 'toggleActif'])->name('equipe.toggle');
    Route::post('equipe/reorder', [EquipeAdminController::class, 'reorder'])->name('equipe.reorder');

    // Billetterie
    // Catégories de billets
    Route::post('billets/categories/{evenement}',              [BilletCategorieAdminController::class, 'store'])->name('billets.categories.store');
    Route::patch('billets/categories/{categorie}/update',      [BilletCategorieAdminController::class, 'update'])->name('billets.categories.update');
    Route::patch('billets/categories/{categorie}/toggle',      [BilletCategorieAdminController::class, 'toggle'])->name('billets.categories.toggle');
    Route::delete('billets/categories/{categorie}',            [BilletCategorieAdminController::class, 'destroy'])->name('billets.categories.destroy');
    Route::post('billets/categories/reorder',                  [BilletCategorieAdminController::class, 'reorder'])->name('billets.categories.reorder');

    Route::get('billets',                          [BilletAdminController::class, 'index'])->name('billets.index');
    Route::get('billets/export',                   [BilletAdminController::class, 'export'])->name('billets.export');
    Route::post('billets/bulk',                    [BilletAdminController::class, 'bulkUpdate'])->name('billets.bulk');
    Route::get('billets/create',                   [BilletAdminController::class, 'create'])->name('billets.create');
    Route::post('billets',                         [BilletAdminController::class, 'store'])->name('billets.store');
    Route::get('billets/evenement/{evenement}',    [BilletAdminController::class, 'byEvent'])->name('billets.by-event');
    Route::get('billets/{billet}',                 [BilletAdminController::class, 'show'])->name('billets.show');
    Route::get('billets/{billet}/edit',            [BilletAdminController::class, 'edit'])->name('billets.edit');
    Route::put('billets/{billet}',                 [BilletAdminController::class, 'update'])->name('billets.update');
    Route::patch('billets/{billet}/statut',        [BilletAdminController::class, 'updateStatut'])->name('billets.statut');
    Route::patch('billets/{billet}/verifier',      [BilletAdminController::class, 'verifierPaiement'])->name('billets.verifier');
    Route::delete('billets/{billet}',              [BilletAdminController::class, 'destroy'])->name('billets.destroy');

    // Paramètres paiement
    Route::get('paiement/settings',  [PaiementSettingAdminController::class, 'index'])->name('paiement.index');
    Route::put('paiement/settings',  [PaiementSettingAdminController::class, 'update'])->name('paiement.update');

    // Contenu des pages (Home / À propos)
    Route::get('pages/home',   [PageSettingAdminController::class, 'home'])->name('pages.home');
    Route::put('pages/home',   [PageSettingAdminController::class, 'updateHome'])->name('pages.home.update');
    Route::get('pages/about',  [PageSettingAdminController::class, 'about'])->name('pages.about');
    Route::put('pages/about',  [PageSettingAdminController::class, 'updateAbout'])->name('pages.about.update');

    // Hero Slides
    Route::resource('hero', HeroSlideAdminController::class)->except(['show']);
    Route::post('hero/load-defaults', [HeroSlideAdminController::class, 'loadDefaults'])->name('hero.load-defaults');
    Route::post('hero/reorder', [HeroSlideAdminController::class, 'reorder'])->name('hero.reorder');
    Route::patch('hero/{hero}/toggle', [HeroSlideAdminController::class, 'toggleActif'])->name('hero.toggle');
});

// ─── Auth ──────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {

    Route::get('/admin/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/admin/login', function (Request $request) {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    });

});

Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/admin/login');
})->name('logout');
