<?php

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

Auth::routes(); //para las rutas

Route::get('/home', 'HomeController@index')->name('home');

//incluye todas las rutas para el crud automaticamente
// Route::resource('empleado','EmpleadoController'); //rutas del controlador EmpleadosControlador para el CRUD (create, update), se pueden ver con el comando:

//Rutas (individuales), ejem: 'EmpledoController@index' siempre tiene que ir dependiendo de la funcion
Route::get('empleado', 'EmpleadoController@index')->name('empleado.index');

Route::get('empleado/create','EmpleadoController@create')->name('empleado.create');
Route::post('empleado','EmpleadoController@store')->name('empleado.store'); 

Route::get('empleado/{empleado}/show','EmpleadoController@show')->name('empleado.show'); //{parametros}

Route::get('empleado/{empleado}/edit','EmpleadoController@edit')->name('empleado.edit')->middleware('EditCondicion'); //{parametros}
Route::put('empleado/{emppleado}','EmpleadoController@update')->name('empleado.update');


Route::delete('empleado/{empleado}','EmpleadoController@destroy')->name('empleado.destroy');