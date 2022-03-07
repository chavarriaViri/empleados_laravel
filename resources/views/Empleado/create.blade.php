@extends('layouts.layout')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                @if(count($errors) >0)
                    <div class="alert alert-warning">
                        {!! trans('validation.mesg_error_validate') !!}

                        <ul>
                            @foreach($errors->all() as $error)
                                <li> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Agregar Empleado</h3>
                    </div>
                    <div class="panel-body">
                        <form method ="POST" action="{{route('empleado.store')}}">
                            {{csrf_field()}}
                            
                            <div class = "row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type = "text" name = "nombre" id="nombre" class="form-control input sm" placeholder="Nombre del empleado" value={{ old('nombre') }}> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type = "text" name = "puesto" id="puesto" class="form-control input sm" placeholder="Puesto del empleado" value={{ old('puesto') }} > 
                                    </div>
                                </div>
                            </div>

                            <div class = "row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type = "number" name = "edad" id="edad" class="form-control input sm" placeholder="Edad del empleado" value={{ old('edad') }}> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type = "number" name = "salario" id="salario" class="form-control input sm" placeholder="Sueldo del empleado" value={{ old('salario') }}> 
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <p class="">Estado</p>
                                        <select class="form-control" id="estado" name="estado">
                                            @foreach($lstEstados as $estado)
                                                <option value="{{$estado->id_estado}}"> {{$estado->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <p class="">Tipo de moneda</p>
                                        <select class="form-control" id="tipo_moneda" name="tipo_moneda">
                                        @foreach(explode(';', $lstmoneda) as $moneda)
                                                <option value="{{$moneda}}"> {{$moneda}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <p>Activo</p>
                                            <input type="checkbox" name="activo" id="activo" class="form-control input-sm" >    
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success" >Guardar</button>
                                    <a href="{{ route('empleado.index')  }}" class="btn btn-default"> Atras</a>
                                </div>
                            </div>
                            
                            
                        </form>   
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection