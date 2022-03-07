<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectByName
{
    protected $auth; //solo se ocupa en el controlador
    public function __construct(Guard $auth) //obtener el usuario que esta autenticado "Guard"
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) //la funcion handle que intersecta en la petion http
    {
        if($this->auth->user()->name != 'Admin'){
            //$this->auth->logout();
            return redirect()->route('empleado.index')->with('success','Solo el usuario Administrador puede realizar esa acción');

        }
        return $next($request);
    }
}
