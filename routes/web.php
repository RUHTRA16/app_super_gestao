<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\home_controller;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\tela_LoginController;
use App\Http\Controllers\CadastroController;

use App\Http\Controllers\AuthController; // controller que vai ter login/register/logout
use App\Http\Controllers\Auth\PasswordResetController;

/*
|--------------------------------------------------------------------------
| Site (público)
|--------------------------------------------------------------------------
*/
Route::get('/', [home_controller::class, 'home'])->name('Página_Inicial');
Route::get('/sobreNos', [SobreNosController::class, 'sobreNos'])->name('Sobre-Nós');
Route::get('/contato', [ContatoController::class, 'contato'])->name('Contato');
Route::get('/home', fn () => redirect()->route('dashboard'));

/*
|--------------------------------------------------------------------------
| Autenticação (telas + ações)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [tela_LoginController::class, 'tela_Login'])->name('login');
    Route::get('/tela_login', [tela_LoginController::class, 'tela_Login'])->name('Login');

    // Cadastro (tela + ação)
    Route::get('/cadastro', [CadastroController::class, 'cadastro'])->name('register');
    Route::post('/register', [CadastroController::class, 'store'])->name('register.post');

    // Login (ação)
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Esqueci a senha / reset
    Route::get('/esqueci_senha', [PasswordResetController::class, 'showForgot'])->name('password.request');
    Route::post('/esqueci_senha', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

    Route::get('/reset-senha/{token}', [PasswordResetController::class, 'showReset'])->name('password.reset');
    Route::post('/reset-senha', [PasswordResetController::class, 'reset'])->name('password.update');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard (protegido)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| App (protegido)
|--------------------------------------------------------------------------
*/
Route::prefix('/app')->middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('app.dashboard'))->name('app.dashboard');

    Route::get('/alunos', fn () => view('app.alunos.index'))->name('app.alunos.index');
    Route::get('/notas', fn () => view('app.notas.index'))->name('app.notas.index');
    Route::get('/chamadas', fn () => view('app.chamadas.index'))->name('app.chamadas.index');
});

/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    echo 'A rota acessada não existe. <a href="' . route('Página_Inicial') . '">Clique aqui</a> para ir para a página inicial';
});