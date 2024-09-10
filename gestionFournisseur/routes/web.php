<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\EmployeController;


Route::get('/', 
[FournisseurController::class, 'index'])->name('index');

Route::get('/fournisseurs/{fournisseur}/',
[FournisseurController::class, 'show'])->name('fournisseurs.show');

Route::get('/Gestion_des_roles', 
[EmployeController::class, 'index'])->name('role');
