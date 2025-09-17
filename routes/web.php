<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\home_controller::class, 'home']);
Route::get('/sobreNos', [\App\Http\Controllers\SobreNosController::class, 'sobreNos']);
Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato']);
Route::get('/login', function(){ return 'login';});

Route::prefix('/app')->group(function(){
    Route::get('/fornecedores', function(){return 'fornecedores';});
    Route::get('/clientes', function(){return 'clientes';});
    Route::get('/produtos', function(){return 'produtos';});
});
