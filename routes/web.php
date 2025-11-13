<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvaliacaoController;


Route::get('/', [AvaliacaoController::class, 'index'])->name('avaliacao.index');

Route::post('/submit', [AvaliacaoController::class, 'store'])->name('avaliacao.store');

Route::get('/obrigado', function () {
    return view('avaliacao.obrigado');
})->name('avaliacao.obrigado');