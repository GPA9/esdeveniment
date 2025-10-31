@extends('layouts.master')

@section('titulo', 'Detalls de l\'Esdeveniment')

@section('content')
<div class="mt-5"></div>

{{-- Missatges flash --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="card" style="width: 24rem;">
        <div class="card-header text-center" style="font-weight: bold; text-transform: uppercase;">           
            <h3 class="card-title">{{ $esdeveniment->nom }}</h3>
        </div>
        <img src="{{ $esdeveniment->imatge }}" class="card-img-top" alt="Imatge de {{ $esdeveniment->nom }}" style="height:300px; object-fit: cover;">
        <div class="card-body text-center">
            <p class="card-text"><strong>Descripció:</strong> {{ $esdeveniment->descripcio }}</p>
            <p class="card-text"><strong>Data:</strong> {{ $esdeveniment->data }} a les {{ $esdeveniment->hora }}</p>
            <p class="card-text"><strong>Edat mínima:</strong> {{ $esdeveniment->edat_minima }} anys</p>
            <p class="card-text"><strong>Nombre màxim d'assistents:</strong> {{ $esdeveniment->num_max_assistents }}</p>
            <p class="card-text"><strong>Reserves disponibles: </strong>{{ $disponible}}</p>
            <p class="card-text"><strong>Categoria:</strong> {{ $esdeveniment->categoria->nom }}</p>

            {{-- Botons --}}
            <div class="d-flex justify-content-evenly">
                <a href="{{ route('esdevenimen.index') }}" class="btn btn-dark">{{ __('Tornar') }}</a>
                {{-- Com volem que el usuari no administrador sigui el unic que pugui reservar un esdeveniment,
                li diem que si es un usuari sense el correu del administrador, pot veure el boto de reserva, en cas contrari, no --}}
                @if(Auth::user()->email !== 'admin@admin.cat')
                    @if($esdeveniment->usuaris->contains(Auth::id()))
                        <form action="{{ route('esdevenimen.cancelarReserva', $esdeveniment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Cancel·lar reserva</button>
                        </form>
                    @elseif($disponible > 0)
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reserveModal">
                            Reservar
                        </button>
                    @else
                        <button class="btn btn-secondary" disabled>No hi ha places</button>
                    @endif
                @endif
                {{-- Aqui al reves, nomes es mostra el boto si el usuari es admin --}}
                @if(Auth::user()->email === 'admin@admin.cat')
                    <a href="{{ route('esdevenimen.edit', $esdeveniment->id) }}" class="btn btn-warning">{{ __('Editar') }}</a>
                    <form action="{{ route('esdevenimen.destroy', $esdeveniment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Eliminar') }}</button>
                    </form>
                @endif
            </div>
        </div>
        {{-- Modal per a confirmar la reserva --}}
        <div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="reserveModalLabel">Confirmar Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tancar"></button>
                </div>
                <div class="modal-body">
                <p>Estàs reservant per a:</p>
                <p><strong>{{ $esdeveniment->nom }}</strong></p>
                <p>
                    {{$esdeveniment->data }}
                    a les {{$esdeveniment->hora}}
                </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel·lar
                </button>
                <form action="{{ route('esdevenimen.reservar', $esdeveniment->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-dark">Confirmar</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@stop