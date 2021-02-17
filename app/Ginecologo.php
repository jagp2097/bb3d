<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Ginecologo extends Model
{
    protected $table = 'ginecologos';
    protected $fillable = [
      'nombre', 'ap_pa', 'ap_ma', 'estado', 'municipio', 'direccion', 'telefono',
    ];

    public function getFullNameAttribute()
    {
      return sprintf('%s %s %s', $this->nombre, $this->ap_pa, $this->ap_ma);
    }
}
