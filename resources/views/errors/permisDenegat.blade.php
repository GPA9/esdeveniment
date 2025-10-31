@extends('layouts.master')

@section('titulo', 'Acces denegat')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4 text-danger">Accés denegat</h1>
    <p class="lead">No tens permís per accedir a aquesta pàgina.</p>
    <a href="{{ route('esdevenimen.index') }}" class="btn btn-dark">{{ __('Tornar') }}</a>
</div>
@endsection