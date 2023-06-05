<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginView(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->ativo == 'Sim') {
                return redirect('/dashboard');
            } else if (Auth::user()->ativo == 'Não') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('msgf', 'Usuário inativo!');
            }
        } else {
            $mensagem = $request->session()->get('msgf');
            return view('login.index', ['msgf' => $mensagem]);
        }
    }

    public function login(Request $request)
    {
        $credentials = [
            'login' => $request->input('login'),
            'password' => $request->input('password'),
        ];

        $user = User::where('login', $request->input('login'))->first();

        if (Auth::attempt($credentials)) {
            if ($user && $user->ativo == 'Sim') {
                return redirect('/dashboard');
            } else {
                $request->session()->flash('msgf', 'Usuário inativo');
                return redirect()->back()->withErrors('Usuário inativo');
            }
        } else {
            $request->session()->flash('msgf', 'Login e/ou senha inválidos');
            return redirect()->back()->withErrors('Login e/ou senha inválidos');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
