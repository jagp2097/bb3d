<?php

namespace bagrap\Policies;

use bagrap\User;
use bagrap\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PedidoPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        if (Auth::check()) return $user->role_id == 1;
    }

    public function view(User $user, Pedido $pedido)
    {
        if (Auth::check() && $user->role_id == 1) return true;
    }

    public function update(User $user)
    {
        if (Auth::check()) return $user->role_id == 1;
    }

    public function misPedidos(User $user)
    {
        if (Auth::check()) return $user->role_id == 2;
    }

    public function verPedido(User $user, Pedido $pedido)
    {
        if (Auth::check()) return $user->id == $pedido->user_id;
    }

    public function refundForm(User $user)
    {
        if (Auth::check()) return $user->role_id == 1;
    }

}
