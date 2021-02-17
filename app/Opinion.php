<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $table = "opiniones";
    protected $filled = [
        'email', 'nombre', 'opinion', 
    ];
}
