<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = [
        'user_id', 'transaction_id', 'pedido_email', 'pedido_nombre', 'pedido_nombre_en_tarjeta',
        'pedido_subtotal', 'pedido_tax', 'pedido_total', 'entregado', 'error',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paquetes()
    {
        return $this->belongsToMany(Paquete::class, 'paquetes_pedidos')->using(Paquete_Pedido::class)
                        ->withPivot([
                          'pedido_id', 'paquete_id', 'cantidad', 'medida', 'base', 'archivo', 'entregable', 'comentario',
                          'pedido_direccion', 'pedido_codigo_postal', 'pedido_estado', 'pedido_ciudad',
                          'pedido_colonia', 'pedido_telefono', 'pedido_referencia_direccion'
                        ]);
    }



}
