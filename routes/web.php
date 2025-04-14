<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FeuilleDeMarcheController;
use App\Http\Controllers\TypeFMController;
use App\Http\Controllers\UniteController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\OutilMesureController;
use App\Http\Controllers\UniteMesureController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\TravauxUrgenceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes publiques
Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'home')->name('app_home');
});

// Routes d'authentification
Route::controller(LoginController::class)->group(function() {
    Route::get('/logout', 'logout')->name('app_logout');
    Route::post('/exist_email', 'existEmail')->name('app_exist_email');
    Route::match(['get', 'post'], '/activation_code/{token}', 'activation_Code')->name('app_activation_code');
    Route::get('/user_checker', 'userChecker')->name('app_user_checker');
    Route::get('/resend_activation_code/{token}', 'resendActivationCode')->name('app_resend_activation_code');
    Route::get('/activation_account_link/{token}', 'activationAccountLink')->name('app_activation_account_link');
    Route::match(['get', 'post'], '/activation_account_change_email/{token}', 'activationAccountChangeEmail')->name('app_activation_account_change_email');
    Route::match(['get', 'post'], '/forgot_password','forgotPassword')->name('app_forgot_password');
});

// Routes protégées par authentification
Route::middleware(['auth'])->group(function() {
    // Dashboard
    Route::match(['get','post'],'/dashboard', [HomeController::class, 'dashboard'])->name('app_dashboard');

    Route::prefix('feuille-marche')->group(function () {
        Route::get('/{id}/detail', [FeuilleDeMarcheController::class, 'show'])
             ->name('feuille-marche.show');

        Route::post('/{id_fm}/parametres', [FeuilleDeMarcheController::class, 'storeParametres'])
             ->name('feuille-marche.store-parametres');
    });
    Route::resource('feuille-marche', FeuilleDeMarcheController::class)->names([
        'index' => 'feuille-marche.index',
        // other route names...
    ]);
    // Types FM
    Route::resource('type-fm', TypeFMController::class)->except(['show']);

    // Unités de production
    Route::resource('unite', UniteController::class);

    // Paramètres
    Route::resource('parametre', ParametreController::class);

    // Outils de mesure
    Route::resource('outil-mesure', OutilMesureController::class)->except(['show']);

    // Unités de mesure
    Route::resource('unite-mesure', UniteMesureController::class)->except(['show']);

    // Equipes
    Route::resource('equipe', EquipeController::class);

    // Employés
    Route::resource('employe', EmployeController::class);

    // Rapports
    Route::resource('rapport', RapportController::class);

    // Travaux d'urgence
    Route::resource('travaux-urgence', TravauxUrgenceController::class);

    // Routes supplémentaires
    Route::get('/parametres-global', [ParametreController::class, 'indexGlobal'])
        ->name('parametres.global');
});
// Routes d'export - Protégées par authentification
Route::middleware(['auth'])->prefix('exports')->group(function() {
    Route::get('/dashboard/excel', [ExportController::class, 'exportDashboardExcel'])
         ->name('dashboard.export.excel');

    Route::get('/dashboard/pdf', [ExportController::class, 'exportDashboardPdf'])
         ->name('dashboard.export.pdf');

    Route::get('/dashboard/custom', [ExportController::class, 'exportDashboardCustom'])
         ->name('dashboard.export.custom');

    // Ajoutez d'autres routes d'export au besoin
    Route::get('/feuilles-marche/excel', [ExportController::class, 'exportFeuillesMarcheExcel'])
         ->name('feuille-marche.export.excel');
    Route::get('/feuilles-marche/pdf', [ExportController::class, 'exportFeuillesMarchepdf'])
         ->name('feuille-marche.export.pdf');
         Route::get('/employes/excel', [ExportController::class, 'exportEmployesExcel'])
         ->name('employe.export.excel');

    Route::get('/employes/pdf', [ExportController::class, 'exportEmployesPdf'])
         ->name('employe.export.pdf');
         Route::get('/rapports/excel', [ExportController::class, 'exportRapportsExcel'])
         ->name('rapport.export.excel');

    Route::get('/rapports/pdf', [ExportController::class, 'exportRapportsPdf'])
         ->name('rapport.export.pdf');
});
Route::get('/equipe/{id_equipe}', [EquipeController::class, 'show'])->name('equipe.show');
Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');
Route::get('/qualite', [QualiteController::class, 'index'])->name('qualite.index');
// Paramètres
Route::resource('parametres', ParametreController::class);

// Outils de mesure
Route::resource('outils-mesure', OutilMesureController::class);

// Unités de mesure
Route::resource('unites-mesure', UniteMesureController::class);

// Edition des rapports
Route::get('/rapports/edition', [RapportController::class, 'edition'])->name('rapport.edit');
// Rapports
Route::prefix('rapports')->group(function () {
    Route::get('/journalier', [RapportController::class, 'journalier'])->name('typerapport.journalier');
    Route::get('/mensuel', [RapportController::class, 'mensuel'])->name('typerapport.mensuel');
    Route::get('/annuel', [RapportController::class, 'annuel'])->name('typerapport.annuel');
});

