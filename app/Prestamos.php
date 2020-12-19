<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    protected $table = 'prestamos';
    protected $guarded = [];

    public function getNumeroAttribute($value)
    {
        return str_pad($value, 8, '0', STR_PAD_LEFT);
    }

    public function socio()
    {
    	return $this->belongsTo('App\Socios',"socio_id");
    }

    public function transacciones()
    {
    	return $this->hasMany('App\PrestamosTransacciones', 'prestamo_id', 'id');
    }
}
