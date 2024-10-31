<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\EmployeController;
use App\Http\Middleware\CheckRole;

//Route de Sam pour menu test
Route::get('/loginEmploye', 
[FournisseurController::class, 'index'])->name('index');


//Route de Sam pour liste fournisseur
Route::get('/fournisseurs/{fournisseur}/',
[FournisseurController::class, 'show'])->name('fournisseurs.show');


//Route de Sam pour les role
Route::get('/Gestion_des_roles', 
[EmployeController::class, 'afficherRole'])->name('role')
->middleware('CheckRole:Administrateur');

Route::get('/employes/creation',
[EmployeController::class, 'create'])->name('employes.create')
->middleware('CheckRole:Administrateur');

Route::post('/employes',
[EmployeController::class, 'store'])->name('employes.store')
->middleware('CheckRole:Administrateur');

//Route pour le delete d'employé
Route::delete('/supprimerEmploye',
[EmployeController::class, 'destroy'])->name('supprimerEmploye')
->middleware('CheckRole:Administrateur');

//Route pour modifier le role des employé
Route::patch('/modifierEmploye',
[EmployeController::class, 'update'])->name('modifierEmploye')
->middleware('CheckRole:Administrateur');


//Route pour le login d'employe
Route::get('/loginEmploye', 
[EmployeController::class, 'showLoginForm'])->name('loginEmploye');

Route::post('/loginEmploye', 
[EmployeController::class, 'login'])->name('loginPost');

Route::post('/logout', 
[EmployeController::class, 'logout'])->name('logout');

//route pour parametre
Route::get('/parametre',
[EmployeController::class, 'afficherParametre'])->name('parametre')
->middleware('CheckRole:Administrateur');

Route::patch('modifierParametre', 
[EmployeController::class ,'updateParam'])->name('modifierParam');

//route pour ajouter les role de courriel
//route pour la gestion des courriels
Route::get('/modeleCourriel',
[EmployeController::class, 'afficherModeleCourriel'])->name('modeleCourriel')
->middleware('CheckRole:Administrateur');

Route::post('/employes/courrielRoleEnregistre',
[EmployeController::class, 'storeCourrielRole'])->name('employes.storeCourrielRole')
->middleware('CheckRole:Administrateur');

//Route pour modifier les modele de courriel et les parametre
Route::patch('/modifierCourriel',
[EmployeController::class, 'updateCourriel'])->name('modifierCourriel')
->middleware('CheckRole:Administrateur');

//Route pour le delete d'employé
Route::delete('/supprimerRoleCourriel',
[EmployeController::class, 'destroyRoleCourriel'])->name('supprimerRoleCourriel')
->middleware('CheckRole:Administrateur');

//route pour les parametre

//route welcome
Route::get('/', function () {
    return view('welcome');
});

//Route des endpoints
Route::get('/neq/{neq}', [ApiController::class, 'fetchFromNeq']);
Route::get('/regions', [ApiController::class, 'fetchRegions']);
Route::get('/ville/{region}', [ApiController::class, 'fetchVille']);
Route::get('/ville', [ApiController::class, 'fetchAllVille']);
Route::get('/segment', [ApiController::class, 'fetchUNSPSCSegment']);
Route::get('/family/{segment}', [ApiController::class, 'fetchUNSPSCFamily']);
Route::get('/class/{family}', [ApiController::class, 'fetchUNSPSCClass']);
Route::get('/comodity/{class}', [ApiController::class, 'fetchUNSPSCComodity']);
Route::get('/comoditySearch/{start}/{number}', [ApiController::class, 'fetchUNSPSCComodityFromName']);

Route::get('/liste', [GestionController::class, 'listeFournisseur'])->name('pageCommis.liste');
Route::get('/liste-contact', [GestionController::class, 'listeContact'])->name('pageCommis.liste-contact');
Route::get('/export-fournisseurs', [GestionController::class, 'exportFournisseurs'])->name('export.fournisseurs');
Route::get('/fournisseur/{fournisseur}', [GestionController::class, 'zoom'])->name('pageCommis.fiche');

Route::patch('/fournisseur/{fournisseur}/modifier',
[GestionController::class, 'updateFiche'])->name('updateFiche')
->middleware('CheckRole:Administrateur, Responsable');
