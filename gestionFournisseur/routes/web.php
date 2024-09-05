<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/neq/{neq}', [ApiController::class, 'fetchFromNeq']);
Route::get('/regions', [ApiController::class, 'fetchRegions']);
Route::get('/segment', [ApiController::class, 'fetchUNSPSCSegment']);
Route::get('/family/{segment}', [ApiController::class, 'fetchUNSPSCFamily']);
Route::get('/class/{family}', [ApiController::class, 'fetchUNSPSCClass']);
Route::get('/comodity/{class}', [ApiController::class, 'fetchUNSPSCComodity']);