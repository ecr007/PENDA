<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socios extends Model
{
    protected $table = 'socios';
    protected $guarded = [];

    public function cuentas()
    {
    	return $this->hasMany('App\Cuentas', 'socio_id', 'id');
    }

    public function prestamos()
    {
    	return $this->hasMany('App\Cuentas', 'socio_id', 'id');
    }

    public function provincias()
    {
        return $this->belongsTo('App\Provincias',"provincia","id");
    }

    public function municipios()
    {
        return $this->belongsTo('App\Municipios',"municipio","id");
    }
}
