<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ImportFileController::class, 'index'])->name('import-csv');
Route::post('/import-csv', [\App\Http\Controllers\ImportFileController::class, 'processData'])->name('import-csv.import');
Route::get('/homeowners', [\App\Http\Controllers\ImportFileController::class, 'show'])->name('import-csv.homeowners.show');
