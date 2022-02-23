@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nueva especialidad</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('specialties') }}" class="btn btn-sm btn-danger">Regresar</a>
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


        <form action="{{ url('/specialties') }}" method="post">
        <!-- Laravel siempre por seguridad nos exige usar un token @csrf en las peticiones de tipo POST  -->
        @csrf
        <div class="form-group">
            <label for="name">Nombre de la especialidad</label>
            <!-- En el value vamos a poner lo que el usuario puso, para que cuando se recargue la pagina vea el error que cometio. old se activa cuando una validacion ha fallado -->
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>

        </form>
    </div>
</div>
@endsection
