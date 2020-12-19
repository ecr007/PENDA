<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentasTransacciones extends Model
{
    protected $table = 'cuentas_transacciones';
    protected $guarded = [];

    public function tipo()
    {
    	return $this->belongsTo('App\TipoTransacciones',"tipo_transaccion_id");
    }

    public function cuenta()
    {
    	return $this->belongsTo('App\Cuentas',"cuenta_id");
    }
}
