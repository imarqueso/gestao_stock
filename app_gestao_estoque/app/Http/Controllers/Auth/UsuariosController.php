<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function view()
    {

        $usuarios = User::select(
            'usuarios.id',
            'usuarios.nome',
            'usuarios.sobrenome',
            'usuarios.login',
            'usuarios.password',
            'usuarios.email',
            'usuarios.ativo',
            'usuarios.acesso',
            'usuarios.created_at',
        )->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function cadastrar(Request $request)
    {
        $usuario = User::create([
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ativo' => $request->ativo,
            'acesso' => $request->acesso,
        ]);

        return redirect("/usuarios")->with('msg', 'Usuário cadastrado com sucesso!');
    }

    public function editar(Request $request, $id)
    {
        $usuario = User::find($id);

        $dados = [
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'login' => $request->login,
            'email' => $request->email,
            'ativo' => $request->ativo,
            'acesso' => $request->acesso,
        ];

        // Verifique se a senha foi fornecida no request
        if ($request->filled('password')) {
            $dados['password'] = Hash::make($request->password);
        }

        $usuario->update($dados);

        return redirect('/usuarios')->with('msg', 'Usuário editado com sucesso!');
    }

    public function excluir(Request $request, $id)
    {
        $usuario = User::find($id);

        $usuario->delete();

        return redirect('/usuarios')->with('msg', 'Usuário excluido com sucesso!');
    }
}
