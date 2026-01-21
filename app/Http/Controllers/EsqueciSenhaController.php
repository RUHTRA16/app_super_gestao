<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EsqueciSenhaController extends Controller
{
    public function esquecisenha() {
        return view ('site.esqueci_senha');
    }
}
