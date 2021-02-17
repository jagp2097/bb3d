<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Cupon_Producto_Pedido extends Model
{
    protected $table = 'cupon_producto_pedidos';
    protected $fillable = ['paquete_id', 'cantidad'];

    public function cupon_producto(Type $var = null)
    {
        return $this->belongsTo(Cupon::class);
    }
    
    
}
