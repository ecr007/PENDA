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

/*Route::get('/register/{data?}', 'RegisterController@index')->name('register');

Route::get('/register-success', 'RegisterController@done')->name('done-register');

Route::get('/register-verify/{token}', 'RegisterController@verify')->name('verify-register');

Route::post('/register', 'RegisterController@store')->name('store-register');

Route::group(['middleware' => ['auth','role:guest,administrator']],function(){
	
});*/

// Acortador de enlaces
Route::get('/short/{key}', function($key){
	$url = App\Short::where('key',$key)->first();

	if(!is_null($url)){
		return redirect($url->value);
	}

	abort(404);
})->name('short');

// Panel
Route::group(['middleware' => ['auth','verify','role:guest,administrator']],function(){
	
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	// Iterface route example estandar
	# --> Route::get('/name', 'NameController@index')->name('name');
	# --> Route::get('/name/create', 'NameController@create')->name('create-name');
	# --> Route::post('/name/store', 'NameController@store')->name('store-name');
	# --> Route::get('/name/edit/{id}', 'NameController@edit')->name('edit-name');
	# --> Route::post('/name/update/{id}', 'NameController@update')->name('update-name');
	# --> Route::get('/name/destroy/{id}', 'NameController@destroy')->name('destroy-name');
});


Route::get('/home', 'HomeController@index')->name('home');
