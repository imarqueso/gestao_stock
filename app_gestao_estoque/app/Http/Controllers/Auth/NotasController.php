<?php

namespace App\Http\Controllers\Auth;

use App\Models\Nota;
use Illuminate\Http\Request;

class NotasController extends Controller
{

    public function view()
    {

        $notas = Nota::select(
            'notas.id',
            'notas.cpf',
            'notas.cliente',
            'notas.itens',
            'notas.qtd_itens',
            'notas.data_venda',
            'notas.total',
            'notas.created_at',
        )->orderby('notas.id', 'DESC')->get();


        // for ($i = 0; $i < count($notas); $i++) {
        //     // echo '<pre>';
        //     // echo print_r($notas[$i]->itens);
        //     // echo '</pre>';
        //     // exit();
        //     $itens_array = json_decode($notas[$i]->itens);
        // }

        return view('notas.index', compact('notas'));
    }


    private function formatarNumero($numero) {
        $numero = str_replace('.', '', $numero); // Remove separador de milhar
        $numero = str_replace(',', '.', $numero); // Troca vírgula por ponto
        return floatval($numero); // Converte a string para float
    }

    public function cadastrar(Request $request)
    {
        $produto = $request->produto;
        $quantidade = $request->quantidade;
        $preco = $request->preco;
        $itens_array = array();

        for ($i = 0; $i < count($produto); $i++) {
            $produtos = array();
            $produtos = [
                'produtos' => $produto[$i],
                'quantidade' => $quantidade[$i],
                'preco' => $preco[$i],
                'total_item' => $this->formatarNumero($preco[$i]) * $quantidade[$i],
            ];
            array_push($itens_array, $produtos);
        }

        $itens = json_encode($itens_array);

        $observacoes = nl2br($request->observacoes);


        $nota = Nota::create([
            'cpf' => $request->cpf,
            'cliente' => $request->cliente,
            'itens' => $itens,
            'qtd_itens' => $request->qtd_itens,
            'data_venda' => $request->data_venda,
            'observacoes' => $observacoes,
            'total' => $request->total,
        ]);

        return redirect("/notas")->with('msg', 'Nota cadastrada com sucesso!');
    }

    public function nota($id)
    {

        $notas = Nota::select(
            'notas.id',
            'notas.cpf',
            'notas.cliente',
            'notas.itens',
            'notas.qtd_itens',
            'notas.data_venda',
            'notas.observacoes',
            'notas.total',
            'notas.created_at',
        )->where('notas.id', '=', $id)->get();

        return view('notas.nota', compact('notas'));
    }
}
