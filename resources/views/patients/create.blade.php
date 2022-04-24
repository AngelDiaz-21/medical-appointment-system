@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nueva paciente</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('patients') }}" class="btn btn-sm btn-danger">Regresar</a>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Con esto podemos mostrar los errores que nos mande el servidor. Vamos a iterar por cada uno de los errores y mostrar cada error en un li -->
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ url('/patients') }}" method="post">
        <!-- Laravel siempre por seguridad nos exige usar un token @csrf en las peticiones de tipo POST  -->
        @csrf
        <div class="form-group">
            <label for="name">Nombre del paciente</label>
            <!-- En el value vamos a poner lo que el usuario puso, para que cuando se recargue la pagina vea el error que cometio. old se activa cuando una validacion ha fallado -->
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        {{-- <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" name="dni" class="form-control" value="{{ old('dni') }}">
        </div> --}}
        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
        </div>
        <div class="form-group">
            <label for="phone">Télefono / móvil</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="text" name="password" class="form-control" value="{{ Str::random(6) }}">
        </div>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</div>
@endsection
