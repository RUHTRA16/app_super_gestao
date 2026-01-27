<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tela_LoginController extends Controller
{
    public function tela_Login() {
        return view ('site.tela_login');
    }
}
