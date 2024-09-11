<?php

use App\Http\Controllers\FournisseurController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ajouter',[FournisseurController::class,'create_identification']);
Route::get('/ajouter_service',[FournisseurController::class,'create_service'])->name('create_service');

Route::post('/ajouter_identification',[FournisseurController::class,'store_identification'])->name('store_indetification');
Route::post('/ajouter_service',[FournisseurController::class,'store_service'])->name('store_service');
