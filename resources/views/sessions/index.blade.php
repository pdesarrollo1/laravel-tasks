@extends('layouts.navbar')
@section('title', 'Sessions')


@section('content')
    <table>
        <thead>
            {{-- <th>Id</th> --}}
            <th>User</th>
            <th>IP</th>
            <th>User Agent</th>
            {{-- <th>Payload</th> --}}
            {{-- <th>Ultima actividad</th> --}}
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($sessions as $session)
                <tr>
                    {{-- <td>{{ $session->id }}</td> --}}
                    <td>{{ $session->name }}</td>
                    <td>{{ $session->ip_address }}</td>
                    <td>{{$session->user_agent}}</td>
                    {{-- <td>{{$session->payload}}</td> --}}
                    {{-- <td>{{ $session->last_activity }}</td> --}}
                    @if (session()->getId() !== $session->id)
                        <td><button onclick="sendForm('{{ $session->id }}')">Cerrar Sesion</button></td>
                    @endif
                </tr>
            @endforeach
            <form action="{{ route('session.store') }}" method="post" id="form">
                @csrf
                <input type="text" id="input" name="input" hidden>
            </form>
        </tbody>

    </table>
@endsection
<script>
    function sendForm(id) {
        let input = document.getElementById('input');
        let form = document.getElementById('form')
        input.value = id;
        form.submit();
    }
</script>
