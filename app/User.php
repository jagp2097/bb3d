<?php

namespace bagrap;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use bagrap\Notifications\ResetPassword as ResetPassword;
use bagrap\Notifications\VerifyEmail as VerifyEmail;
// use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'email', 'password', 'role_id', 'is_active',
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if ($this->role_id == 1 && $this->is_active == 1) {
            return true;
        }

        return false;
    }

    public function isActive()
    {

        return $this->is_active ? true : false;

        // if ($fecha_hoy->greaterThanOrEqualTo($fecha_limite) && $this->is_active == 0) {
        
        //     $fecha_hoy = Carbon::now();
        //     $fecha_limite = $this->updated_at->addYear();
        //     // dd($fecha_hoy);
        //     // $user = Auth::user();
        //     // $user->delete($user->id);
        //         return false;

        //     } elseif ($fecha_hoy->lessThanOrEqualTo($fecha_limite) && $this->is_active == 0) {    
        //         return true;
        //     }
    }

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($role)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function sendEmailVerificationNotification() 
    {
        $this->notify(new VerifyEmail());
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function perfil()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts() 
    {
        return $this->hasOne(Post::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

}
