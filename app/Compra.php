<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = [
        'user_id', 'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
