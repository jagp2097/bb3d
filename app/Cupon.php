<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = "cupons";

    public function cupontable()
    {
        return $this->morphTo();
    }
}

