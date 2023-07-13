@extends('layouts.navbar')
@section('title', 'Signin')
<head>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
@section('content')

    <form class="registration-form" method="POST" action="{{ route('login.store') }}">
        <h2>Inciar Sesion</h2>
        @csrf

        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                {{ $message }}
            @enderror
            @error('error')
                {{ $message }}
            @enderror
        </div>

        {{-- <div class="form-group">
            <label for="confirm-password">Confirmar contraseña:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
        </div> --}}
        <button type="submit">Registrarse</button>
    </form>

@endsection
