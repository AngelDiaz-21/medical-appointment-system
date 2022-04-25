@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Pacientes</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('patients/create') }}" class="btn btn-sm btn-success">Nuevo paciente</a>
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
                    <th scope="col">E-mail</th>
                    {{-- <th scope="col">DNI</th> --}}
                    <th scope="col">Phone</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aqui vamos a iterar. Para cada una de las especialidades (doctors) las vamos a tratar como doctor  -->
                @foreach ($patients as $patient)
                <tr>
                    <th scope="row">{{ $patient->name }}</th>
                    <td>{{ $patient->email }}</td>
                    {{-- <td>{{ $patient->dni }}</td> --}}
                    <td>{{ $patient->phone }}</td>
                    <td>

                        <form action="{{ url('/patients/' .$patient->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            {{-- Tenemos que poner el id, como es codigo PHP concatenamos una variable e imprimir el id de cada una de las especialidades de las tablas--}}
                            <a href="{{ url('/patients/' .$patient->id. '/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                            
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Si en dado caso tenemos problemas con mostrar la paginación o nos aparecen iconos muy grandes "revisar el oneNote" con anotaciones de laravel --}}
    <div class="card-body">
        {{ $patients->links() }}
    </div>
</div>
@endsection
