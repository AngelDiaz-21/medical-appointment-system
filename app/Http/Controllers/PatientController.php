<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    private function performValidation (Request $request){
        $rules = [
            'name'    => 'required|min:3',
            // El método email va a verificar que el correo tenga un @ y un dominio
            'email'   => 'required|email',
            // ! nullable va a permitir que los campos no sean requires pero si en dado caso se escribe algún valor la cantidad de digitos debe de ser obligatoria
            // 'dni'     => 'nullable|digits: 8',
            'address' => 'nullable|min:5',
            'phone'   => 'nullable|min:6'
        ];

        $this->validate($request, $rules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // * Si queremos paginar o mostrar cuantos pacientes queremos mostrar usamos "paginate(numeros_usuarios_a_mostrar_por_pagina)"
        // ! En este caso estamos mostrando 5 usuarios por pagina pero tambien debemos decidir en donde mostrar las páginas, eso se hace en el index
        $patients = User::patients()->paginate(5);
        return view ('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('patients.create');
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
                'role' => 'patient',
                'password' => bcrypt($request->input('password'))
                
            ]
        );

        $notification = 'El paciente se ha registrado correctamente.';
        return redirect('/patients')->with(compact('notification'));
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
    public function edit( User $patient)
    {
        return view('patients.edit', compact('patient'));
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
        $user = User::patients()->findOrFail($id);

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

        $notification = 'La información del paciente se ha actualizado correctamente.';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        $patientName = $patient->name;

        $patient->delete();

        // Podemos poner la variable directamente ya que estamos usando comillas dobles
        $notification = "El médico $patientName se ha eliminado correctamente.";
        // Hacemos la redirección y enviamos la variable notification que estamos definiendo
        return redirect('/patients')->with(compact('notification'));
    }
}
