<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\home_controller;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\tela_LoginController;
use App\Http\Controllers\CadastroController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| Site (público)
|--------------------------------------------------------------------------
*/
Route::get('/', [home_controller::class, 'home'])->name('Página_Inicial');
Route::get('/sobreNos', [SobreNosController::class, 'sobreNos'])->name('Sobre-Nós');
Route::get('/contato', [ContatoController::class, 'contato'])->name('Contato');

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
| Dashboard geral
|--------------------------------------------------------------------------
| Se você quiser, pode mandar tudo pro /app/dashboard
*/
Route::get('/dashboard', fn () => redirect()->route('app.dashboard'))
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| App (protegido) - ÁREA LOGADA
|--------------------------------------------------------------------------
*/
Route::prefix('/app')->middleware('auth')->group(function () {

    // Dashboard (serve pra admin e aluno)
    Route::get('/dashboard', fn () => view('app.dashboard'))->name('app.dashboard');

    // Telas que o ALUNO pode ver
    Route::get('/minhas-notas', fn () => view('app.aluno.notas'))->name('app.aluno.notas');
    Route::get('/minhas-chamadas', fn () => view('app.aluno.chamadas'))->name('app.aluno.chamadas');

    // Telas de ADMIN (professor)
    Route::middleware('admin')->group(function () {

        // Alunos (CRUD)
        Route::get('/alunos', [StudentController::class, 'index'])->name('app.alunos.index');
        Route::post('/alunos', [StudentController::class, 'store'])->name('app.alunos.store');
        Route::put('/alunos/{student}', [StudentController::class, 'update'])->name('app.alunos.update');
        Route::delete('/alunos/{student}', [StudentController::class, 'destroy'])->name('app.alunos.destroy');

        // Matrículas
        Route::get('/matriculas', [EnrollmentController::class, 'index'])->name('app.matriculas.index');
        Route::post('/matriculas', [EnrollmentController::class, 'store'])->name('app.matriculas.store');
        Route::delete('/matriculas/{enrollment}', [EnrollmentController::class, 'destroy'])->name('app.matriculas.destroy');

        // (opcional) telas admin antigas
        Route::get('/notas', fn () => view('app.notas.index'))->name('app.notas.index');
        Route::get('/chamadas', fn () => view('app.chamadas.index'))->name('app.chamadas.index');
    });
});

/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    echo 'A rota acessada não existe. <a href="' . route('Página_Inicial') . '">Clique aqui</a> para ir para a página inicial';
});
