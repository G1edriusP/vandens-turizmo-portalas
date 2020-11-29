<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
    index
    create
    store
    show 
    edit 
    update
    delete
*/

Route::get('/', [App\Http\Controllers\RoutesController::class, 'index'])->name('marsrutai');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Users
Route::get('/vartotojai', [App\Http\Controllers\UsersController::class, 'index'])->name('vartotojai');
Route::get('/vartotojai/sukurti', [App\Http\Controllers\UsersController::class, 'create'])->name('vartotojai_sukurti');
Route::post('/vartotojai/sukurti', [App\Http\Controllers\UsersController::class, 'store']);
Route::get('/vartotojas/{user}', [App\Http\Controllers\UsersController::class, 'show'])->name('vartotojas');
Route::get('/vartotojai/salinti/{user}', [App\Http\Controllers\UsersController::class, 'showDelete']);
Route::get('/vartotojai/redaguoti/{user}', [App\Http\Controllers\UsersController::class, 'edit']);
Route::put('/vartotojai/redaguoti/{user}', [App\Http\Controllers\UsersController::class, 'update'])->name('vartotojas_redaguoti');
Route::delete('/vartotojai/salinti/{user}', [App\Http\Controllers\UsersController::class, 'destroy']);

// Routes
Route::get('/marsrutai', [App\Http\Controllers\RoutesController::class, 'index'])->name('marsrutai');
Route::get('/marsrutai/sukurti', [App\Http\Controllers\RoutesController::class, 'create'])->name('marsrutai_sukurti');
Route::post('/marsrutai/sukurti', [App\Http\Controllers\RoutesController::class, 'store']);
Route::get('/marsrutai/{route}', [App\Http\Controllers\RoutesController::class, 'show']);
Route::get('/marsrutai/salinti/{route}', [App\Http\Controllers\RoutesController::class, 'showDelete']);
Route::get('/marsrutai/redaguoti/{route}', [App\Http\Controllers\RoutesController::class, 'edit']);
Route::put('/marsrutai/redaguoti/{route}', [App\Http\Controllers\RoutesController::class, 'update'])->name('marsrutas_redaguoti');
Route::delete('/marsrutai/salinti/{route}', [App\Http\Controllers\RoutesController::class, 'destroy']);

// Reservations
Route::get('/rezervacijos', [App\Http\Controllers\ReservationsController::class, 'index'])->name('rezervacijos');
Route::get('/rezervuoti/{route}', [App\Http\Controllers\ReservationsController::class, 'create'])->name('rezervuoti');
Route::post('/rezervuoti/{route}', [App\Http\Controllers\ReservationsController::class, 'store'])->name('rezervacija_sukurti');
Route::get('/rezervacijos/{reservation}', [App\Http\Controllers\ReservationsController::class, 'show']);
Route::get('/rezervacijos/salinti/{reservation}', [App\Http\Controllers\ReservationsController::class, 'showDelete']);
Route::get('/rezervacijos/redaguoti/{reservation}', [App\Http\Controllers\ReservationsController::class, 'edit']);
Route::put('/rezervacijos/redaguoti/{reservation}', [App\Http\Controllers\ReservationsController::class, 'update'])->name('rezervacija_redaguoti');
Route::delete('/rezervacijos/salinti/{reservation}', [App\Http\Controllers\ReservationsController::class, 'destroy']);