<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota | Gestão Stock</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/icones/favicon.png') }}">
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }

        * {
            box-sizing: border-box !important;
        }

        body {
            font-family: 'Sen', sans-serif;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        .cupom-container {
            width: 100%;
            max-width: 640px; /* Largura ajustada para caber em A4 */
            background-color: #ffffff;
            color: black;
            border: 1px solid black;
            padding: 15px;
            box-sizing: border-box;
        }

        .head-cupom, .dados-cliente, .rodape {
            width: 100%;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }


        .head-cupom div h1, .head-cupom div h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .head-cupom div p, .dados-cliente div p, .rodape div p {
            font-size: 14px;
            margin: 0;
            padding: 5px;
            border: 1px solid black;
            margin: 5px 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
            font-size: 14px;
            text-align: left;
        }

        th {
            background-color: #575757;
            color: white;
        }

        td {
            background-color: white;
            color: black;
        }

        /* Outros estilos específicos podem ser ajustados da mesma forma */
    </style>
</head>
<body>
    <section class="cupom-container">
        @foreach ($notas as $nota)
        <div class="head-cupom">
            <div>
                <h1>LR Embalagens e Utilidades</h1>
                <p>Av. imperador, 999 - Vila Jacuí, São Paulo - SP</p>
                <p>CNPJ: 000.000.000/00 | Tel: 11 99999-9999</p>
                <p class="data-venda"><span>Data da venda:</span>&nbsp;{{\Carbon\Carbon::parse($nota->data_venda)->format('d/m/Y')}}</p>
            </div>
            <div class="head-box-2">
                <h2>Cupom Fiscal</h2>
                <p class="resumo-cupom">Este cupom de produtos vendidos é um documento emitido contendo informações sobre os itens adquiridos, valores individuais e o valor total da compra. Ele serve como comprovante de pagamento e registro da transação.</p>
            </div>
        </div>
        <div class="dados-cliente">
            <div>
                <p><span>Cliente: </span>{{$nota->cliente}}</p>
                <p><span>CPF: </span>{{$nota->cpf}}</p>
            </div>
        </div>
            <table>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                </tr>
                <?php $itens[$nota->id] = json_decode($nota->itens);?>
                @for ($i = 0; $i < count($itens[$nota->id]); $i++)
                    <tr>
                        <td>{{ $itens[$nota->id][$i]->produtos }}</td>
                        <td>{{ $itens[$nota->id][$i]->quantidade }}</td>
                        <td class="dinheiro">R$&nbsp;{{ $itens[$nota->id][$i]->preco }}</td>
                        <td class="dinheiro">R$&nbsp;{{ $itens[$nota->id][$i]->total_item }}</td>
                    </tr>
                    <?php $qtd[$i] = $itens[$nota->id][$i]->quantidade ?>
                @endfor
            </table>
            <div class="rodape">
                <div class="observacoes">
                    {!! $nota->observacoes !!}
                </div>
                <div class="total">
                    <p><span>Quantidade de itens:</span>
                        <?php $somaQtd = 0; ?>
                        @for ($z = 0; $z < count($itens[$nota->id]); $z++)
                            <?php $somaQtd += $qtd[$z]; ?>
                        @endfor
                        <?php echo $somaQtd; ?>
                    </p>
                <p class="dinheiro"><span>Valor Total:</span>R$&nbsp;{{$nota->total}}</p>
                </div>
            </div>
            @endforeach
    </section>
    <script>
        var dinheiro = document.querySelectorAll('.dinheiro');

        for (var a = 0; a < dinheiro.length; a++) {
            dinheiro[a].innerHTML = dinheiro[a].innerHTML.replace('.', ",");
        }
    </script>
</body>
</html>
