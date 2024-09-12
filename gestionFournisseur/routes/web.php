<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\EmployeController;


Route::get('/', 
[FournisseurController::class, 'index'])->name('index');

Route::get('/fournisseurs/{fournisseur}/',
[FournisseurController::class, 'show'])->name('fournisseurs.show');

Route::get('/Gestion_des_roles', 
[EmployeController::class, 'index'])->name('role');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/neq/{neq}', [ApiController::class, 'fetchFromNeq']);
Route::get('/regions', [ApiController::class, 'fetchRegions']);
Route::get('/ville/{region}', [ApiController::class, 'fetchVille']);
Route::get('/ville', [ApiController::class, 'fetchAllVille']);
Route::get('/segment', [ApiController::class, 'fetchUNSPSCSegment']);
Route::get('/family/{segment}', [ApiController::class, 'fetchUNSPSCFamily']);
Route::get('/class/{family}', [ApiController::class, 'fetchUNSPSCClass']);
Route::get('/comodity/{class}', [ApiController::class, 'fetchUNSPSCComodity']);
Route::get('/comoditySearch/{comodity}/{start}/{number}', [ApiController::class, 'fetchUNSPSCComodityFromName']);
Route::get('/liste', [GestionController::class, 'listeFournisseur']);
