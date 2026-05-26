<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function autenticar(LoginAuthRequest $request) {
        $credenciais = $request->only('identifier', 'password');

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();
            
            return redirect()->route('home');
        }

        return back()->withErrors([
            'identifier' => 'Identificação ou Senha de usuário inválida!',
        ])->onlyInput('identifier');
    }

    public function sair(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
