<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CuentasTransacciones;
use App\PrestamosTransacciones;
use App\TipoTransacciones;
use App\Cuentas;
use App\Prestamos;

class TransaccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = CuentasTransacciones::orderBy('created_at','desc')->get();
        $prestamos = PrestamosTransacciones::orderBy('created_at','desc')->get();

        $records = $cuentas->merge($prestamos);

        $data = [
            "title" => "Transacciones",
            "current" => "transacciones",
            "records" => $records,
        ];

        return view("transacciones/index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCuenta($id)
    {
        $data = [
            "title" => "Crear transaccion",
            "current" => "transacciones",
            "tipos" => TipoTransacciones::get(),
            "cuenta_id" => $id,
        ];

        return view("transacciones/create-cuenta",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPrestamo($id)
    {
        $data = [
            "title" => "Crear transaccion",
            "current" => "transacciones",
            "tipos" => TipoTransacciones::get(),
            "prestamo" => Prestamos::find($id),
        ];

        return view("transacciones/create-prestamo",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCuenta(Request $request)
    {
        $request->validate([
            'cuenta_id' => 'required|integer|min:1',
            'tipo_transaccion' => 'required|integer|min:1',
            'monto' => 'required|numeric|min:1',
        ]);

        $set = new CuentasTransacciones();

        $set->cuenta_id = $request->input('cuenta_id');
        $set->tipo_transaccion_id = $request->input('tipo_transaccion');
        $set->monto = $request->input('monto');

        if ($set->save()) {

            $record = Cuentas::find($set->cuenta_id);

            // Afectamos la cuenta
            if ($set->tipo->operacion == "-") {

                if($record->balance <= 0){
                    $set->delete();

                    return back()->with('error',"Lo sentimos la cuenta no pose con fondos suficientes.");
                }
                else if($set->monto > $record->balance){
                    $set->delete();

                    return back()->with('error',"Lo sentimos el monto a retirar es mayor al balance de la cuenta.");
                }

                $record->balance -= $set->monto;
            }

            if($set->tipo->operacion == "+"){
                $record->balance += $set->monto;
            }

            $record->save();

            return redirect()->route('show-cuentas',[$set->cuenta_id])->with('success',__('msj.str_success'));
        }
        else{
            return back()->with('error',__('msj.str_error'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePrestamo(Request $request)
    {
        $request->validate([
            'prestamo_id' => 'required|integer|min:1',
            'tipo_transaccion' => 'required|integer|min:1',
            'monto' => 'required|numeric|min:1',
        ]);

        $set = new PrestamosTransacciones();

        $set->prestamo_id = $request->input('prestamo_id');
        $set->tipo_transaccion_id = $request->input('tipo_transaccion');
        $set->monto = $request->input('monto');

        if ($set->save()) {

            $record = Prestamos::find($set->prestamo_id);

            // Afectamos la cuenta
            if ($set->tipo->operacion == "-") {

                if($record->balance <= 0){
                    $set->delete();

                    return back()->with('error',"Lo sentimos, el prestamo ya a sido pagado.");
                }
                else if($set->monto > $record->balance){
                    $set->delete();

                    return back()->with('error',"Lo sentimos, el monto a pagar es mayor a lo adeudado.");
                }

                $record->balance -= $set->monto;
                $record->cuotas_restantes -= 1;
            }

            $record->save();

            return redirect()->route('show-prestamos',[$set->prestamo_id])->with('success',__('msj.str_success'));
        }
        else{
            return back()->with('error',__('msj.str_error'));
        }
    }
}
