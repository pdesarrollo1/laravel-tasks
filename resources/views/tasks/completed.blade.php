@extends('layouts.navbar')
@section('title', 'Tasks')

<head>
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
</head>
@section('content')
    <div class="task-page">
        <h1>Estas son tus tareas completadas</h1>
        <a class="task-button" href="{{ route('tasks.create') }}">Crear Una Tarea</a>
        <ul class="task-list">
            @foreach ($tasks as $task)
                @if ($task->is_important)
                    <strong>
                        <li><a href="{{ route('tasks.show', $task->id) }}" style="color: red">{{ $task->title }}</a></li>
                    </strong>
                @else
                    <li><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a></li>
                @endif
            @endforeach
        </ul>
        <img src="{{ asset('img/batman.png') }}" alt="description of myimage">
        {{ $tasks->links() }}
    </div>
@endsection
