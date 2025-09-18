<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\home_controller::class, 'home'])->name('Página_Inicial');
Route::get('/sobreNos', [\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name('Sobre-Nós');
Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('Contato');
Route::get('/login', function(){ return 'login';});

Route::prefix('/app')->group(function(){
    Route::get('/fornecedores', function(){return 'fornecedores';})->name('app.fornecedores');
    Route::get('/clientes', function(){return 'clientes';})->name('app.clientes');
    Route::get('/produtos', function(){return 'produtos';})->name('app.produtos');
});
