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
            <label for="company">Empresa:</label>
            <input type="text" id="company" name="company" value="{{ old('company') }}" required>
            @error('company')
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
        <div class="column-container">
            <div>
                <p id="length" style="color: red;">8 caracteres</p>
            </div>
            <div>
                <p id="lower" style="color: red;">1 minúscula</p>
            </div>
            <div>
                <p id="upper" style="color: red;">1 mayúscula</p>
            </div>
            <div>
                <p id="number" style="color: red;">1 número</p>
            </div>
            <div>
                <p id="especial" style="color: red;">1 carácter especial</p>
            </div>
        </div>

        {{-- <p id="messageSecurity"></p> --}}

        {{-- <div class="form-group">
            <label for="confirm-password">Confirmar contraseña:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
        </div> --}}
        <button type="submit">Registrarse</button>
    </form>
    <script>
        inputElement = document.getElementById('password')
        inputElement.addEventListener('input', () => {
            var password = document.getElementById('password').value;
            var messageSecurity = document.getElementById('messageSecurity');
            // Verificar la fortaleza de la contraseña
            var strength = getPasswordStrength(password);
            // Mostrar el mensaje de seguridad correspondiente
            if (strength === 0) {
                messageSecurity.textContent = 'Contraseña muy débil';
                messageSecurity.style.color = 'red';
                return messageSecurity.textContent;
            } else if (strength === 1) {
                messageSecurity.textContent = 'Contraseña débil';
                messageSecurity.style.color = 'red';
                return messageSecurity.textContent;
            } else if (strength === 2) {
                messageSecurity.textContent = 'Contraseña de nivel medio';
                messageSecurity.style.color = 'orange';
                return messageSecurity.textContent;
            } else if (strength === 3) {
                messageSecurity.textContent = 'Contraseña fuerte';
                messageSecurity.style.color = 'green';
                return messageSecurity.textContent;
            } else if (strength === 4) {
                messageSecurity.textContent = 'Contraseña muy fuerte';
                messageSecurity.style.color = 'green';
                return messageSecurity.textContent;
            } else if (strength >= 5) {
                messageSecurity.textContent = 'Contraseña muy fuerte';
                messageSecurity.style.color = 'green';
                return messageSecurity.textContent;
            }
        });

        function getPasswordStrength(password) {
            var strength = 0;
            document.getElementById('length').style.color = 'red';
            document.getElementById('lower').style.color = 'red'
            document.getElementById('upper').style.color = 'red'
            document.getElementById('number').style.color = 'red'
            document.getElementById('especial').style.color = 'red'
            // Verificar la longitud de la contraseña
            if (password.length >= 6 && password.length < 8) {
                strength = 1;
            } else if (password.length >= 8) {
                strength = 2;
                document.getElementById('length').style.color = 'green';
            }
            // Verificar si la contraseña contiene caracteres especiales
            if (/[$@#&!]/.test(password)) {
                strength++;
                document.getElementById('especial').style.color = 'green'
            }
            // Verificar si la contraseña contiene letras mayúsculas y minúsculas
            if (/[A-Z]/.test(password)) {
                strength++;
                document.getElementById('upper').style.color = 'green'
            }
            if (/[a-z]/.test(password)) {
                strength++;
                document.getElementById('lower').style.color = 'green'
            }
            // Verificar si la contraseña contiene números
            if (/[0-9]/.test(password)) {
                strength++;
                document.getElementById('number').style.color = 'green'
            }
            return strength;
        }
    </script>

@endsection
