<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/neq/{neq}', [ApiController::class, 'fetchFromNeq']);
Route::get('/regions', [ApiController::class, 'fetchRegions']);
