@extends('layouts.basico')

@section('titulo', 'Perfil | Gestão Stock')
@section('pagina', 'Perfil')

@section('conteudo')
<style>
    .perfil-container {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
    }

    .perfil-content {
        width: 100%;
        max-width: 1170px;
        height: auto;
        padding: 60px 20px 80px 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .perfil-box {
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
    .perfil-box::-webkit-scrollbar {
    height: 12px;
    }

    /* Track */
    .perfil-box::-webkit-scrollbar-track {
    background: var(--light);
    }

    /* Handle */
    .perfil-box::-webkit-scrollbar-thumb {
    background: var(--primary);
    }

    .perfil-box h3 {
        font-size: 18px;
        line-height: 24px;
        color: var(--primary);
        font-weight: 600;
        text-align: left;
        margin-bottom: 20px;
    }

    .perfil-box input, .perfil-box select {
        background-color: white;
        height: 30px;
        border: 0px;
        border-radius: 5px;
    }

    #dataTable_filter {
        margin-bottom: 30px !important;
    }

    .perfil-box label {
        color: var(--primary);
        font-size: 14px !important;
    }

    .perfil-box label input {
        margin-left: 10px !important;
        padding: 0px 15px 0px 15px;
    }

    .perfil-box label select {
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

<section class="perfil-container">
    <div class="perfil-content">
        @include('partials.mensagem') 
        <div class="perfil-box">
            <h3>Dados do perfil</h3>
            <table>
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Login</th>
                        <th>E-mail</th>
                        <th>Nível de Acesso</th>
                        <th>Cadastro</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perfil as $usuario)
                        <tr>
                            <td>{{$usuario->nome}}&nbsp;{{$usuario->sobrenome}}</td>
                            <td>{{$usuario->login}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>{{$usuario->acesso}}</td>
                            <td>{{\Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y')}}</td>
                            <td><button class="editar"><img src="{{ asset('assets/img/icones/editar.svg') }}"></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>       

@foreach ($perfil as $usuario)
    <section class="modal-container modal-editar">
        <div class="modal-content">
            <img src="{{ asset('assets/img/icones/close.svg') }}" class="close close-editar">
            <h3 class="titulo-modal">Editar Dados Pessoais</h3>
            <form method="post"
            action="/perfil/{{$usuario->id}}/editar"
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
                    <input type="text" value="{{$usuario->sobrenome}}" name="sobrenome"  placeholder="Sobrenome:" required>
                </label>
                <label>
                    <span>E-mail:</span>
                    <input type="text" value="{{$usuario->email}}" name="email"  placeholder="E-mail:" required>
                </label>
                <label>
                    <span>Senha:</span>
                    <input type="password" name="password"  placeholder="Senha:">
                </label>
                <button type="submit">Salvar</button>
            </form>
        </div>
    </section>
@endforeach
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
@endsection