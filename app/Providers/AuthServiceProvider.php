<?php

namespace bagrap\Providers;

use Cart;
use Openpay;
use bagrap\Album;
use bagrap\Pedido;
use bagrap\Paquete;
use bagrap\Archivo;
use bagrap\Ginecologo;
use bagrap\Compra;
use bagrap\Coupon;
use bagrap\Direccion;
use bagrap\Opinion;

// use bagrap\Policies\CartPolicy;
use bagrap\Policies\AlbumPolicy;
use bagrap\Policies\PedidoPolicy;
use bagrap\Policies\PaquetePolicy;
use bagrap\Policies\ArchivoPolicy;
use bagrap\Policies\OpenpayPolicy;
use bagrap\Policies\GinecologoPolicy;
use bagrap\Policies\CompraPolicy;
use bagrap\Policies\CouponPolicy;
use bagrap\Policies\DireccionPolicy;
use bagrap\Policies\OpinionPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'bagrap\Model' => 'bagrap\Policies\ModelPolicy',
        Paquete::class => PaquetePolicy::class,
        Archivo::class => ArchivoPolicy::class,
        Album::class   => AlbumPolicy::class,
        Ginecologo::class => GinecologoPolicy::class,
        Pedido::class => PedidoPolicy::class,
        // Cart::class => CartPolicy::class,
        Openpay::class => OpenpayPolicy::class,
        Compra::class => CompraPolicy::class,
        Coupon::class => CouponPolicy::class,
        Direccion::class => DireccionPolicy::class,
        Opinion::class => OpinionPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('inCart', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('addToCart', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('removeItem', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('updateItem', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('destroyCart', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('medidas', function ($user) {
            return $user->role_id == 2 && Cart::count() > 0;
        });

        Gate::define('bases', function ($user) {
            return $user->role_id == 2 && Cart::count() > 0;
        });

        Gate::define('cantidad', function ($user) {
            return $user->role_id == 2 && Cart::count() > 0;
        });

        Gate::define('actualizarCarrito', function ($user) {
            return $user->role_id == 2 && Cart::count() > 0;
        });

        Gate::define('pagoTarjetaView', function ($user) {
            return $user->role_id == 2;
        });
        
        Gate::define('pagoTarjeta', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('processingPayment', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('paymentSuccess', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('paymentRefused', function ($user) {
            return $user->role_id == 2;
        });
        
        Gate::define('pagoDireccionView', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('pagoDireccion', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('pagoTotalView', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('pagoTotal', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('pagoCargarArchivoView', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('pagoCargarArchivo', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('pagoCompletar', function ($user) {
            return $user->role_id == 2;
        });


    }
    
}
