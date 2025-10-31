@extends('layouts.master')

@section('titulo', 'Crear Esdeveniment')

@section('content')
    <div class="container mt-5">
        <h2>Afegir un Nou Esdeveniment</h2>

        <form method="POST" action="{{ route('esdevenimen.store') }}">
            @csrf

            <label>Nom de l'esdeveniment:</label>
            <input type="text" name="nom" class="form-control" required>

            <label>Descripció:</label>
            <textarea name="descripcio" class="form-control"></textarea>

            <label>Data:</label>
            <input type="date" name="data" class="form-control" required>

            <label>Hora:</label>
            <input type="time" name="hora" class="form-control" required>

            <label>Nombre màxim d'assistents:</label>
            <input type="number" name="num_max_assistents" class="form-control">

            <label>Edat mínima:</label>
            <input type="number" name="edat_minima" class="form-control">

            <label>Imatge (URL):</label>
            <input type="text" name="imatge" class="form-control">

            <label>Categoria:</label>
            <select name="categoria_id" class="form-control">
                @foreach($categories as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nom }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-success mt-3">Crear Esdeveniment</button>
        </form>
    </div>
@stop