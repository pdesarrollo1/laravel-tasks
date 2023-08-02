<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ url('/css/header.css') }}" /> --}}
</head>

<body>
    <nav class="navbar">
        <ul>
            <form action="{{ route('logout') }}" method="POST">
                <li><a href="{{ route('home') }}">Inicio</a></li>
                @guest
                    <li><a href={{ route('login') }}>Iniciar sesión</a></li>
                    <li><a href={{ route('signup') }}>Registrarse</a></li>
                @endguest
                @auth
                    <li><a href="{{ route('tasks.index') }}">Tareas</a></li>
                    <li><a href="{{ route('completed.index') }}">Tareas Completadas</a></li>
                    <li><a href="{{ route('session.index') }}">Sesiones</a></li>

                    @csrf
                    <button type="submit">Cerrar Sesion</button>

                @endauth
            </form>
        </ul>
    </nav>

    @yield('content')

</body>

</html>
