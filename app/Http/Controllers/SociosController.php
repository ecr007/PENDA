<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Socios;
use App\Provincias;
use App\Municipios;

class SociosController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data = [
			"title" => "Socios",
			"current" => "socios",
			"records" => Socios::orderBy('created_at','desc')->get()
		];

		return view("socios/index",$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data = [
			"title" => "Crear socio",
			"current" => "socios",
			"provincias" => Provincias::get(),
		];

		return view("socios/create",$data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'nombre' => 'required|min:3|max:40',
			'apellido' => 'required|min:3|max:50',
			'cedula' => 'required|min:10|max:11',
			'telefono' => 'required|numeric|min:10',
			'celular' => 'required|numeric|min:10',
			'provincia' => 'required|integer|min:1',
			'municipio' => 'required|integer|min:1',
			'direccion' => 'required|min:10|max:255',
		]);

		$set = new Socios();

		$set->nombre = $request->input('nombre');
		$set->apellido = $request->input('apellido');
		$set->cedula = $request->input('cedula');
		$set->telefono = $request->input('telefono');
		$set->celular = $request->input('celular');
		$set->provincia = $request->input('provincia');
		$set->municipio = $request->input('municipio');
		$set->direccion = $request->input('direccion');

		if ($set->save()) {
			return redirect()->route('socios')->with('success',__('msj.str_success'));
		}
		else{
			return back()->with('error',__('msj.str_error'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{

		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$record = Socios::find($id);

		if (is_null($record)) {
			return back()->with('error',__('msj.str_not_found'));
		}

		$data = [
			"title" => "Editar ".$record->name,
			"current" => "socios",
			"record" => $record,
			"provincias" => Provincias::get(),
			"municipios" => Municipios::get(),
		];

		return view("socios/edit",$data);
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
		$record = Socios::find($id);

		if (is_null($record)) {
			return back()->with('error',__('msj.str_not_found'));
		}

		$request->validate([
			'nombre' => 'required|min:3|max:40',
			'apellido' => 'required|min:3|max:50',
			'cedula' => 'required|min:10|max:11',
			'telefono' => 'required|numeric|min:10',
			'celular' => 'required|numeric|min:10',
			'provincia' => 'required|integer|min:1',
			'municipio' => 'required|integer|min:1',
			'direccion' => 'required|min:10|max:255',
		]);

		$record->nombre = $request->input('nombre');
		$record->apellido = $request->input('apellido');
		$record->cedula = $request->input('cedula');
		$record->telefono = $request->input('telefono');
		$record->celular = $request->input('celular');
		$record->provincia = $request->input('provincia');
		$record->municipio = $request->input('municipio');
		$record->direccion = $request->input('direccion');

		if ($record->save()) {
			return back()->with('success',__('msj.str_success_update'));
		}
		else{
			return back()->with('error',__('msj.str_error_update'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$record = Socios::find($id);

		if (is_null($record)) {
			return back()->with('error',__('msj.str_not_found'));
		}

		if($record->delete()){
			return back()->with('success',__('msj.str_success_delete'));
		}
		else{
			return back()->with('error',__('msj.str_error_delete'));
		}
	}
}