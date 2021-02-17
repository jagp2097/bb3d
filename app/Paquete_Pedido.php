<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Paquete_Pedido extends Pivot
{
    protected $table = 'paquetes_pedidos';
    protected $fillable = [
        'pedido_id', 'paquete_id', 'cantidad', 'medida', 'base', 'archivo', 'entregable', 'comentario',
        'pedido_direccion', 'pedido_codigo_postal', 'pedido_estado', 'pedido_ciudad',
        'pedido_colonia', 'pedido_telefono', 'pedido_referencia_direccion'
    ];

    public function getFullAddressAttribute()
    {
      return sprintf("%s, %s, C.P. %s Col. %s Calle %s", $this->pedido_ciudad, $this->pedido_estado, $this->pedido_codigo_postal,
        $this->pedido_colonia, $this->pedido_direccion);
    }

}
