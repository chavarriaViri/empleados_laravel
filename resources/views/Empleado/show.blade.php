@extends('layouts.layout')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Datos del Empleado</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-container">
                            <input name="_method" type="hidden" value="PATCH">

                            <div class = "row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class = "form_control">Nombre: {{$empleado->nombre}}</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class = "form_control">Puesto: {{$empleado->puesto}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class = "row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class = "form_control"> Edad: {{$empleado->edad}}</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class = "form_control"> Salario: {{$empleado->salario}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control">Activo: {{$empleado->activo == 1 ? 'Si': 'No'}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('empleado.index')}}" class="btn btn-default"> Atras</a>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

