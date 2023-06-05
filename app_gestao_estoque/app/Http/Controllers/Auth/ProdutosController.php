<?php

namespace App\Http\Controllers\Auth;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function view()
    {

        $produtos = Produto::select(
            'produtos.id',
            'produtos.produto',
            'produtos.preco',
            'produtos.quantidade',
            'produtos.vendidos',
            'produtos.created_at AS data_cadastro',
        )->get();

        return view('produtos.index', compact('produtos'));
    }

    public function cadastrar(Request $request)
    {
        $produto = Produto::create([
            'produto' => $request->produto,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
            'vendidos' => $request->vendidos,
        ]);

        return redirect("/produtos")->with('msg', 'Produto cadastrado com sucesso!');
    }

    public function vender(Request $request, $id)
    {
        $produto = Produto::find($id);

        $somaProdutoVendido = $produto->vendidos + $request->vendidos;
        $subtracaoProdutoVendido = $produto->quantidade - $request->vendidos;
        $totalProdutoVendido = $produto->preco * $request->vendidos;

        $produto->update([
            'vendidos' => $somaProdutoVendido,
            'quantidade' => $subtracaoProdutoVendido,
        ]);

        $venda = Venda::create([
            'produto_id' => $id,
            'preco' => $request->preco,
            'quantidade' => $subtracaoProdutoVendido,
            'vendidos' => $request->vendidos,
            'total' => $totalProdutoVendido,
            'data_venda' => $request->data_venda,
        ]);
        return redirect('/produtos')->with('msg', 'Produto vendido com sucesso!');
    }

    public function editar(Request $request, $id)
    {
        $produto = Produto::find($id);

        $produto->update([
            'produto' => $request->produto,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        return redirect('/produtos')->with('msg', 'Produto editado com sucesso!');
    }

    public function excluir(Request $request, $id)
    {
        $venda = Venda::with('produto_id')->where('produto_id', '=', $id);
        $produto = Produto::find($id);

        $venda->delete();
        $produto->delete();

        return redirect('/produtos')->with('msg', 'Produto excluido com sucesso!');
    }
}
