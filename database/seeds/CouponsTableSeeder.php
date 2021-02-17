<?php

use Illuminate\Database\Seeder;
use bagrap\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Coupon::create([

            'codigo' => 'ABC123', 
            'valor_descuento' => 220, 
            'fecha_inicio' => "2019-05-23", 
            'fecha_fin' => "2019-05-29", 
            'tipo_cupon' => "descuento",

        ]);

        Coupon::create([

            'codigo' => 'EFG123', 
            'valor_descuento' => 150, 
            'fecha_inicio' => "2019-05-23", 
            'fecha_fin' => "2019-05-29", 
            'tipo_cupon' => "descuento",

        ]);

    }
}
