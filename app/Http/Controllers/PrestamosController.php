<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamos;
use App\PrestamosTransacciones;
use App\Socios;
use App\TipoTransacciones;

class PrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "title" => "Prestamos",
            "current" => "prestamos",
            "records" => Prestamos::orderBy('created_at','desc')->get()
        ];

        return view("prestamos/index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "title" => "Crear prestamo",
            "current" => "prestamos",
            "socios" => Socios::get(),
        ];

        return view("prestamos/create",$data);
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
            'socio' => 'required|integer|min:1',
            'balance' => 'required|numeric|min:1',
            'tasa_interes' => 'required|integer|min:1',
            'tiempo' => 'required|integer|min:1',
        ]);

        $set = new Prestamos();

        $set->socio_id = $request->input('socio');
        $set->balance_sin_intereses = $request->input('balance');

        // Calcular balance
        $balance = $request->input('balance');
        $tasa = $request->input('tasa_interes');
        $tiempo = $request->input('tiempo');

        for ($i = 1; $i <= $tiempo; $i++) {
            $balance += $balance * ($tasa/100);
        }

        $set->balance_inicial = $balance;
        $set->balance = $balance;
        $set->tasa = $tasa;

        $set->cuotas_restantes = $tiempo*12;
        $set->monto_cuota = $balance/$set->cuotas_restantes;

        // Prestamo sin aprobar
        $set->status = 0;

        $set->numero = 0;

        if ($set->save()) {

            $set->numero = $set->id;

            $set->save();

            $tipo = TipoTransacciones::where("nombre","Deposito")->first();

            $transaccion = new PrestamosTransacciones();

            $transaccion->prestamo_id = $set->id;
            $transaccion->tipo_transaccion_id = $tipo->id;
            $transaccion->monto = $balance;
            $transaccion->save();

            return redirect()->route('prestamos')->with('success',__('msj.str_success'));
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
        $record = Prestamos::where('status',1)->find($id);

        if (is_null($record)) {
            return back()->with('error',__('msj.str_not_found'));
        }

        $data = [
            "title" => "Prestamo No.".$record->numero,
            "current" => "prestamos",
            "record" => $record,
        ];

        return view("prestamos/show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Prestamos::where('status',0)->find($id);

        if (is_null($record)) {
            return back()->with('error',__('msj.str_not_found'));
        }

        $data = [
            "title" => "Editar prestamos No.".$record->numero,
            "current" => "prestamos",
            "record" => $record,
            "socios" => Socios::get(),
        ];

        return view("prestamos/edit",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aprobar($id)
    {
        $record = Prestamos::where('status',0)->find($id);

        if (is_null($record)) {
            return back()->with('error',__('msj.str_not_found'));
        }

        $record->status = 1;

        if ($record->save()) {
            return back()->with('success','Prestamos No.'.$record->numero.' aprobado satisfactoriamente.');
        }

        return back()->with('error',__('msj.str_not_found'));
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
        $record = Prestamos::where('status',0)->find($id);

        if (is_null($record)) {
            return back()->with('error',__('msj.str_not_found'));
        }

        $request->validate([
            'socio' => 'required|integer|min:1',
            'balance' => 'required|numeric|min:1',
            'tasa_interes' => 'required|integer|min:1',
            'tiempo' => 'required|integer|min:1',
        ]);

        $record->socio_id = $request->input('socio');
        $record->balance_sin_intereses = $request->input('balance');
        

        // Calcular balance
        $balance = $record->balance_sin_intereses;
        $tasa = $request->input('tasa_interes');
        $tiempo = $request->input('tiempo');

        for ($i = 1; $i <= $tiempo; $i++) {
            $balance += $balance * ($tasa/100);
        }

        $record->balance_inicial = $balance;
        $record->balance = $balance;
        $record->tasa = $tasa;

        $record->cuotas_restantes = $tiempo*12;
        $record->monto_cuota = $balance/$record->cuotas_restantes;

        // Prestamo sin aprobar
        $record->created_at = date("Y-m-d H:i:s");

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
        $record = Prestamos::where('status',0)->find($id);

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
