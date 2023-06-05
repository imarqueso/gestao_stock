@extends('layouts.basico')

@section('titulo', 'Dashboard | Gestão Stock')
@section('pagina', 'Dashboard')

@section('conteudo')

<style>
    .dashboard-container {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .dashboard-content {
        width: 100%;
        max-width: 1170px;
        height: auto;
        padding: 60px 20px 80px 20px;
        display: grid;
        grid-template-columns: repeat(2, 48%);
        grid-auto-rows: auto;
        justify-content: center;
        align-items: flex-start;
        column-gap: 4%;
    }

    .dashboard-box {
        width: 100%;
        height: 100%;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        background-color: var(--secondary);
        overflow: auto;
    }

    /* width */
    .dashboard-box::-webkit-scrollbar {
    height: 12px;
    }

    /* Track */
    .dashboard-box::-webkit-scrollbar-track {
    background: var(--light);
    }

    /* Handle */
    .dashboard-box::-webkit-scrollbar-thumb {
    background: var(--primary);
    }

    .dashboard-box h3 {
        font-size: 18px;
        line-height: 24px;
        color: var(--primary);
        font-weight: 600;
        text-align: left;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        min-width: 680px;
        height: auto;
        background-color: transparent;
        border-collapse: collapse;
        border: none;
    }

   th {
        border: 1px solid #b9b8b8;
        padding: 15px;
        background-color: #d6d6d6;
        font-size: 12px;
        text-transform: uppercase;
        color: var(--primary);
        line-height: 18px;
        text-align: left;
   }

   td {
        border: 1px solid #b9b8b8;
        padding: 15px;
        background-color: var(--light);
        font-size: 14px;
        text-transform: uppercase;
        color: var(--primary);
        line-height: 20px;
        text-align: left;
   }

   @media (max-width: 1080px) {
        .dashboard-content {
            width: 100%;
            max-width: 1170px;
            height: auto;
            padding: 60px 20px;
            display: grid;
            grid-template-columns: repeat(1, 100%);
            grid-auto-rows: auto;
            justify-content: center;
            align-items: flex-start;
            row-gap: 30px;
        }

        .dashboard-box h3 {
            font-size: 16px;
            line-height: 22px;
        }
   }

   .produtos-td-1, .vendas-td-2 {
        min-width: 180px;
   }

   .produtos-td-2, .vendas-td-3 {
        min-width: 100px;
   }

   .vendas-td-4 {
        min-width: 120px;
   }

   .produtos-td-4, .vendas-td-5 {
        min-width: 130px;
   }

   .vendas-td-6 {
    min-width: 150px;
   }

   .nobreak {
        white-space: nowrap !important;
    }
</style>

<section class="dashboard-container">
    <div class="dashboard-content">
        <div class="dashboard-box">
            <h3>Últimos produtos adicionados</h3>
            <table>
                <tr>
                    <th>Titulo</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Cadastro</th>
                </tr>
                @foreach ($produtos as $produto)
                    <tr>
                        <td class="produtos-td-1">{{$produto->produto}}</td>
                        <td class="produtos-td-2 dinheiro nobreak">R$ {{$produto->preco}}</td>
                        <td class="produtos-td-3">{{$produto->quantidade}}</td>
                        <td class="produtos-td-4">{{\Carbon\Carbon::parse($produto->created_at)->format('d/m/Y')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="dashboard-box">
            <h3>Últimos produtos vendidos</h3>
            <table>
                <tr>
                    <th>Código</th>
                    <th>Titulo</th>
                    <th>Preço</th>
                    <th>Vendidos</th>
                    <th>Data da Venda</th>
                    <th>Total</th>
                </tr>
                @foreach ($vendas as $venda)
                    <tr>
                        <td class="vendas-td-1">{{$venda->id}}</td>
                        <td class="vendas-td-2">{{$venda->produto}}</td>
                        <td class="vendas-td-3 dinheiro">R$ {{$venda->preco}}</td>
                        <td class="vendas-td-4">{{$venda->vendidos}}</td>
                        <td class="vendas-td-5">{{\Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y')}}</td>
                        <td class="vendas-td-6 dinheiro nobreak">R$ {{$venda->total}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</section>

<script>
    var dinheiro = document.querySelectorAll('td.dinheiro');

    for (var z = 0; z < dinheiro.length; z++) {
        dinheiro[z].innerHTML = dinheiro[z].innerHTML.replace('.', ",");
    }
</script>

@endsection