@extends('layouts.master')

@section('titulo', 'Editar Categoria')

@section('content')
    <div class="container mt-5">
        <h2>Editar Categoria</h2>
        <form method="POST" action="{{ route('categorias.update', $categoria->id) }}">
            @csrf
            @method('PUT')
            <label>Nom de la categoria:</label>
            <input type="text" name="nom" class="form-control" value="{{ $categoria->nom }}" required>
            <button type="submit" class="btn btn-warning mt-3">Actualizar Categoria</button>
        </form>
    </div>
@stop