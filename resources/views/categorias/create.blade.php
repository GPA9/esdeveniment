@extends('layouts.master')

@section('titulo', 'Crear Categoria')

@section('content')
    <div class="container mt-5">
        <h2>Afegir Nova Categoria</h2>
        <form method="POST" action="{{ route('categorias.store') }}">
            @csrf
            <label>Nom de la categoria:</label>
            <input type="text" name="nom" class="form-control" required>
            <button type="submit" class="btn btn-success mt-3">Crear Categoria</button>
        </form>
    </div>
@stop