<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Cupon_Producto extends Model
{
    protected $table = "cupon_producto";
    protected $fillable = [
        'cupon_pedido', 'porcentaje_descuento',	'usado'

    ];

    // public function cupones()
    // {
    //     return $this->morphMany(Cupon::class, 'cupontable');
    // }

    public function pedido_productos()
    {
        return $this->hasMany(Cupon_Producto_Pedido::class);
    }


}
