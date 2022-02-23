@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Especialidades</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('specialties/create') }}" class="btn btn-sm btn-success">Nueva especialidad</a>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        {{-- Para mostrar la notification de agregado correctamente --}}
        {{-- Decimos que si tenemos una variable de sesion llamada notification vamos a mostrar su valor dentro del alert   --}}
        <div class="card-body">
            @if (session('notification'))
            <div class="alert alert-success" role="alert">
                {{ session('notification') }}
            </div>
            @endif
        </div>
        <!-- specialities table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aqui vamos a iterar. Para cada una de las especialidades (specialties) las vamos a tratar como specialty  -->
                @foreach ($specialties as $specialty)
                <tr>
                    <th scope="row">{{ $specialty->name }}</th>
                    <td>{{ $specialty->description }}</td>
                    <td>

                        <form action="{{ url('/specialties/' .$specialty->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            {{-- Tenemos que poner el id, como es codigo PHP concatenamos una variable e imprimir el id de cada una de las especialidades de las tablas--}}
                            <a href="{{ url('/specialties/' .$specialty->id. '/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                            
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
