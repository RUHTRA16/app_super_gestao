<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\home_controller::class, 'home']);

Route::get('/sobre-nos', [\App\Http\Controllers\SobreNosController::class, 'sobreNos']);

Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato']);

Route::get (
    '/contato/{nome}/{categoria}/{assunto}/{mensagem?}',
    function(string $nome, string $categoria, string $assunto, string $mensagem = "Mensagem não preenchida"){
       echo "Estamos aqui: $nome - $categoria - $assunto - $mensagem";
    }
);

Route::get (
    '/contato/{nome}/{categoria_id}',
    function(
        string $nome = 'Desconhecido',
             int $categoria_id = 1 // 1 - Categoria
             ) {
        echo "Estamos aqui: $nome - $categoria_id";
             }
)->where('categoria_id','[0-9]+',)->where('nome', '[A-Za-z]+');