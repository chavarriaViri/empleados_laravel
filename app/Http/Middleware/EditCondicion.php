<?php

namespace App\Http\Middleware;
use App\Empleado; 
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditCondicion
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
        $name = $request->get('puesto') == 'Tester';

        $id_p = $request->empleado;
        
        //var_dump($id_p);

        $sql = 'SELECT estado FROM empleado WHERE id = "$id_p"';
        $empleado = DB::select($sql);
        //var_dump ($empleado);

        $properties = Empleado::whereId($id_p)->get(['estado']);
        //var_dump ($properties);

        if(Empleado::whereId($id_p)->get(['estado']) == "32"){
             return redirect()->route('empleado.index')->with('success','No se pueden editar personas del estado de Zacatecas');
      
        }
        return $next($request);
    }
}
