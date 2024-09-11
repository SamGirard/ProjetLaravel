<?php

use App\Http\Controllers\FournisseurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\EmployeController;


Route::get('/',
[FournisseurController::class, 'index'])->name('index');

Route::get('/fournisseurs/{fournisseur}/',
[FournisseurController::class, 'show'])->name('fournisseurs.show');

Route::get('/Gestion_des_roles',
[EmployeController::class, 'index'])->name('role');


Route::get('/ajouter',[FournisseurController::class,'create_identification']);
Route::get('/ajouter_service',[FournisseurController::class,'create_service'])->name('create_service');

Route::post('/ajouter_identification',[FournisseurController::class,'store_identification'])->name('store_indetification');
Route::post('/ajouter_service',[FournisseurController::class,'store_service'])->name('store_service');


Route::get('/neq/{neq}', [ApiController::class, 'fetchFromNeq']);
Route::get('/regions', [ApiController::class, 'fetchRegions']);
Route::get('/segment', [ApiController::class, 'fetchUNSPSCSegment']);
Route::get('/family/{segment}', [ApiController::class, 'fetchUNSPSCFamily']);
Route::get('/class/{family}', [ApiController::class, 'fetchUNSPSCClass']);
Route::get('/comodity/{class}', [ApiController::class, 'fetchUNSPSCComodity']);
Route::get('/liste', [GestionController::class, 'listeFournisseur']);

