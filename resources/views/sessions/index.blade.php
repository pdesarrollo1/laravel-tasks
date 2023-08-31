@extends('layouts.navbar')
@section('title', 'Sessions')

<head>
    <style>
        .sessions-page {
            background-color: #f2f2f2;
            padding: 20px;
            min-height: 80%;
        }

        .sessions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sessions-table th,
        .sessions-table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .sessions-table th {
            background-color: #ddd;
            text-align: left;
        }

        .sessions-table td {
            text-align: center;
        }

        .close-session-button {
            background-color: #4CAF50;
            color: #fff;
            padding: 6px 12px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .close-session-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
@section('content')
    <div class="sessions-page">
        <table class="sessions-table">
            <thead>
                <th>User</th>
                <th>IP</th>
                <th>User Agent</th>
                <th>Ultima actividad</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($sessions as $session)
                    <tr>
                        <td>{{ $session->name }}</td>
                        <td>{{ $session->ip_address }}</td>
                        <td>{{ $session->user_agent }}</td>
                        <td>{{ $dateTime = date('Y-m-d H:i:s', $session->last_activity) }}</td>
                        @if (session()->getId() !== $session->id)
                            <td>
                                <button class="close-session-button" onclick="sendForm('{{ $session->id }}')">Cerrar
                                    Sesión</button>
                            </td>
                        @else
                            <td>Tu Sesion</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('session.store') }}" method="post" id="form">
            @csrf
            <input type="text" id="input" name="input" hidden>
        </form>
    </div>
@endsection
<script>
    function sendForm(id) {
        let input = document.getElementById('input');
        let form = document.getElementById('form');
        input.value = id;
        form.submit();
    }
</script>
