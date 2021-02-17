<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
      'user_id', 'nombre', 'apellidos', 'fecha_nacimiento',
      'pais_origen', 'telefono', 'foto',
    ];

    public function getFullNameAttribute()
    {
      return sprintf('%s %s', $this->nombre, $this->apellidos);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
