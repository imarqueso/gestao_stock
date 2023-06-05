<?php

namespace App\Http\Controllers\Auth;

use App\Models\Produto;
use App\Models\Venda;
use App\Services\ListarProdutos;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function view(ListarProdutos $listarProdutos)
    {
        $listaProd = $listarProdutos->listarProdutos();

        $vendas = Venda::select(
            'produtos.produto AS produto',
            'vendas.produto_id',
            'vendas.id',
            'vendas.preco',
            'vendas.quantidade',
            'vendas.data_venda',
            'vendas.vendidos',
            'vendas.total',
        )->join('produtos', 'produtos.id', '=', 'vendas.produto_id')->orderby('vendas.id', 'DESC')->get();

        return view('vendas.index', compact('listaProd', 'vendas'));
    }

    public function cadastrar(Request $request)
    {
        $produto = Produto::find($request->produto_id);

        $somaProdutoVendido = $produto->vendidos + $request->vendidos;
        $subtracaoProdutoVendido = $produto->quantidade - $request->vendidos;
        $totalProdutoVendido = $produto->preco * $request->vendidos;

        $produto->update([
            'quantidade' => $subtracaoProdutoVendido,
            'vendidos' => $somaProdutoVendido,
        ]);

        $venda = Venda::create([
            'produto_id' => $request->produto_id,
            'preco' => $produto->preco,
            'quantidade' => $subtracaoProdutoVendido,
            'data_venda' => $request->data_venda,
            'vendidos' => $request->vendidos,
            'total' => $totalProdutoVendido,
        ]);

        return redirect("/vendas")->with('msg', 'Venda cadastrada com sucesso!');
    }

    public function excluir(Request $request, $id)
    {
        $venda = Venda::find($id);
        $produto = Produto::find($request->produto_id);


        $vendidos = $produto->vendidos + $request->vendidos;
        $quantidade = $produto->quantidade + $request->vendidos;

        $produto->update([
            'quantidade' => $quantidade,
            'vendidos' => $vendidos,
        ]);

        $venda->delete();

        return redirect('/vendas')->with('msg', 'Venda excluida com sucesso!');
    }
}
