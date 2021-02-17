<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = 'paquetes';
    protected $fillable = [
      'nombre', 'descripcion', 'precio', 'foto', 'publicado', 'entregable'
    ];

    public function ventas()
    {
      return $this->belongsToMany(Venta::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'paquetes_pedidos');
    }

}
