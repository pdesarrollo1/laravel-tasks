@extends('layouts.navbar')
@section('title', 'Tasks')

@section('content')
    <h1>Estas son tus tareas</h1>
    <a href="{{route('tasks.create')}}">Crear Una Tarea</a>
    <ul>
        @foreach ($tasks as $task)
        <li><a href="{{route('tasks.show', $task->id)}}">{{$task->title}}</a></li>
        @endforeach
    </ul>
    <img src="{{ asset('img/batman.png') }}" alt="description of myimage">

    {{$tasks->links()}}
@endsection
