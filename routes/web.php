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
    return redirect()->route('login');
});

//replace with laravel register route
Auth::routes(['register' => false]);

// Panel
Route::group(['middleware' => ['auth','verify','role:guest,administrator']],function(){
	
	Route::get('/transacciones', 'TransaccionesController@index')->name('transacciones');
	Route::get('/transacciones/create-cuenta/{id}', 'TransaccionesController@createCuenta')->name('create-cuenta-transacciones');
	Route::get('/transacciones/create-prestamo/{id}', 'TransaccionesController@createPrestamo')->name('create-prestamo-transacciones');
	Route::post('/transacciones/store-cuenta', 'TransaccionesController@storeCuenta')->name('store-cuenta-transacciones');
	Route::post('/transacciones/store-prestamo', 'TransaccionesController@storePrestamo')->name('store-prestamo-transacciones');

	Route::post('/municipios', 'MunicipiosController@index')->name('municipios');

	Route::get('/socios', 'SociosController@index')->name('socios');
	Route::get('/socios/create', 'SociosController@create')->name('create-socios');
	Route::post('/socios/store', 'SociosController@store')->name('store-socios');
	Route::get('/socios/edit/{id}', 'SociosController@edit')->name('edit-socios');
	Route::post('/socios/update/{id}', 'SociosController@update')->name('update-socios');
	Route::get('/socios/destroy/{id}', 'SociosController@destroy')->name('destroy-socios');

	Route::get('/cuentas', 'CuentasController@index')->name('cuentas');
	Route::get('/cuentas/create', 'CuentasController@create')->name('create-cuentas');
	Route::post('/cuentas/store', 'CuentasController@store')->name('store-cuentas');
	Route::get('/cuentas/show/{id}', 'CuentasController@show')->name('show-cuentas');
	Route::get('/cuentas/destroy/{id}', 'CuentasController@destroy')->name('destroy-cuentas');

	Route::get('/prestamos', 'PrestamosController@index')->name('prestamos');
	Route::get('/prestamos/create', 'PrestamosController@create')->name('create-prestamos');
	Route::post('/prestamos/store', 'PrestamosController@store')->name('store-prestamos');
	Route::get('/prestamos/show/{id}', 'PrestamosController@show')->name('show-prestamos');
	Route::get('/prestamos/edit/{id}', 'PrestamosController@edit')->name('edit-prestamos');
	Route::get('/prestamos/aprobar/{id}', 'PrestamosController@aprobar')->name('aprobar-prestamos');
	Route::post('/prestamos/update/{id}', 'PrestamosController@update')->name('update-prestamos');
	Route::get('/prestamos/destroy/{id}', 'PrestamosController@destroy')->name('destroy-prestamos');

	Route::get('/tipos-transacciones', 'TipoTransaccionesController@index')->name('tipos-transacciones');
	Route::get('/tipos-transacciones/create', 'TipoTransaccionesController@create')->name('create-tipos-transacciones');
	Route::post('/tipos-transacciones/store', 'TipoTransaccionesController@store')->name('store-tipos-transacciones');
	Route::get('/tipos-transacciones/edit/{id}', 'TipoTransaccionesController@edit')->name('edit-tipos-transacciones');
	Route::post('/tipos-transacciones/update/{id}', 'TipoTransaccionesController@update')->name('update-tipos-transacciones');

	// Iterface route example estandar
	# --> Route::get('/name', 'NameController@index')->name('name');
	# --> Route::get('/name/create', 'NameController@create')->name('create-name');
	# --> Route::post('/name/store', 'NameController@store')->name('store-name');
	# --> Route::get('/name/edit/{id}', 'NameController@edit')->name('edit-name');
	# --> Route::post('/name/update/{id}', 'NameController@update')->name('update-name');
	# --> Route::get('/name/destroy/{id}', 'NameController@destroy')->name('destroy-name');
});