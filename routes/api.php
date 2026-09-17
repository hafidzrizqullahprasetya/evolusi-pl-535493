<?php

use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;

Route::get('/tugas', [TugasController::class, 'index']);
Route::get('/tugas/{tugas}', [TugasController::class, 'show']);
