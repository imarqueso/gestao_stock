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
        body {
            padding: 20px 30px !important;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Sen', sans-serif;
            width: auto;
            overflow: auto !important;
        }

        .cupom-container {
            width: 1020px;
            min-width: 1020px !important;
            max-width: 1020px !important;
            background-color: #ffffff;
            color: black;
            border: 1px solid black !important;
            min-width: 1080px;
            max-width: 1080px;
            height: auto;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            box-sizing: border-box;
        }

        .head-cupom {
            width: 100%;
            height: auto;
            padding: 0px;
            margin: 0px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .head-cupom div {
            width: 50%;
            padding: 0px;
            margin: 0px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .head-cupom div h1 {
            font-size: 22px;
            line-height: 28px;
            text-transform: uppercase;
            color: black;
            font-weight: 600;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .head-cupom div p {
            font-size: 16px;
            line-height: 22px;
            font-weight: 400;
            margin: 0px;
        }

        .data-venda {
            margin-top: 20px !important;
        }

        .head-cupom div p span {
            font-size: 16px;
            line-height: 22px;
            font-weight: 600;
            margin: 0px;
            text-transform: uppercase;
        }        
        
        .head-cupom .head-box-2 {
            width: 50%;
            padding: 0px;
            margin: 0px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-end;
        }

        .head-cupom div h2 {
            font-size: 20px;
            line-height: 26px;
            color: black;
            font-weight: 600;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .head-cupom .head-box-2 p {
            width: 370px;
            height: auto;
            padding: 10px;
            font-size: 12px;
            line-height: 18px;
            font-weight: 400;
            border: 1px solid black;
        }

        .dados-cliente {
            width: 100%;
            height: auto;
            padding: 0px;
            margin: 20px 0px 0px 0px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .dados-cliente p {
            width: 49%;
            height: 40px;
            padding: 10px 20px;
            box-sizing: border-box;
            margin: 0px;
            border: 1px solid black;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            font-size: 16px;
            line-height: 22px;
            color: black;
        }

        .dados-cliente p span {
            font-weight: 600;
            width: auto;
            margin-right: 10px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            min-width: 680px;
            height: auto;
            background-color: transparent;
            border-collapse: collapse;
            border: none;
            margin: 0px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th {
            border: 1px solid black;
            padding: 5px 20px;
            background-color: #575757;
            font-size: 16px;
            text-transform: uppercase;
            color: white;
            line-height: 22px;
            text-align: left;
        }

        td {
            border: 1px solid black;
            padding: 5px 20px;
            background-color: white;
            font-size: 16px;
            text-transform: uppercase;
            color: black;
            line-height: 22px;
            text-align: left;
        }

        .rodape {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0px;
        }

        .rodape .total {
            width: auto;
            height: auto;
            padding: 0px;
            margin: 0px;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .rodape .observacoes {
            display: block;
            font-size: 16px;
            color: black;
            line-height: 22px;
            font-weight: 400;
            text-align: left
        }

        .rodape p {
            width: auto;
            height: 40px;
            padding: 15px;
            box-sizing: border-box;
            margin: 0px;
            border: 1px solid black;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            font-size: 16px;
            line-height: 22px;
            color: black;
            margin-left: 10px;
        }

        .rodape p span {
            font-weight: 600;
            text-transform: uppercase;
            margin-right: 10px;
        }
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
                <p><span>Cliente: </span>{{$nota->cliente}}</p>
                <p><span>CPF: </span>{{$nota->cpf}}</p>
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