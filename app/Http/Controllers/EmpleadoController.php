<?php

namespace App\Http\Controllers;
use App\Empleado; //porque se va a utilizar el modelo del empleado

use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;


class EmpleadoController extends Controller
{

    public function __construct()
    {
        //Linea para agregar un Middleware a las funciones del controlador
        $this->middleware('auth');
        $this->middleware('authByName')->only('create','edit','destroy');
    }

    //Funciones basicas del CRUD
    //Tiene funciones similares por ejemplo create y store

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstEstados = $this->obtenerEstadosWS();
       //paginete:funcion para mostrar registros limitados en varias páginas
       //Consultas a base de datos
        $empleados = Empleado::orderBy('id','DESC')->paginate(6); //obtener registro de la bd
        //$empleados = Empleado::where('nombre','orcar')->get()->paginate(3); //obtener registros con condiciones
        return view('Empleado.index',compact('empleados'),compact('lstEstados')); //retornar en una vista 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //peticion get para mostrar el formulario para crear registro
    {
        $lstmoneda = $this->obtenerTipoMonedaWS();
       //return view('Empleado.create',compact('lstmoneda'));
        //retornar una vista 
        //return view('Empleado.create');
        //return ($lstmoneda);
        $lstEstados = $this->obtenerEstadosWS();
        //return ($lstEstados);
        return view('Empleado.create',compact('lstEstados'),compact('lstmoneda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //peticion post para almacenar en base de datos lo que venga en el formulario create()
    {
        $this->validate($request,[
            'nombre' => 'required',
            'nombre' => 'required',
            'edad' => 'required',
            'puesto' => 'required',
            'salario'=> 'required',
            'estado'=> 'required',
            'tipo_moneda'=>'required']);

        $arrayUpdate =[
            'nombre' => $request->get("nombre"),
            'edad' => $request->get('edad'),
            'puesto' => $request->get('puesto'),
            'salario' => $request->get('salario'),
            'activo' => $request->has('activo') ? $request->get('activo') : 0,
            'estado' => $request->get('estado'),
            'tipo_moneda' => $request->get('tipo_moneda')
        ];

        Empleado::create($arrayUpdate);

        return redirect()->route('empleado.index')->with('success','Registro creado satisfactoriamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //peticion post que es para enviar datos al formulario de editar
    {
        $empleado=Empleado::find($id);
        return  view('Empleado.show',compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id) //peticion get: para mostrar el formulario que se va a editar
    {
        $lstmoneda = $this->obtenerTipoMonedaWS();
        $lstEstados = $this->obtenerEstadosWS();
        $empleado=Empleado::find($id); //busca el id indicado y envia todo el registro con el id
        return view('Empleado.edit',compact('empleado'),compact('lstmoneda','lstEstados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//post se envia para almacenar en base de datos
    {
        $this->validate($request,['nombre'=>'required',  'edad'=>'required', 'puesto'=>'required', 'salario'=>'required']);

        Empleado::find($id)->update($request->all());
        return redirect()->route('empleado.index')->with('success','Registro actualizado satisfactoriamente');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //peticion puede ser get o delete  para eliminar el registro a la bd
    {
        Empleado::find($id)->delete();
        return redirect()->route('empleado.index')->with('success','Registro eliminado satisfactoriamente');

    }

    private function obtenerEstadosWS(){

        $client = new HttpClient(['base_uri' => 'https://beta-bitoo-back.azurewebsites.net/api/']); //HttpClient es el alias de la libreria
        $response = $client->request('POST',"proveedor/obtener/lista_estados");
        //dd((json_decode($response->getBody())->data->lst_estado_proveedor));
        return json_decode($response->getBody())->data->lst_estado_proveedor;

    }

    private function obtenerTipoMonedaWS(){

        $client = new HttpClient(['base_uri' => 'https://fx.currencysystem.com/webservices/CurrencyServer5.asmx/']);
        $response = $client->get("AllCurrencies?licenseKey=")->getBody();
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        //$name = explode(';',$xml);
        //$array = json_decode($json);
        //$bien = explode(';',$json);
        return $json;
    }
}
