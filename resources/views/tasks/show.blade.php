@extends('layouts.navbar')
@section('title', 'Tasks')
<head>
    <link rel="stylesheet" href="{{ asset('css/tasksForm.css') }}">
</head>
@section('content')
    <div class="edit-task-page">
        <a class="navbar-button" href="{{ route('tasks.index') }}">Regresar a las tareas</a>
        <h1>Aqui editas tus tareas</h1>
        <form class="task-form" action="{{ route('tasks.update', $task) }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="tenant" id="tenant" value="{{$task->tenant}}">
            <label for="title">Titulo <br>
                <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}">
            </label>
            @error('title')
                <br>
                <small>*{{ $message }}</small>
                <br>
            @enderror
            <br>
            <label for="description">Descripcion <br>
                <textarea id="description" name="description" cols="30" rows="10">{{ old('description', $task->description) }}</textarea>
            </label>
            @error('description')
                <br>
                <small>*{{ $message }}</small>
                <br>
            @enderror
            <br>
            <label for="is_important">Es importante <input type="checkbox" id="is_important" name="is_important" value="1"
                @if ($task->is_important) checked @endif></label><br><br>
            <button type="submit">Editar</button>
        </form>
        <form class="delete-task-form" action="{{ route('tasks.destroy', $task) }}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="tenant" id="tenant" value="{{$task->tenant}}">
            <button type="submit">Borrar</button>
        </form>
        @if (!$task->completed)
            <form class="complete-task-form" action="{{ route('completed.store', $task) }}" method="post">
                @csrf
                @method('put')
                <button type="submit">Completar Tarea</button>
            </form>
        @else
            <p>Tarea Completa {{ $task->updated_at }}</p>
        @endif
    </div>
@endsection
