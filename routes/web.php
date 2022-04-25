<?php

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;

// Este use se utiliza cuando usamos el Route::resource
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ExcelPruebaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Este metodo lo que hace es declarar mas rutas asociadas al inicio de sesion y el registro 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); // {{ route('home) }}

//* Aplicamos 2 middleware, el 1 primero es para que el usuario haya iniciado sesión y el segundo middleware es que el usuario sea de tipo rol administrador
// ! Nota: Al aplicar el middleware aqui, ya no es necesario aplicar en cada controlador
Route::middleware(['auth', 'admin'])->group(function () {
    // Specialty
    // Estas 3 rutas gestionan vistas
    // Esta ruta se va a ocupar para listar las especialidades
    Route::get('/specialties', [App\Http\Controllers\SpecialtyController::class, 'index']); // Esta ruta va devolver una vista de las especialidades

    // Esta ruta nos va a devolver un formulario para registrar nuevas especialidades
    Route::get('/specialties/create', [App\Http\Controllers\SpecialtyController::class, 'create']); // Vamos a ver el formulario de registro. Esta peticion la hacemos al visitar la pagina de registro

    // Esta ruta nos va a permitir editar una especialidad determinada.
    // Las llaves que se muestran representan a un parametro de rutas, es decir, ahi ira el id de la especialidad que queremos editar y se va atender a traves del metodo edit
    Route::get('/specialties/{specialty}/edit', [App\Http\Controllers\SpecialtyController::class, 'edit']);


    // Esta ruta gestiona el registro de nuevas especialidades
    // También tenemos que tener una peticion POST para que la informacion se guarde en la base de datos
    Route::post('/specialties', [App\Http\Controllers\SpecialtyController::class, 'store']); //Esta peticion se lleva a cabo cuando se envia el form de registro (operacion insert en BD)

    // Ruta para la actualización de los datos. Rutas que gestiona la edicion de una especialidad determinada 
    Route::put('/specialties/{specialty}', [App\Http\Controllers\SpecialtyController::class, 'update']);

    // Va a encargarse de eliminar una especialidad en nuestra BD
    Route::delete('/specialties/{specialty}', [App\Http\Controllers\SpecialtyController::class, 'destroy']);


    //Rutas asociadas a los médicos. Vamos a definir una ruta de tipo recurso y laravel se va a encargar de definir las rutas correspondientes.
    // Indicamos nuestra entidade en plural 'doctors' e indicamos el controlador y esto va a generar las multiples rutas (lo que hicimos arriba) que necesitamos para gestionar los datos de una entidad. O sea, va a crear una ruta que permita listar, registrar, editar , rutas put de medicos.
    Route::resource('doctors', DoctorController::class);
                                
    // Rutas asociadas a los pacientes
    Route::resource('patients', PatientController::class);

});
