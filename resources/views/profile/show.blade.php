@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-5 text-center">{{ __('Perfil d\'usuari') }}</h2>

            <div class="card">
                <div class="card-header" style="background-color: #17262c; color: white;">{{ __('Informació del perfil') }}</div>

                <div class="card-body">
                    <!-- Nom -->
                    <div class="mb-3">
                        <label class="form-label">{{ __('Nom') }}</label>
                        <div class="form-control">{{ auth()->user()->name }}</div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">{{ __('Email') }}</label>
                        <div class="form-control">{{ auth()->user()->email }}</div>
                    </div>

                    <!-- Edat -->
                    <div class="mb-3">
                        <label class="form-label">{{ __('Edat') }}</label>
                        <div class="form-control">{{ auth()->user()->age }}</div>
                    </div>

                    <!-- Rol -->
                    <div class="mb-3">
                        <label class="form-label">{{ __('Rol') }}</label>
                        <div class="form-control">{{ auth()->user()->rol }}</div>
                    </div>

                    <!-- Botó per editar -->
                    <div class="text-end">
                        <a href="{{ route('profile.edit') }}" class="btn" style="background-color: #17262c; color: white;">
                            {{ __('Editar perfil') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection