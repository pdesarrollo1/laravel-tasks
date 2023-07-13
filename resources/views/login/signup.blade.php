@extends('layouts.navbar')
@section('title', 'Signup')
<head>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
@section('content')
    <form class="registration-form" method="POST" action="{{ route('signup.store') }}">
        <h2>Registro</h2>
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                {{ $message }}
            @enderror
        </div>

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
        </div>

        {{-- <div class="form-group">
            <label for="confirm-password">Confirmar contraseña:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
        </div> --}}
        <button type="submit">Registrarse</button>
    </form>

@endsection
