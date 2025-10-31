@extends('layouts.master')
{{-- 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-5">{{ __('Perfil d\'usuari') }}</h2>

            <!-- Formulari de perfil -->
            <div class="card mb-4">
                <div class="card-header" style="background-color: #17262c; color: white;">{{ __('Actualitzar perfil') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nom') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name', auth()->user()->name) }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- Edat -->
                        <div class="mb-3">
                            <label for="age" class="form-label">{{ __('Edat') }}</label>
                            <input id="age" type="number" class="form-control @error('age') is-invalid @enderror"
                                   name="age" value="{{ old('age', auth()->user()->age) }}" required min="0">
                            @error('age')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- Rol (deshabilitat) -->
                        <div class="mb-3">
                            <label for="rol" class="form-label">{{ __('Rol') }}</label>
                            <input id="rol" type="text" class="form-control" name="rol" 
                                   value="{{ auth()->user()->rol }}" disabled style="background-color: #e9ecef; cursor: not-allowed;">
                        </div>

                        <!-- Botó de guardar -->
                        <div class="text-end">
                            <button type="submit" class="btn" style="background-color: #17262c; color: white;">
                                {{ __('Desar canvis') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Actualitzar contrasenya -->
            <!-- Botó per obrir el pop-up -->
            <div class="mb-4 text-end">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#passwordModal">
                    {{ __('Canviar contrasenya') }}
                </button>
            </div>

            <!-- Pop-up (Modal Bootstrap) -->
            <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #17262c; color: white;">
                            <h5 class="modal-title" id="passwordModalLabel">{{ __('Actualitzar contrasenya') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tancar"></button>
                        </div>
                        <div class="modal-body">
                            @include('profile.partials.update-password-form') <!-- Formulari de contrasenya dins del pop-up -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Eliminar compte -->
            <div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-5">{{ __('Profile')}}</h2>
            <div class="mb-4">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="mb-4">
                @include('profile.partials.update-password-form')
            </div>
            <div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection