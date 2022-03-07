@extends('layouts.layout')
@section('content')
    
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                @if(\Illuminate\Support\Facades\Session::has('success')))
                    <div class = "alert alert info">
                        {{\Illuminate\Support\Facades\Session::get('success')}}
                    </div>
                @endif
                <div class="panel-body">
                    <div><h3>Lista Empleados</h3></div>
                    <br>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{route('empleado.create')}}" class="btn btn-success">Añadir empleado</a>
                        </div>
                    </div>
                    </br></br><br>
                    <div class="table-container">
                        <table id="tablaEmpleados" class="table table-bordered table-striped">
                            <thead>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Puesto</th>
                                <th>Activo</th>
                                <th>Sueldo</th>
                                <th>Tipo Moneda</th>
                                <th>Estado</th>
                                <th colspan="3" >Acciones</th>
                            </thead>
                            <tbody>

                            @if($empleados->count())
                                @foreach($empleados as $empleado)
                                    <tr>
                                        <td>{{$empleado->nombre}}</td>
                                        <td>{{$empleado->edad}}</td>
                                        <td>{{$empleado->puesto}}</td>
                                        <td>{{$empleado->activo}}</td>
                                        <td>{{$empleado->salario}}</td>
                                        <td>{{$empleado->tipo_moneda}}</td>
                                        <td>
                                        @foreach($lstEstados as $estado)
                                            @if($empleado->estado == $estado->id_estado)
                                                {{$estado->nombre}}
                                            @endif
                                        @endforeach
                                        </td>
                                        
                                        <td><a href = "{{route('empleado.show',$empleado->id)}}" class="btn btn-warning"> Mostrar </a></td>
                                        <td><a href = "{{route('empleado.edit',$empleado->id)}}" class="btn btn-primary"> Editar </a></td>
                                        <td>
                                        <form action = "{{route('empleado.destroy',$empleado->id)}}" method = "post">
                                            {{csrf_field()}}
                                            <input name="_method" type="hidden" value="delete">
                                            <input type="submit" onclick ="return confirm('¿Quieres eliminarlo?') " value="Eliminar"  class="btn btn-danger">     
                                         </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No hay registros</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection



