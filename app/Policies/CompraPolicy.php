<?php

namespace bagrap\Policies;

use bagrap\User;
use bagrap\Compra;
use bagrap\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompraPolicy
{
  use HandlesAuthorization;

  public function index(User $user)
  {
    return Auth::check() && $user->role_id == 2 ? true : false;
  }

}
