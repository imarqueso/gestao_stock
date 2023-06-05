<?php

namespace App\Http\Controllers\Auth;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view()
    {
        $vendas = Venda::select(
            'produtos.produto AS produto',
            'vendas.produto_id',
            'vendas.id',
            'vendas.preco',
            'vendas.quantidade',
            'vendas.data_venda',
            'vendas.vendidos',
            'vendas.total',
        )->join('produtos', 'produtos.id', '=', 'vendas.produto_id')->limit(5)->orderBy('vendas.id', 'desc')->get();

        $produtos = Produto::select(
            'produtos.produto',
            'produtos.preco',
            'produtos.quantidade',
            'produtos.created_at',
        )->limit(5)->orderBy('produtos.id', 'desc')->get();

        return view('dashboard.index', compact('vendas', 'produtos'));
    }
}
