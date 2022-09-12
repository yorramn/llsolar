<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @hasSection('title')
        <title>@yield('title')</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <style>
        /* Style #1 */
        .loading {
            display: flex;
            justify-content: center;
            position: absolute;
            top: 0;
            right: 0;
            background-color: black;
            opacity: 0.1;
        }

        .loading--full-height {
            align-items: center;
            height: 100%;
        }

        .loading::after {
            content: "";
            width: 40vh;
            height: 40vh;
            border: 10px solid black;
            border-top-color: yellow;
            opacity: 10;
            border-radius: 50%;
            transform: rotate(0.16turn);
            animation: loading 1s ease infinite;
        }

        @keyframes loading {
            /* Safari support */
            from {
                transform: rotate(0turn);
            }

            to {
                transform: rotate(1turn);
            }
        }
        .modal.left .modal-dialog {
            position:fixed;
            right: 0;
            margin: auto;
            width: 500px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.left .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.right .modal-body {
            padding: 15px 15px 80px;
        }

        .modal.right.fade .modal-dialog {
            left: -320px;
            -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
            -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
        }

        .modal.right.fade.show .modal-dialog {
            right: 0;
        }
    </style>
    @livewireStyles
</head>
<body>
    <div style="height: 100vh; width: 100%">
    <!-- Navegação! -->
        <section class="container">
            @auth()
                <nav style="background-color: #f3fffd" class="navbar navbar-light navbar-expand-lg">
                    <div class="container-fluid">
                    <a class="navbar-brand" href="{{route('dashboard')}}">
                        <img src="{{asset('img/logo.png')}}"
                             height="50"
                             width="150"
                             class="d-inline-block align-top"/>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('customers')}}">Clientes</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav w-100 d-flex justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Perfil
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('profile')}}">Perfil</a></li>
                                    @can('Exibir Funcionários')
                                        <li>
                                            <a class="dropdown-item" href="{{route('employees')}}">Funcionários</a>
                                        </li>
                                    @endcan
                                    <hr class="mb-0">
                                    <li>
                                        <form method="post" action="{{route('logout')}}">
                                            @method("POST")
                                            @csrf
                                            <button class="dropdown-item" type="submit">Sair</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                </nav>
            @endauth
            <div class="container-fluid">
                @if (session()->has('message'))
                    <div class="toast show align-items-center position-fixed top-0 m-3 end-0 text-bg-{{session('class')}} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{session('message')}}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @isset($slot)
                {{ $slot }}
                @endisset
            </div>
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    @livewireScripts
</body>
</html>
