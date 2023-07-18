@extends('layouts.navbar')
@section('title', 'Create Tasks')
<head>
    <link rel="stylesheet" href="{{ asset('css/tasksForm.css') }}">
</head>
@section('content')
    <div class="create-task-page">
        <a class="navbar-button" href="{{ route('tasks.index') }}">Regresar a las tareas</a>
        <h1>Aqui creas tus tareas</h1>
        <form class="task-form" action="{{ route('tasks.store') }}" method="post">
            @csrf
            <label for="title">Titulo <br>
                <input type="text" id="title" name="title" value="{{ old('title') }}">
            </label>
            @error('title')
                <br>
                <small>*{{ $message }}</small>
                <br>
            @enderror
            <br>
            <label for="description">Descripcion <br>
                <textarea id="description" name="description" cols="30" rows="10">{{ old('description') }}</textarea>
            </label>
            @error('description')
                <br>
                <small>*{{ $message }}</small>
                <br>
            @enderror
            <br>
            <label for="is_important">Es importante <input type="checkbox" id="is_important" name="is_important" value="1"></label><br><br>
            <button type="submit">Guardar</button>
        </form>
    </div>
@endsection
