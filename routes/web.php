<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
=======
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'home']);
Route::get('/transaction', [DashboardController::class, 'index']);
Route::get('/new_transaction', [DashboardController::class, 'create']);
Route::get('/edit_transaction/{id}', [DashboardController::class, 'edit']);

Route::get('/get_transaction', [DashboardController::class, 'getData']);
>>>>>>> frontend_development
