<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    protected $fillable = [
      'nombre_album', 'descripcion',
    ];

    public function archivos()
    {
      return $this->hasMany(Archivo::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

}
