@extends('layouts.basico')

@section('titulo', 'Usuários | Gestão Stock')
@section('pagina', 'Usuários')

@section('conteudo')
<style>
    .usuarios-container {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
    }

    .usuarios-content {
        width: 100%;
        max-width: 1170px;
        height: auto;
        padding: 60px 20px 80px 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .usuarios-box {
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
    .usuarios-box::-webkit-scrollbar {
    height: 12px;
    }

    /* Track */
    .usuarios-box::-webkit-scrollbar-track {
    background: var(--light);
    }

    /* Handle */
    .usuarios-box::-webkit-scrollbar-thumb {
    background: var(--primary);
    }

    .usuarios-box h3 {
        font-size: 18px;
        line-height: 24px;
        color: var(--primary);
        font-weight: 600;
        text-align: left;
        margin-bottom: 20px;
    }

    .usuarios-box input, .usuarios-box select {
        background-color: white;
        height: 30px;
        border: 0px;
        border-radius: 5px;
    }

    #dataTable_filter {
        margin-bottom: 30px !important;
    }

    .usuarios-box label {
        color: var(--primary);
        font-size: 14px !important;
    }

    .usuarios-box label input {
        margin-left: 10px !important;
        padding: 0px 15px 0px 15px;
    }

    .usuarios-box label select {
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

    .modal-container label {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .modal-container label span {
        font-size: 14px;
        line-height: 20px;
        color: #363636;
        font-weight: 400;
        margin-bottom: 6px;
    }

    .modal-container label input {
        margin-left: 0px !important;
    }

    .alert-success, .alert-danger {
        margin-top: 0px !important;
    } 

    .nobreak {
        white-space: nowrap !important;
    }
</style>

<section class="usuarios-container">
    <div class="usuarios-content">
        @include('partials.mensagem')  
        <button class="btn-principal">Cadastrar Usuário</button>
        <div class="usuarios-box">
            <h3>Usuários cadastrados</h3>
            <section class="modal-container modal-cadastrar">
                <div class="modal-content">
                    <img src="{{ asset('assets/img/icones/close.svg') }}" class="close close-cadastrar">
                    <h3 class="titulo-modal">Cadastrar Usuário</h3>
                    <form method="post" action="{{ route('cadastrarUsuario') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="nome" placeholder="Nome:" required>
                        <input type="text" name="sobrenome" placeholder="Sobrenome:">
                        <input type="text" name="login" placeholder="Login:" required>
                        <input type="text" name="email" placeholder="E-mail:" required>
                        <input type="password" name="password" placeholder="Senha:" required>
                        <select name="ativo" required>
                            <option disabled selected value>Usuário ativo?</option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                        <select name="acesso" required>
                            <option disabled selected value>Selecione o acesso</option>
                            <option value="Admin">Admin</option>
                            <option value="Master">Master</option>
                            <option value="Colaborador">Colaborador</option>
                        </select>
                        <button class="salvar" type="submit">Salvar</button>
                    </form>
                </div>
            </section>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Login</th>
                        <th>E-mail</th>
                        <th>Ativo</th>
                        <th>Acesso</th>
                        <th>Cadastro</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        @if ($usuario->login == "admin") 
                        @else
                        <tr>
                            <td>{{$usuario->nome}}&nbsp;{{$usuario->sobrenome}}</td>
                            <td>{{$usuario->login}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>{{$usuario->ativo}}</td>
                            <td>{{$usuario->acesso}}</td>
                            <td>{{\Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y')}}</td>
                            <td><button class="editar"><img src="{{ asset('assets/img/icones/editar.svg') }}"></button></td>
                            <td>
                                <div class="td-excluir">
                                    <span class="excluir">
                                        <img src="{{ asset('assets/img/icones/excluir.svg') }}">
                                    </span>
                                    <form method="post"
                                    action="/usuarios/{{$usuario->id}}/excluir"
                                    enctype="multipart/form-data" class="modal-excluir">
                                        @csrf
                                        <button type="submit" class="btn-excluir">Excluir</button>
                                        <span class="btn-cancelar">Cancelar</span>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>       

@foreach ($usuarios as $usuario)
    <section class="modal-container modal-editar">
        <div class="modal-content">
            <img src="{{ asset('assets/img/icones/close.svg') }}" class="close close-editar">
            <h3 class="titulo-modal">Editar Usuário</h3>
            <form method="post"
            action="/usuarios/{{$usuario->id}}/editar"
            enctype="multipart/form-data">
                @csrf
                <label>
                    <span>Login:</span>
                    <input type="text" value="{{$usuario->login}}" name="login"  placeholder="Login:" required>
                </label>
                <label>
                    <span>Nome:</span>
                    <input type="text" value="{{$usuario->nome}}" name="nome"  placeholder="Nome:" required>
                </label>
                <label>
                    <span>Sobrenome:</span>
                    <input type="text" value="{{$usuario->sobrenome}}" name="sobrenome"  placeholder="Sobrenome:">
                </label>
                <label>
                    <span>E-mail:</span>
                    <input type="text" value="{{$usuario->email}}" name="email"  placeholder="E-mail:" required>
                </label>
                <label>
                    <span>Senha:</span>
                    <input type="password" name="password"  placeholder="Senha:">
                </label>
                <label>
                    <span>Ativo:</span>
                    <select name="acesso">
                        <option selected value="{{$usuario->ativo}}">{{$usuario->ativo}}</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </label>
                <label>
                    <span>Acesso:</span>
                    <select name="acesso">
                        <option selected value="{{$usuario->acesso}}">{{$usuario->acesso}}</option>
                        <option value="Admin">Admin</option>
                        <option value="Master">Master</option>
                        <option value="Colaborador">Colaborador</option>
                    </select>
                    </label>
                <button class="salvar" type="submit">Salvar</button>
            </form>
        </div>
    </section>
@endforeach
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
        });
    });
</script>

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
    var btnEditar = document.querySelectorAll("button.editar");
    var modalEditar = document.querySelectorAll("section.modal-editar");

    btnEditar.forEach(function(item, index) {
        item.addEventListener("click", function() {
                if (modalEditar[index].classList.contains("abrir")) {
                    modalEditar[index].classList.remove("abrir");
            } else {
                for (var i = 0; i < modalEditar.length; i++) {
                    modalEditar[i].classList.remove("abrir");
                }
                modalEditar[index].classList.add("abrir");
            }
        });
    });

    var closeEditar = document.querySelectorAll("img.close-editar");

    closeEditar.forEach(function(item, index) {
        item.addEventListener("click", function() {
            modalEditar[index].classList.remove("abrir");
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

<script>
    var btnSubmit = document.querySelectorAll("button");

    btnSubmit.forEach(function(item, index) {
        item.addEventListener("click", function() {
            jQuery("btnSubmit")[index].prop("disabled", true);
        });
    });
</script>

@endsection