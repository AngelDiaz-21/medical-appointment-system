<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// ! NOTA: Este middleware ya no se ocupa ya que se esta definiendo desde routes/web.php en la función
    // public function __construct(){
    //     // Esto significa que todas las rutas que este controlador resuelva van a exigir al usuario que haya iniciado sesión y si no lo esta lo mando a la vista de login
    //     $this->middleware('auth');
    // }


    private function performValidation( Request $request){
        $rules = [
            'name'    => 'required|min:3',
            // El método email va a verificar que el correo tenga un @ y un dominio
            'email'   => 'required|email',
            // ! nullable va a permitir que los campos no sean requires pero si en dado caso se escribe algún valor la cantidad de digitos debe de ser obligatoria
            // 'dni'     => 'nullable|digits: 8',
            'address' => 'nullable|min:5',
            'phone'   => 'nullable|min:6'
        ];
        // $messages = [
        //     'name.required'  => 'Es necesario ingresar un nombre.',
        //     'name.min'       => 'Como minimo el nombre debe tener 3 caracteres.',
        //     'email.required' => 'Es necesario ingresar el email.',
        //     'email.email'    => 'Verifique el uso correcto del @ o del dominio. ',
        //     'dni.digits'     => 'Es necesario ingresar los 8 digitos.',
        //     'address.min'    => 'Como minimo son 5 caracteres.',
        //     'phone.min'      => 'Como minimo son 6 caracteres.',
            
        // ];

        // $this->validate($request, $rules, $messages);
        $this->validate($request, $rules);
    }

    public function index()
    {
        //Estamos haciendo uso del modelo User que se enecuentra en Models
        // * Para obtener solo los usuarios que sean doctores y si en dado caso queremos tener más condiciones solo agregaremos where adicionales
        //  ! Uso de scopes para abreviar las consultas o condiciones. Esto se declara en el modelo
        $doctors = User::doctors()->get();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->performValidation($request);

        // * Otra manera de insertar registros a la base de datos

        // ! Solo seleccionamos los datos que queremos del formulario ya que si en dado algun usuario crea un input para el rol y lo envia, no sería válido.
        // mass assigment (asignación másiva), estamos creando un usuario a través de una asignación masiva de valores para sus atributos y esto no va a funcionar si nosotros no definimos en el modelo user que campos son fillable porque sino este create no se va a ejecutar adecuadamente
        User::create(
            $request->only('name', 'email', 'address', 'phone') 
            + [ 
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
                
            ]
        );

        $notification = 'El médico se ha registrado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ! La funcion findOrFail lo que hace es buscar un medico que tenga el ID y si no lo encuentra va a devolver un error 404 (o la página no existe)
        // ! El findOrFail se utiliza ya que en la carpeta routes, en el archivo web.php estamos definiendo este controlador como "Resources"
        // ! También hacemos uso del scope
        $doctor = User::doctors()->findOrFail($id);
        return view ('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->performValidation($request);

        // * Vamos a obtener una referencia del usuario a partir del ID
        $user = User::doctors()->findOrFail($id);

        // Arreglo asociativo llamado data
        $data = $request->only('name', 'email', 'address', 'phone');
        $password = $request->input('password');
        // Y hacemos una condición si en dado editan el password o no, si es no la contraseña no se verá afectada
        if($password)
            $data['password'] = bcrypt($password);
            
        // Vamos a llenar los campos a través de un arreglo asociativo
        // fill -> Significa llenar
        // Vamos a pasar un arreglo asociativo llamado data
        $user->fill($data);
        // Para que se produzca el update del registro
        $user->save();

        $notification = 'La información del médico se ha actualizado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // ! También podemos hacer el método destroy recibiendo el id del doctor pero otra forma es que podemos tener el medico en cuestion de acuerdo a lo siguiente
    public function destroy(User $doctor)
    {
        // Salvamos el nombre del medico antes de eliminarlo para incluir el nombre en un mensaje de notificacion
        $doctorName = $doctor->name;

        $doctor->delete();

        // Podemos poner la variable directamente ya que estamos usando comillas dobles
        $notification = "El médico $doctorName se ha eliminado correctamente.";
        // Hacemos la redirección y enviamos la variable notification que estamos definiendo
        return redirect('/doctors')->with(compact('notification'));
    }
}
