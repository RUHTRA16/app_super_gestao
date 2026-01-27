<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{
    // ✅ MOSTRA A TELA DE CADASTRO
    public function cadastro()
    {
        return view('site.cadastro'); // ajuste se sua view tiver outro caminho
    }

    // ✅ SALVA NO BANCO
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],
        ], [
            'terms.accepted' => 'Você precisa aceitar os termos de uso.',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso!');
    }
}
