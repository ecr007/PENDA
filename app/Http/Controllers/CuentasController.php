<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuentas;
use App\CuentasTransacciones;
use App\Socios;
use App\TipoTransacciones;

class CuentasController extends Controller
{
    public function index()
	{
		$data = [
			"title" => "Cuentas",
			"current" => "cuentas",
			"records" => Cuentas::orderBy('created_at','desc')->get()
		];

		return view("cuentas/index",$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data = [
			"title" => "Crear cuenta",
			"current" => "cuentas",
			"socios" => Socios::get(),
		];

		return view("cuentas/create",$data);
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
			'socio' => 'required|integer|min:1|max:20',
			'balance' => 'required|numeric|min:1',
		]);

		$set = new Cuentas();

		$set->socio_id = $request->input('socio');
		$set->balance = $request->input('balance');
		$set->numero = 0;

		if ($set->save()) {

			$set->numero = $set->id;

			$set->save();

			$transaccion = new CuentasTransacciones();

			$tipo = TipoTransacciones::where("nombre","Deposito")->first();

	        $transaccion->cuenta_id = $set->id;
	        $transaccion->tipo_transaccion_id = $tipo->id;
	        $transaccion->monto = $set->balance;
	        $transaccion->save();

			return redirect()->route('cuentas')->with('success',__('msj.str_success'));
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
		$record = Cuentas::find($id);

		if (is_null($record)) {
			return back()->with('error',__('msj.str_not_found'));
		}

		$data = [
			"title" => "Cuenta No.".$record->numero,
			"current" => "cuentas",
			"record" => $record,
		];

		return view("cuentas/show",$data);
	}
}
