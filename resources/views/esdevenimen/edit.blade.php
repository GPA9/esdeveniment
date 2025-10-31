@extends('layouts.master')

@section('titulo', 'Editar Esdeveniment')

@section('content')
    <div class="container mt-5">
        <h2>Editar Esdeveniment: {{ $esdeveniment->nom }}</h2>

        <form method="POST" action="{{ route('esdevenimen.update', $esdeveniment->id) }}">
            @csrf
            @method('PUT')

            <label>Nom de l'esdeveniment:</label>
            <input type="text" name="nom" class="form-control" value="{{ $esdeveniment->nom }}" required>

            <label>Descripció:</label>
            <textarea name="descripcio" class="form-control">{{ $esdeveniment->descripcio }}</textarea>

            <label>Data:</label>
            <input type="date" name="data" class="form-control" value="{{ $esdeveniment->data }}" required>

            <label>Hora:</label>
            <input type="time" name="hora" class="form-control" value="{{ $esdeveniment->hora }}" required>

            <label>Nombre màxim d'assistents:</label>
            <input type="number" name="num_max_assistents" class="form-control" value="{{ $esdeveniment->num_max_assistents }}">

            <label>Edat mínima:</label>
            <input type="number" name="edat_minima" class="form-control" value="{{ $esdeveniment->edat_minima }}">

            <label>Imatge (URL):</label>
            <input type="text" name="imatge" class="form-control" value="{{ $esdeveniment->imatge }}">

            <label>Categoria:</label>
            <select name="categoria_id" class="form-control">
                @foreach($categories as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id == $esdeveniment->categoria_id ? 'selected' : '' }}>
                        {{ $categoria->nom }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-warning mt-3">Actualizar Esdeveniment</button>
        </form>
    </div>
@stop