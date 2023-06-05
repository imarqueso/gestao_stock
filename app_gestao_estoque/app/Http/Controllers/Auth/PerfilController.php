<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function view()
    {

        $perfil = User::select(
            'usuarios.id',
            'usuarios.nome',
            'usuarios.sobrenome',
            'usuarios.login',
            'usuarios.password',
            'usuarios.email',
            'usuarios.ativo',
            'usuarios.acesso',
            'usuarios.created_at AS data_cadastro',
        )->where('usuarios.id', '=', Auth::user()->id)->get();

        return view('perfil.index', compact('perfil'));
    }

    public function editar(Request $request, $id)
    {
        $perfil = User::find($id);

        $dados = [
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'login' => $request->login,
            'email' => $request->email,
        ];

        // Verifique se a senha foi fornecida no request
        if ($request->filled('password')) {
            $dados['password'] = Hash::make($request->password);
        }

        $perfil->update($dados);

        return redirect('/perfil')->with('msg', 'Dados pessoais editados com sucesso!');
    }
}
