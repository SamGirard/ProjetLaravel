<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\EmployeController;

//Route de Sam pour menu test
Route::get('/MenuTest', 
[FournisseurController::class, 'index'])->name('index');


//Route de Sam pour liste fournisseur
Route::get('/fournisseurs/{fournisseur}/',
[FournisseurController::class, 'show'])->name('fournisseurs.show');


//Route de Sam pour les role
Route::get('/Gestion_des_roles', 
[EmployeController::class, 'index'])->name('role');

Route::get('/employes/creation',
[EmployeController::class, 'create'])->name('employes.create');

Route::post('/employes',
[EmployeController::class, 'store'])->name('employes.store');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/neq/{neq}', [ApiController::class, 'fetchFromNeq']);
Route::get('/regions', [ApiController::class, 'fetchRegions']);
Route::get('/segment', [ApiController::class, 'fetchUNSPSCSegment']);
Route::get('/family/{segment}', [ApiController::class, 'fetchUNSPSCFamily']);
Route::get('/class/{family}', [ApiController::class, 'fetchUNSPSCClass']);
Route::get('/comodity/{class}', [ApiController::class, 'fetchUNSPSCComodity']);
Route::get('/liste', [GestionController::class, 'listeFournisseur']);
