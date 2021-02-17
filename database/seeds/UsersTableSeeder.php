<?php

use Illuminate\Database\Seeder;
use bagrap\Role;
use bagrap\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.importar clases de la carpeta vendor
     *
     * @return void
     */
    public function run()
    {

      $role_admin = Role::where('name', 'Administrador')->first();

      $user = new User();
      $user = User::create([
          'role_id'    => 1,
          'is_active'  => 1,
          'email'      => 'admin@admin.com',
          'password'   => bcrypt('admin'),
          'openpay_id' => null,
          'email_verified_at' => Carbon::now(),
        ]);

      // Creación del perfil
      $profile = $user->perfil()->create([
          'nombre'           => 'Administrador',
          'apellidos'        => 'admin',
          'fecha_nacimiento' => '10/03/1997',
          'pais_origen'      => 'México',
          'telefono'         => '8181378841',
          'foto'             => 'default.png',
        ]);

      $user->save();

    }
}
