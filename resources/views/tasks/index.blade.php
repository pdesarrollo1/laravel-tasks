@extends('layouts.navbar')
@section('title', 'Tasks')

<head>
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
</head>
@section('content')
    <div class="task-page">
        <h1>Estas son tus tareas</h1>
        <a class="task-button" href="{{ route('tasks.create') }}">Crear Una Tarea</a>
        <form action="{{ route('tasks.filter') }}" method="POST" id="formFilter" class="filter">
            @csrf
            <input type="hidden" name="data" id="data" value="0">
            <select name="filterOptions" id="filterOptions">
                <option value="0">Todas</option>
                <option value="1">No importantes</option>
                <option value="2">Importantes</option>
            </select>
        </form>
        <ul class="task-list">
            @foreach ($tasks as $task)
                @if ($task->is_important)
                    <strong>
                        <li><a href="{{ route('tasks.show', ['id' => $task->id, 'tenant' => $task->tenant]) }}"
                                style="color: red">{{ $task->title }}</a></li>
                    </strong>
                @else
                    <li><a
                            href="{{ route('tasks.show', ['id' => $task->id, 'tenant' => $task->tenant]) }}">{{ $task->title }}</a>
                    </li>
                @endif
            @endforeach

        </ul>
        <img src="{{ asset('img/batman.png') }}" alt="description of myimage">
        {{-- {{ $tasks->links() }} --}}
    </div>
@endsection
<script src="{{ asset('js/taskFilter.js') }}"></script>
