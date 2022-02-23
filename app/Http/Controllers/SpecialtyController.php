<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Para poder usar la clase Specialty Añadimos una directiva use
use App\Models\Specialty;


class SpecialtyController extends Controller{
    // Forma de decirle a laravel que esta vista solo sera para usuarios autenticados o iniciado sesión
// Se agrega un Middleware de autenticacion (se puede aplicar en un constructor de un controlador )
public function __construct(){
        // Esto significa que todas las rutas que este controlador resuelva van a exigir al usuario que haya iniciado sesión y si no lo esta lo mando a la vista de login
        $this->middleware('auth');
    }

    // Funcion para hacer las validaciones desde el servidor y le pasomos la informacion a validar
    private function performValidation( Request $request){
        // Vamos añadir unas validaciones en el servidor. Cuando usamos la funcion validate podemos usar las validaciones del framework, para usarla tenemos que poner como minimo 2 parametros.
        // 1 parametro: indicando que es lo que se va a evaluar 
        // 2 parametro: las reglas de validacion para los campos
        // 3 parametro(opcional): mensajes personalizados para los errores que ocurran
        $rules = [
            'name' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre.',
            'name.min'      => 'Como minimo el nombre debe tener 3 caracteres.',
        ];

        $this->validate($request, $rules, $messages);
    }

    //Vamos a definir un primer método index que va a devolver una vista
    public function index(){
        //Esta vista debe de estar ubicadad en resources/views/specialties
        //Tambien vamos a inyectar datos sobre esta vista(index), o sea, la lista de especialidades. De tal manera que utilizamos el modelo Specialty y usamos el método all.
        // El modelo fue creado y se encuentra en models
        $specialties = Specialty::all();
        // Para pasar esta informacion ponemos un segundo parametro y dentro de la funcion compact indicamos el nombre de las variables que queremos pasar 
        return view('specialties.index', compact('specialties'));
    }

    public function create(){
          //Esta vista debe de estar ubicadad en resources/views/create
        return view('specialties.create');
    }

    // Recibe un parametro request con informacion de la peticion que se esta llevando a cabo
    public function store( Request $request){
        // Para ejecutar la validaciones. Tenemos que agregar el request ya que es la información y de tal manera para hacer las validaciones se necesita informacion
        $this->performValidation($request);

        // Con esto mostramos en pantalla los datos que se estan enviando
        // dd($request->all());

        //Con esto registraremos o guardaremos los datos del formulario "Nueva especialidad"
        // Creamos un nuevo objeto de esta clase
        $specialty = new Specialty();
        // Y le asignamos los valores que vienen desde el formulario
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        // Una vez que este objeto recibe la informacion llamamos al metodo save y esto va a realizar la operacion de insert en nuestra base de datos
        $specialty->save();//INSERT

        // Ejecutamos un return back para que el usuario vuelva a la pagina donde se encontraba antes, o sea, el formulario de registro
        // return back();

        // O podemos hacer un redirect y mandar al usuario para que vea la lista de especialidades
        // Al momento de registrar un nuevo dato vamos a mostrar una notificacion de que se ha agregado. Notification es una variable y va a contener un mensaje de notificacion que se va a mostrar en la vista.
        $notification = 'La especialidad se ha registrado correctamente.';
        return redirect('/specialties')->with(compact('notification'));

    }

    public function edit(Specialty $specialty){
        // Esta vista va a recibir una variable que sera la especialidad seleccionada. Laravel busca la informacion de la especialidad con ese ID y nos devuelve directamente un objeto (Specialty $specialty) para que podamos hacer operaciones
        // La operacion que haremos es enviar esa informacion(objeto) a la vista edit

        return view('specialties.edit', compact('specialty'));
    }

    public function update( Request $request, Specialty $specialty){
        // Para ejecutar la validaciones
        $this->performValidation($request);

        // Vamos a usar el objeto $specialty que el metodo update recibe
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); // UPDATE

        $notification = 'La especialidad se ha actualizado correctamente.';
        return redirect('/specialties')->with(compact('notification'));

    }

    // Aqui solo necesitamos la especialidad que se quiere eliminar
    public function destroy(Specialty $specialty){
        // Tenemos que salvar el nombre para que se pueda mostrar despues de haberse eliminado
        $deleteNameSpecialty = $specialty->name;

        $specialty->delete();

        // Para mostrar que especialidad hemos eliminado podemos concatenar
        $notification = 'La especialidad: '. $deleteNameSpecialty .', se ha eliminado correctamente.';
        return redirect('/specialties')->with(compact('notification'));
    }

}
