<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entrar | Gestão Stock</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/icones/favicon.png') }}">
</head>
<body style="background-image: url({{ asset('assets/img/background-login.jpg') }});">

    <style>
        body {
            width: 100%;
            min-width: 100vw;
            height: 100%;
            min-height: 100vh;
            padding: 0px;
            background-color: #ffffff;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Sen', sans-serif;
            box-sizing: border-box;
            backdrop-filter: grayscale(0.3); 
        }

        .login-overlay {
            width: 100vw;
            height: 100vh;
            box-sizing: border-box;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: rgb(255,255,255);
            background: linear-gradient(180deg, rgba(255,255,255,0.804359243697479) 0%, rgba(255,255,255,0.31416316526610644) 27%, rgba(255,255,255,0) 72%);
        }

        .login-box {
            width: 430px;
            height: auto;
            padding: 45px 40px;
            margin: 0px;
            background-color: #ffffffcf;
            border-radius: 0px 20px 0px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            -webkit-box-shadow: 10px 10px 53px -25px rgba(36,36,36,0.45);
            -moz-box-shadow: 10px 10px 53px -25px rgba(36,36,36,0.45);
            box-shadow: 10px 10px 53px -25px rgba(36,36,36,0.45);
        }

        .login-box .logo {
            font-size: 28px;
            line-height: 34px;
            color: #444444;
            font-weight: 700;
            margin: 0px;
            padding: 0px;
            text-transform: uppercase;
        }

        .login-box .logo strong {
            color: #0b2766;
            font-weight: 800;
        }

        .login-box .titulo {
            font-size: 20px;
            color: #0b2766;
            font-weight: 400;
            line-height: 24px;
            text-align: center;
            margin: 20px 0px 30px 0px;
        }

        .login-box form {
            width: 100%;
            height: auto;
            padding: 0px;
            margin: 0px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-box form input {
            width: 100%;
            height: 40px;
            background-color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            line-height: 20px;
            color: #777676;
            padding: 0px 15px;
            box-sizing: border-box;
            margin-bottom: 10px;
            outline: none;
            text-transform: lowercase !important;
        }

        .login-box form input::placeholder {
            font-size: 14px;
            line-height: 20px;
            color: #777676;
        }

        .login-box form button {
            width: 100%;
            height: 45px;
            background-color: #0b2766;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            outline: none;
            border: none;
            cursor: pointer;
            transition: 0.5s ease all;
        }

        .login-box form button:hover {
            background-color: #1d1da8;
            transition: 0.5s ease all;
        }

        @media (max-width: 470px) {
            .login-box {
                width: 90%;
                padding: 40px 30px;
            }

            .login-box .logo {
                font-size: 22px;
                line-height: 28px;
            }

            .login-box .titulo {
                font-size: 16px;
                line-height: 22px;
                margin: 25px 0px;
            }
        }

        @media (max-width: 380px) {
            .login-box {
                width: 95%;
                padding: 40px 25px;
            }

            .login-box .logo {
                font-size: 22px;
                line-height: 28px;
            }

            .login-box .titulo {
                font-size: 16px;
                line-height: 22px;
                margin: 25px 0px;
            }
        }

        button[disabled] {
            background-color: #464444 !important;
        }
    </style>

    <section class="login-overlay">
        <div class="login-box">
            <p class="logo">Gestão<strong>Stock</strong></p>
            <h3 class="titulo">Entre para gerenciar seu estoque.</h3>
            <form method="post">
                @csrf
                <input type="text" id="user" name="login" required
                placeholder="Login">
                <input type="password" id="password" name="password" required
                placeholder="Senha">
                <button class="entrar">Entrar</button>
                @include('partials.mensagem')        
            </form>  
        </div>
    </section>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {

        var botoes = document.querySelectorAll('button.entrar');

        for (var s = 0; s < botoes.length; s++) {
            (function(index) {
            var formulario = botoes[index].closest('form');

                botoes[index].removeAttribute('disabled');
                botoes[index].innerText = 'Entrar';

            formulario.addEventListener('submit', function(event) {
                botoes[index].setAttribute('disabled', 'disabled');
                botoes[index].innerText = 'Entrando...';
            });
            })(s);
        }
        });
    </script>
</body>
</html>