<?php

use Illuminate\Database\Seeder;
use bagrap\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $rol = new Role();
      $rol->name = 'Administrador';
      $rol->save();


      $rol = new Role();
      $rol->name = 'Usuario';
      $rol->save();


    }
}
