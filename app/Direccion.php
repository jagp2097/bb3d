<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';
    protected $fillable = [
        'user_id', 'calle', 'numero', 'colonia', 'codigo_postal', 
        'localidad','estado', 'pais', 'referencias'
    ];

    public function getFullAdressAttribute()
    {
        return sprintf('Calle: %s #%s, Colonia: %s, C.P. %s, %s, %s, %s', $this->calle, $this->numero, $this->colonia, 
        $this->codigo_postal, $this->localidad, $this->estado, $this->pais);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
