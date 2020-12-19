<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoTransacciones;

class TipoTransaccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "title" => "Tipos de Transacciones",
            "current" => "tipotransacciones",
            "records" => TipoTransacciones::orderBy('created_at','desc')->get()
        ];

        return view("tipotransacciones/index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "title" => "Crear un tipo de transacción",
            "current" => "tipotransacciones",
        ];

        return view("tipotransacciones/create",$data);
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
            'operacion' => 'required|min:1|max:1',
        ]);

        $set = new TipoTransacciones();

        $set->nombre = $request->input('nombre');
        $set->operacion = $request->input('operacion');

        if ($set->save()) {
            return redirect()->route('tipos-transacciones')->with('success',__('msj.str_success'));
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
        $record = TipoTransacciones::find($id);

        if (is_null($record)) {
            return back()->with('error',__('msj.str_not_found'));
        }

        $data = [
            "title" => "Editar tipo de transaccion: ".$record->name,
            "current" => "tipotransacciones",
            "record" => $record,
        ];

        return view("tipotransacciones/edit",$data);
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
        $record = TipoTransacciones::find($id);

        if (is_null($record)) {
            return back()->with('error',__('msj.str_not_found'));
        }

        $request->validate([
            'nombre' => 'required|min:3|max:40',
            'operacion' => 'required|min:1|max:1',
        ]);

        $record->nombre = $request->input('nombre');
        $record->operacion = $request->input('operacion');

        if ($record->save()) {
            return back()->with('success',__('msj.str_success_update'));
        }
        else{
            return back()->with('error',__('msj.str_error_update'));
        }
    }
}
