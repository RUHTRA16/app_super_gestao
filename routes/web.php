<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\home_controller::class, 'home'])->name('Página_Inicial');
Route::get('/sobreNos', [\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name('Sobre-Nós');
Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('Contato');
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('Login');
Route::get('/cadastro', [\App\Http\Controllers\CadastroController::class, 'cadastro'])->name('Cadastro');

Route::get('/esqueci_senha', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showForgot'])->name('password.request');
Route::post('/esqueci_senha', [\App\Http\Controllers\Auth\PasswordResetController::class, 'sendResetLink']);

Route::get('/reset-senha/{token}', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showReset'])->name('password.reset');
Route::post('/reset-senha', [\App\Http\Controllers\Auth\PasswordResetController::class, 'reset']);


Route::prefix('/app')->group(function(){
    Route::get('/fornecedores', function(){return 'fornecedores';})->name('app.fornecedores');
    Route::get('/clientes', function(){return 'clientes';})->name('app.clientes');
    Route::get('/produtos', function(){return 'produtos';})->name('app.produtos');
});

Route::get('/teste/{p1}/{p2}', [\App\Http\Controllers\TesteController::class, 'teste'])->name('teste');

/*Route::get('/rota2', function(){
    return redirect()->route('site.rota1');
})->name('site.rota2');*/

//Route::redirect('/rota2','/rota1');

Route::fallback(function(){
    echo 'A rota acessada não existe. <a href="'.route('Página_Inicial').'">Clique aqui</a> para ir para a página inicial';
});