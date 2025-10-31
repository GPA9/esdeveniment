@extends('layouts.master')

@section('titulo', 'Iniciar sessió')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Títol i Logotip de l'aplicació -->
        <div class="d-flex justify-content-center mt-4">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('img/logo1.png') }}" alt="Logotip de l'aplicació" class="img-fluid" style="max-width: 200px;">
                <h1 class="display-5 m-0">ARTIISTIC</h1>
            </div>
        </div>

        <p class="lead mt-3 text-center">
            Descobreix i participa en els millors esdeveniments! Podràs veure informació detallada de cada esdeveniment, consultar disponibilitat i inscriure't per gaudir d'experiències úniques. 
            Registra't o inicia sessió per començar!
        </p>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #17262c; color: white;">{{ __('Login') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contrasenya') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recorda’m') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background-color: #17262c; color: white;">
                                    {{ __('Iniciar sessió') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Has oblidat la teva contrasenya?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    <div class="mt-3">
                        <p>Encara no tens compte? <a href="{{ route('register') }}">Registra't aquí</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection