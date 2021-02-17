<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Cupon_Descuento extends Model
{
    protected $table = "cupon_descuento";
    protected $fillable = [
        'porcentaje_descuento',	'fecha_inicio',	'fecha_fin'
    ];

    public function cupones()
    {
        return $this->morphMany(Cupon::class, 'cupontable');
    }

}
