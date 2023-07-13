@extends('layouts.navbar')
@section('title', 'Tasks')

@section('content')
    <a href="{{ route('tasks.index') }}">Regresar a las tareas</a>
    <h1>Aqui editas tus tareas</h1>
    <form action="{{ route('tasks.update', $task) }}" method="post">

        @csrf
        @method('put')
        <label for="">Titulo <br><input type="text" name="title" value="{{ old('title', $task->title) }}"></label>
        @error('title')
            <br>
            <small>*{{ $message }}</small>
            <br>
        @enderror
        <br>
        <label for="">Descripcion <br>
            <textarea name="description" cols="30" rows="10">{{ old('description', $task->description) }}</textarea>
        </label>
        @error('description')
            <br>
            <small>*{{ $message }}</small>
            <br>
        @enderror
        <br>
        <label for="">Es importante <input type="checkbox" name="is_important" value="1"
                @if ($task->is_important) checked @endif></label><br><br>
        <button type="submit">Editar</button>
    </form>
    <form action="{{ route('tasks.destroy', $task) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Borrar</button>
    </form>

@endsection
