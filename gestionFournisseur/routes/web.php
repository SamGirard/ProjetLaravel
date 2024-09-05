<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseurController;


Route::get('/', 
[FournisseurController::class, 'index'])->name('index');

Route::get('/fournisseurs/{fournisseur}/',
[FournisseurController::class, 'show'])->name('fournisseurs.show');
