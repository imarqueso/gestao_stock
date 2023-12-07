@extends('layouts.basico')

@section('titulo', 'Vendas | Gestão Stock')
@section('pagina', 'Vendas por Produto')

@section('conteudo')
<style>
    .vendas-container {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
    }

    .vendas-content {
        width: 100%;
        max-width: 1170px;
        height: auto;
        padding: 60px 20px 80px 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .vendas-box {
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
    .vendas-box::-webkit-scrollbar {
    height: 12px;
    }

    /* Track */
    .vendas-box::-webkit-scrollbar-track {
    background: var(--light);
    }

    /* Handle */
    .vendas-box::-webkit-scrollbar-thumb {
    background: var(--primary);
    }

    .vendas-box h3 {
        font-size: 18px;
        line-height: 24px;
        color: var(--primary);
        font-weight: 600;
        text-align: left;
        margin-bottom: 20px;
    }

    .vendas-box input, .vendas-box select {
        background-color: white;
        height: 30px;
        border: 0px;
        border-radius: 5px;
    }

    #dataTable_filter {
        margin-bottom: 30px !important;
    }

    .vendas-box label {
        color: var(--primary);
        font-size: 14px !important;
    }

    .vendas-box label input {
        margin-left: 10px !important;
        padding: 0px 15px 0px 15px;
    }

    .vendas-box label select {
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

    td button:hover {
        filter: brightness(1.5);
        transition: 0.5s ease all;
    }

    td button img {
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

    .alert-success, .alert-danger {
        margin-top: 0px !important;
    }

    .nobreak {
        white-space: nowrap !important;
    }
</style>

<section class="vendas-container">
    <div class="vendas-content">
        @include('partials.mensagem')
        @if (Auth::user()->acesso == 'Admin' || Auth::user()->acesso == 'Master')
        <button class="btn-principal">Cadastrar Venda</button>
        @endif
        <div class="vendas-box">
            <h3>Vendas cadastradas</h3>
            @if (Auth::user()->acesso == 'Admin' || Auth::user()->acesso == 'Master')
            <section class="modal-container modal-cadastrar">
                <div class="modal-content">
                    <img src="{{ asset('assets/img/icones/close.svg') }}" class="close close-cadastrar">
                    <h3 class="titulo-modal">Cadastrar Venda</h3>
                    <form method="post" action="{{ route('cadastrarVenda') }}" enctype="multipart/form-data">
                        @csrf
                        <select name="produto_id" required onchange="subDepartamento()">
                            <option disabled selected value>Selecione o produto</option>
                            @foreach ($listaProd as $prod)
                            <option value="{{ $prod->id }}">{{ $prod->produto }}</option>
                            @endforeach
                        </select>
                        <label>
                            <span>Data da Venda:</span>
                            <input type="date" required name="data_venda" placeholder="Data da Venda:">
                        </label>
                        <input type="number" name="vendidos" value="" placeholder="Vendidos:" required>
                        <button class="salvar" type="submit">Salvar</button>
                    </form>
                </div>
            </section>
            @endif
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Data da Venda</th>
                        <th>Vendido</th>
                        <th>Total</th>
                        @if (Auth::user()->acesso == 'Admin' || Auth::user()->acesso == 'Master')
                        <th>Excluir</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendas as $venda)
                        <tr>
                            <td>{{$venda->id}}</td>
                            <td>{{$venda->produto}}</td>
                            <td class="dinheiro nobreak">R$ {{$venda->preco}}</td>
                            <td>{{$venda->quantidade}}</td>
                            <td>{{\Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y')}}</td>
                            <td>{{$venda->vendidos}}</td>
                            <td class="dinheiro nobreak">R$ {{$venda->total}}</td>
                            @if (Auth::user()->acesso == 'Admin' || Auth::user()->acesso == 'Master')
                            <td>
                                <div class="td-excluir">
                                    <span class="excluir">
                                        <img src="{{ asset('assets/img/icones/excluir.svg') }}">
                                    </span>
                                    <form method="post"
                                    action="/vendas/{{$venda->id}}/excluir"
                                    enctype="multipart/form-data" class="modal-excluir">
                                        @csrf
                                        <input type="number" name="quantidade" value="{{$venda->quantidade}}" hidden>
                                        <input type="number" name="vendidos" value="{{$venda->vendidos}}" hidden>
                                        <input type="number" name="produto_id" value="{{$venda->produto_id}}" hidden>
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
                "zeroRecords": "Nenhum resultado encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum resultado encontrado",
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

    for (var z = 0; z < dinheiro.length; z++) {
        dinheiro[z].innerHTML = dinheiro[z].innerHTML.replace('.', ",");
    }
</script>

<script>
    $(document).ready(function(){
        // Aplica a máscara de moeda ao campo de entrada
        $('.preco').mask('#.##0,00', {reverse: true});
    });
</script>

@endsection
