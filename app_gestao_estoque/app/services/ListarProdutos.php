<?php

namespace App\Services;

use App\Models\Produto;

class ListarProdutos
{

    public function listarProdutos()
    {
        $produtos = Produto::query()->select('produtos.id', 'produtos.produto')->orderBy('produto')->get();
        $prod = [];

        foreach ($produtos as $produto) {
            array_push($prod, $produto);
        }

        return $prod;
    }
}
