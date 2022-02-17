@extends('layouts.form')

<!-- Como el titulo va a hacer una linea sola  podemos abreviar esto, como un parametro-->
@section('title', 'Inicio de sesión')

@section('subtitle', 'Ingresa tus datos para iniciar sesión')


@section('content')
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">
                <!-- <div class="card-header bg-transparent pb-5">
                    <div class="text-muted text-center mt-2 mb-3">
                        <small>Sign in with</small>
                    </div>
                    <div class="btn-wrapper text-center">
                        <a href="#" class="btn btn-neutral btn-icon">
                            <span class="btn-inner--icon">
                                <img src="{{ asset('img/icons/common/github.svg') }}">
                            </span>
                            <span class="btn-inner--text">Github</span>
                        </a>
                        <a href="#" class="btn btn-neutral btn-icon">
                            <span class="btn-inner--icon">
                                <img src="{{ asset('img/icons/common/google.svg') }}">
                            </span>
                            <span class="btn-inner--text">Google</span>
                        </a>
                    </div>
                </div> -->
                <div class="card-body px-lg-5 py-lg-5">
                    <!-- <div class="text-center text-muted mb-4">
                        <small>Ingresa tus datos para iniciar sesión</small>
                    </div> -->
                    <form role="form" method="POST" action="{{ route('login') }}">
                    <!-- Todo formulario que hace una peticion POST necesita un token "csrf" -->
                    @csrf

                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="ni ni-email-83"></i>
                                    </span>
                                </div>
                                <input class="form-control @error('email') is-invalid @enderror" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="ni ni-lock-circle-open"></i>
                                    </span>
                                </div>
                                <input class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" type="password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="custom-control custom-control-alternative custom-checkbox">
                            <!-- Con el old para que este campo recuerde si el usuario habia marcado o no el checkbo en caso de ingresar unos datos incorrectos-->
                            <input name="remember" class="custom-control-input" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">
                                <span class="text-muted">Recordar sesión</span>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <a href="{{ route('password.request') }}" class="text-light">
                        <small>¿Olvidaste tu contraseña?</small>
                    </a>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('register') }}" class="text-light">
                        <small>¿Aún no te has registrado?</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
