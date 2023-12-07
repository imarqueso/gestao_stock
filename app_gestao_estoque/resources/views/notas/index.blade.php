@extends('layouts.basico')

@section('titulo', 'Notas | Gestão Stock')
@section('pagina', 'Notas Geradas')

@section('conteudo')
<style>
    .notas-container {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
    }

    .notas-content {
        width: 100%;
        max-width: 1170px;
        height: auto;
        padding: 60px 20px 80px 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .notas-box {
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
    .notas-box::-webkit-scrollbar {
    height: 12px;
    }

    /* Track */
    .notas-box::-webkit-scrollbar-track {
    background: var(--light);
    }

    /* Handle */
    .notas-box::-webkit-scrollbar-thumb {
    background: var(--primary);
    }

    .notas-box h3 {
        font-size: 18px;
        line-height: 24px;
        color: var(--primary);
        font-weight: 600;
        text-align: left;
        margin-bottom: 20px;
    }

    .notas-box input, .notas-box select {
        background-color: white;
        height: 30px;
        border: 0px;
        border-radius: 5px;
    }

    #dataTable_filter {
        margin-bottom: 30px !important;
    }

    .notas-box label {
        color: var(--primary);
        font-size: 14px !important;
    }

    .notas-box label input {
        margin-left: 10px !important;
        padding: 0px 15px 0px 15px;
    }

    .notas-box label select {
        margin-right: 10px !important;
    }

    table {
        width: 100%;
        min-width: 1090px !important;
        height: auto;
        background-color: transparent;
        border-collapse: collapse !important;
        border: none;
    }

    th {
        border: 1px solid #b9b8b8;
        border-bottom: 1px solid #b9b8b8 !important;
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

    td button {
        width: 30px;
        min-width: 30px;
        max-width: 30px;
        height: 30px;
        min-height: 30px;
        max-height: 30px;
        border-radius: 50%;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    td .visualizar {
        width: 30px;
        min-width: 30px;
        max-width: 30px;
        height: 30px;
        min-height: 30px;
        max-height: 30px;
        border-radius: 50%;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    td .excluir {
        width: 30px;
        min-width: 30px;
        max-width: 30px;
        height: 30px;
        min-height: 30px;
        max-height: 30px;
        border-radius: 50%;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        background-color: #8d3a3a;
    }

    .td-excluir {
        position: relative;
        width: auto;
        height: auto;
        padding: 0px;
    }

    td button.vender {
        background-color: #16b65e;
    }

    td button.editar {
        background-color: #09308b;
    }

    td .visualizar {
        background-color: #2c2c2c;
        text-decoration: none;
    }

    td button:hover {
        filter: brightness(1.5);
        transition: 0.5s ease all;
    }

    td a.visualizar:hover {
        filter: brightness(1.5);
        transition: 0.5s ease all;
    }

    td button img {
        height: 10px;
        width: auto;
    }

    td .visualizar img {
        height: 10px;
        width: auto;
    }

    td .excluir img {
        height: 10px;
        width: auto;
    }

    .td-excluir form {
        position: absolute;
        top: -30px;
        right: 20px;
        width: auto;
        height: auto;
        justify-content: flex-start;
        align-items: center;
        border-radius: 6px;
        z-index: 9000;
        display: none;
        visibility: hidden;
        opacity: 0;
        transition: 0.5s ease all;
    }

    .td-excluir form .btn-excluir {
        width: auto !important;
        min-width: auto !important;
        max-width: none !important;
        height: auto !important;
        min-height: auto !important;
        max-height: none !important;
        padding: 5px 15px;
        border-radius: 5px;
        background-color: var(--primary);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 11px;
        line-height: 17px;
        font-weight: 600;
        text-transform: uppercase;
        cursor: pointer;
        margin-right: 5px;
        transition: 0.5s ease all;
    }

    .td-excluir form .btn-cancelar {
        width: auto;
        padding: 5px 15px;
        border-radius: 5px;
        background-color: #993b3b;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 11px;
        line-height: 17px;
        font-weight: 600;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.5s ease all;
    }

    .td-excluir form .btn-excluir:hover, .td-excluir form .btn-cancelar:hover {
        filter: brightness(1.5);
        transition: 0.5s ease all;
    }

    .abrir-excluir {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
        transition: 0.5s ease all;
    }

    .dataTables_paginate {
        width: auto !important;
        height: auto !important;
        margin-top: 10px !important;
    }

    .dataTables_paginate a {
        width: auto !important;
        height: auto !important;
        padding: 8px 12px !important;
        border-radius: 3px !important;
        background-color: var(--primary);
        color: white;
        font-size: 12px !important;
        line-height: 18px;
        font-weight: 600;
        margin: 20px 0px 0px 5px;
        text-transform: uppercase;
        transition: 0.5s ease all;
        cursor: pointer;
    }

    .dataTables_paginate a:hover {
        filter: brightness(3);
        transition: 0.5s ease all;
    }

    .dataTables_paginate .disabled {
        filter: grayscale(1);
        cursor: default;
    }

    .dataTables_paginate .disabled:hover {
        filter: grayscale(1);
    }

    .btn-itens {
        height: 30px !important;
        font-size: 12px !important;
        line-height: 18px !important;
        background-color: #159123 !important;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .modal-cadastrar hr {
        width: 100%;
        margin-bottom: 10px;
        background-color: gray;
        color: gray;
    }

    .modal-cadastrar label {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .modal-cadastrar label span {
        font-size: 14px;
        line-height: 20px;
        color: #363636;
        font-weight: 400;
        margin-bottom: 6px;
    }

    .modal-cadastrar label input {
        margin-left: 0px !important;
    }

    .qtd-prod {
        margin-bottom: 15px !important;
        border-bottom: 1px solid var(--primary) !important;
    }

    .itens-nota {
        padding: 0px !important;
        white-space: nowrap !important;
    }

    .nobreak {
        white-space: nowrap !important;
    }

    .itens-nota-box {
        width: 100%;
        height: 100%;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .itens-nota-box .item {
        width: auto;
        height: auto;
        padding: 5px 10px;
        margin: 0px 0px 5px 0px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
        background-color: var(--primary);
        color: white;
        font-size: 12px;
        line-height: 18px;
        font-weight: 400;
        text-transform: none !important;
    }

    .itens-nota-box .item:last-of-type {
        margin-bottom: 0px !important;
    }

    .itens-nota-box .item .unidade {
        text-transform: none !important;
        color: white;
        font-weight: 600;
    }

    .itens-nota-box .item .total {
        text-transform: none !important;
        color: #46e446;
        font-weight: 600;
    }
</style>

<section class="notas-container">
    <div class="notas-content">
        @include('partials.mensagem')
        @if (Auth::user()->acesso == 'Admin' || Auth::user()->acesso == 'Master')
            <button class="btn-principal">Cadastrar Nota</button>
        @endif
        <div class="notas-box">
            <h3>Notas cadastradas</h3>
            @if (Auth::user()->acesso == 'Admin' || Auth::user()->acesso == 'Master')
            <section class="modal-container modal-cadastrar">
                <div class="modal-content">
                    <img src="{{ asset('assets/img/icones/close.svg') }}" class="close close-cadastrar">
                    <h3 class="titulo-modal">Cadastrar Nota</h3>
                    <form method="post" action="{{ route('cadastrarNota') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="cpf" placeholder="CPF:">
                        <input type="text" name="cliente" placeholder="Cliente:">
                        <input id="quantidade-item" name="qtd_itens" type="number" required min="1" placeholder="Quantidade de itens:">
                        <div class="box-form" id="box-form">

                        </div>
                        <label>
                            <span>Data da venda:</span>
                            <input type="date" name="data_venda" placeholder="Data da Venda:">
                        </label>
                        <textarea placeholder="Observações:" name="observacoes"></textarea>
                        <input type="text" class="preco" name="total" placeholder="Total da Nota:">
                        <button class="salvar" type="submit">Salvar</button>
                    </form>
                </div>
            </section>
            @endif
            <table id="dataTable" data-role="table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>CPF</th>
                        <th>Cliente</th>
                        <th>Produtos Vendidos</th>
                        <th>Data da Venda</th>
                        <th>Data da Nota</th>
                        <th>Total</th>
                        <th>Ver Nota</th>
                        @if (Auth::user()->acesso == 'Admin' || Auth::user()->acesso == 'Master')
                        <th>Excluir</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notas as $nota)
                        <tr>
                            <td>{{$nota->id}}</td>
                            <td>{{$nota->cpf}}</td>
                            <td>{{$nota->cliente}}</td>
                            <td class="itens-nota">
                                <div class="itens-nota-box">
                                    <?php $itens[$nota->id] = json_decode($nota->itens);?>
                                    @for ($i = 0; $i < count($itens[$nota->id]); $i++)
                                        <span class="item">({{ $itens[$nota->id][$i]->quantidade }})&nbsp;{{ $itens[$nota->id][$i]->produtos }}&nbsp;|&nbsp;<span class="unidade">R$ {{ $itens[$nota->id][$i]->preco }}/un</span>&nbsp;|&nbsp;<span class="total">Total: R$ {{ $itens[$nota->id][$i]->total_item }}</span></span>
                                    @endfor
                                </div>
                            </td>
                            <td>{{\Carbon\Carbon::parse($nota->data_venda)->format('d/m/Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($nota->created_at)->format('d/m/Y')}}</td>
                            <td class="dinheiro nobreak">R$ {{$nota->total}}</td>
                            <td><a class="visualizar" href="/notas/{{$nota->id}}" target="_blank"><img src="{{ asset('assets/img/icones/notas.svg') }}"></a></td>
                            @if (Auth::user()->acesso == 'Admin' || Auth::user()->acesso == 'Master')
                            <td>
                                <div class="td-excluir">
                                    <span class="excluir">
                                        <img src="{{ asset('assets/img/icones/excluir.svg') }}">
                                    </span>
                                    <form action="" class="modal-excluir">
                                        <input type="id" name="excluir" value="1" disabled hidden>
                                        <button type="submit" class="btn-excluir salvar">Excluir</button>
                                        <span class="btn-cancelar">Cancelar</span>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ candidatos por página",
                "zeroRecords": "Nenhum resultado encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum resultado encontrado",
                "infoFiltered": "(Filtrado from _MAX_ total de candidatos)",
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "paging": true,
            "bSort": true,
            'pagingType': 'full',
            'order': [[0, 'desc']],
            'ordering': true,
        });
    });
</script>

<script>
    $('#quantidade-item').keyup(() => {
        var quantidade_itens = $('#quantidade-item').val();
        var element_itens = document.getElementById('box-form');

        for (let i = 0; i < quantidade_itens; i++) {
            var x = document.createElement("input");
            x.setAttribute("value", "");
            x.setAttribute("type", "text");
            x.setAttribute("name", "produto[]");
            x.setAttribute("placeholder", "Nome do produto " + (i + 1) + ":");
            x.setAttribute("required", "");
            var y = document.createElement("input");
            y.setAttribute("value", "");
            y.setAttribute("type", "number");
            y.setAttribute("name", "quantidade[]");
            y.setAttribute("placeholder", "Quantidade do produto " + (i + 1) + ":");
            y.setAttribute("required", "");
            element_itens.appendChild(x);
            element_itens.appendChild(y);
            var z = document.createElement("input");
            z.setAttribute("value", "");
            z.setAttribute("type", "text");
            z.setAttribute("class", "qtd-prod");
            z.setAttribute("class", "preco");
            z.setAttribute("name", "preco[]");
            z.setAttribute("placeholder", "Preço do produto " + (i + 1) + ":");
            z.setAttribute("required", "");
            element_itens.appendChild(x);
            element_itens.appendChild(y);
            element_itens.appendChild(z);
            $('.preco').mask('#.##0,00', {reverse: true});
        }
        if((quantidade_itens == 0)) {
            element_itens.innerHTML = '';
        }
    });
</script>

@if (Auth::user()->acesso == 'Admin' || Auth::user()->acesso == 'Master')
<script>
    var btnCadastrar = document.querySelectorAll("button.btn-principal");
    var modalCadastrar = document.querySelectorAll("section.modal-cadastrar");

    btnCadastrar.forEach(function(item, index) {
        item.addEventListener("click", function() {
                if (modalCadastrar[index].classList.contains("abrir")) {
                    modalCadastrar[index].classList.remove("abrir");
            } else {
                for (var i = 0; i < modalCadastrar.length; i++) {
                    modalCadastrar[i].classList.remove("abrir");
                }
                modalCadastrar[index].classList.add("abrir");
            }
        });
    });

    var closeCadastrar = document.querySelectorAll("img.close-cadastrar");

    closeCadastrar.forEach(function(item, index) {
        item.addEventListener("click", function() {
            modalCadastrar[index].classList.remove("abrir");
        });
    })
</script>

<script>
    var btnExcluir = document.querySelectorAll("span.excluir");
    var btnCancelar = document.querySelectorAll("span.btn-cancelar");
    var modalExcluir = document.querySelectorAll("form.modal-excluir");

    btnExcluir.forEach(function(item, index) {
        item.addEventListener("click", function() {
            modalExcluir[index].classList.toggle('abrir-excluir');
        });
    });

    btnCancelar.forEach(function(item, index) {
        item.addEventListener("click", function() {
            modalExcluir[index].classList.remove('abrir-excluir');
        });
    });
</script>
@endif

<script>
    var dinheiro = document.querySelectorAll('td.dinheiro');
    var unidade = document.querySelectorAll('span.unidade');
    var total= document.querySelectorAll('span.total');

    for (var z = 0; z < dinheiro.length; z++) {
        dinheiro[z].innerHTML = dinheiro[z].innerHTML.replace('.', ",");
    }

    for (var w = 0; w < unidade.length; w++) {
        unidade[w].innerHTML = unidade[w].innerHTML.replace('.', ",");
    }

    for (var w = 0; w < total.length; w++) {
        total[w].innerHTML = total[w].innerHTML.replace('.', ",");
    }
</script>

<script>
    $(document).ready(function(){
        // Aplica a máscara de moeda ao campo de entrada
        $('.preco').mask('#.##0,00', {reverse: true});
    });
</script>

@endsection
