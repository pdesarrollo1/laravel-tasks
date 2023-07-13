@extends('layouts.navbar')
@section('title', 'Create Tasks')

@section('content')
    <a href="{{ route('tasks.index') }}">Regresar a las tareas</a>
    <h1>Aqui creas tus tareas</h1>
    <form action="{{ route('tasks.store') }}" method="post">

        @csrf
        <label for="">Titulo <br><input type="text" name="title" value="{{ old('title') }}"></label>
        @error('title')
            <br>
            <small>*{{ $message }}</small>
            <br>
        @enderror
        <br>
        <label for="">Descripcion <br>
            <textarea name="description" cols="30" rows="10" value="{{ old('description') }}"></textarea>
        </label>
        @error('description')
            <br>
            <small>*{{ $message }}</small>
            <br>
        @enderror
        <br>
        <label for="">Es importante <input type="checkbox" name="is_important" value="1"></label><br><br>
        <button type="submit">Guardar</button>

    </form>
@endsection
