<?php

use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('ajouter_identification',[FournisseurController::class,'create_identification'])->name('create_identification');
Route::post('ajouter_identification',[FournisseurController::class,'store_identification'])->name('store_identification');
Route::get('ajouter_service/{neq?}',[FournisseurController::class,'create_service'])->name('create_service');
Route::post('ajouter_service',[FournisseurController::class,'store_service'])->name('store_service');
Route::get('ajouter_coordonnee/',[FournisseurController::class,'create_coordonnee'])->name('create_coordonnee');
Route::post('ajouter_coordonnee',[FournisseurController::class,'store_coordonnee'])->name('store_coordonnee');
Route::get('ajouter_contact',[FournisseurController::class,'create_contact'])->name('create_contact');
Route::post('ajouter_contact',[FournisseurController::class,'store_contact'])->name('store_contact');
Route::get('ajouter_brochure/',[FournisseurController::class,'create_brochure'])->name('create_brochure');
Route::post('ajouter_brochure',[FournisseurController::class,'store_brochure'])->name('store_brochure');

Route::get('/chercherService/{value}',[FournisseurController::class,'chercherService'])->name('cherherService');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('/supprimer-contact/{id}',[ProfileController::class,'destroyContact'])->name('supprimer-contact');
    Route::get('ajouter_contact',[ProfileController::class,'create_contact'])->name('profil.create_contact');
});


Route::get('/neq/{neq}', [ApiController::class, 'fetchFromNeq']);
Route::get('/regions', [ApiController::class, 'fetchRegions']);
Route::get('/segment', [ApiController::class, 'fetchUNSPSCSegment']);
Route::get('/family/{segment}', [ApiController::class, 'fetchUNSPSCFamily']);
Route::get('/class/{family}', [ApiController::class, 'fetchUNSPSCClass']);
Route::get('/comodity/{class}', [ApiController::class, 'fetchUNSPSCComodity']);
Route::get('/liste', [GestionController::class, 'listeFournisseur']);


require __DIR__.'/auth.php';
