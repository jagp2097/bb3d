<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $table = "coupons";
    protected $fillable = [
        'codigo', 'porcentaje_descuento', 'valor_descuento', 'fecha_inicio', 'fecha_fin', 'tipo_cupon',
    ];

    public function cupon_pedido()
    {
        return $this->hasMany(Cupon_Producto_Pedido::class);
    }
    
    public function descuento($total)
    { 
        
        if ($this->tipo_cupon == "descuento_porcentaje") {
            return round(($this->porcentaje_descuento / 100) * $total);
        } elseif ($this->tipo_cupon == "descuento_efectivo") {
            return $this->valor_descuento;
        } else {
            return 0;
        }
        
    }
    
    public static function findByCode($codigo)
    {
        return self::where('codigo', '=', $codigo)->first();
    }

    public function vigencia()
    {

        $fecha_hoy = Carbon::now();
        $fecha_vigencia = new Carbon($this->fecha_fin);

        if ($fecha_hoy->greaterThanOrEqualTo($fecha_vigencia)) {

            $this->delete($this->id);
            
            return true;

        }

        return false;

    }


}