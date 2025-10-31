@extends('layouts.master')

@section('titulo', 'INDEX')

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

{{-- Si filtrem per categoria, mostrem el títol --}}
@isset($categoriaNom)
    <h3 class="mb-4">Esdeveniments de la categoria: <strong>{{ $categoriaNom }}</strong></h3>
@endisset

<div class="row">
    @foreach($esdeveniments as $esdev)
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <a href="{{ route('esdevenimen.show', $esdev->id) }}" style="text-decoration: none;">
            <div class="card h-100" style="min-height: 350px;">
                <img src="{{ $esdev->imatge }}" class="card-img-top" alt="Imatge de {{ $esdev->nom }}" style="height:200px; object-fit: cover;">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    {{-- Contenidor per als badges--}}
                    <div class="mb-2">
                        {{-- Badge segons l'estat de l'esdeveniment --}}
                        @if($esdev->usuaris()->where('user_id', Auth::id())->exists())
                            <span class="badge bg-warning">Reservat</span>
                        @elseif($esdev->num_reserves >= $esdev->num_max_assistents)
                            <span class="badge bg-danger">Complet</span>
                        @else
                            <span class="badge bg-success">Disponible</span>
                        @endif

                        {{-- Badge que mostra el nombre de reserves registrades --}}
                        <span class="badge bg-info">
                            Reserves: {{ $esdev->usuaris()->count() }}
                        </span>
                    </div>

                    <h5 class="card-title" style="color: #17262c;">{{ $esdev->nom }}</h5>
                    <p class="card-text">{{ $esdev->data }} - {{ $esdev->hora }}</p>
                    <button class="btn btn-primary mt-auto">{{ __('Veure esdeveniment') }}</button>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="mt-4 w-100 d-flex justify-content-center">
    {{ $esdeveniments->links() }}  <!-- Paginació -->
</div>
@stop