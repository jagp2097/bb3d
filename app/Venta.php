<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $fillable = [
      'user_id', 'paquete_id', 'pais', 'estado', 'ciudad',
      'codigo_postal', 'direccion', 'referencia_lugar', 'total',
    ];

    public function paquetes()
    {
      return $this->belongsToMany(Paquete::class);
    }
}
