<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('/auth/login');})->name('login');
Route::post('/login', [LoginController::class, 'autenticar']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function() {return view('/components/layout');})->name('home');

    Route::get('/clientes', [ClientController::class, 'index'])->name('clientes.index');
    Route::post('/clientes', [ClientController::class, 'store'])->name('clientes.store');
    Route::put('/clientes/{id}', [ClientController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClientController::class, 'destroy'])->name('clientes.destroy');

    Route::get('/relatorios/clientes', [RelatorioController::class, 'index'])->name('relatorios.clientes');
    Route::get('/relatorios/imprimir', [RelatorioController::class, 'imprimir'])->name('relatorios.imprimir');

    Route::post('/sair', [LoginController::class, 'sair'])->name('logout');
});


