@extends('layouts.master')

@section('titulo', 'Llista de Categories')

@section('content')
    <div class="container mt-5">
        <h2>Categories Disponibles</h2>
        <ul class="list-group">
            @foreach($categories as $categoria)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $categoria->nom }}
                    <div>
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estàs segur que vols eliminar aquesta categoria?');">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@stop