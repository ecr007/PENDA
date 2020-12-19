<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrestamosTransacciones extends Model
{
    protected $table = 'prestamos_transacciones';
    protected $guarded = [];

    public function tipo()
    {
    	return $this->belongsTo('App\TipoTransacciones',"tipo_transaccion_id");
    }

    public function prestamo()
    {
    	return $this->belongsTo('App\Prestamos',"prestamo_id");
    }
}
