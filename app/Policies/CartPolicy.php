<?php

namespace bagrap\Policies;

use Cart;
use bagrap\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function inCart(User $user)
    {
      if (Auth::check() && $user->openpay_id != null) return $user->role_id == 2;
    }

    public function addToCart(User $user)
    {
      if (Auth::check() && $user->openpay_id != null) return $user->role_id == 2;
    }

    public function removeItem(User $user)
    {
      if (Auth::check() && $user->openpay_id != null) return $user->role_id == 2;
    }

    public function updateItem(User $user)
    {
      if (Auth::check() && $user->openpay_id != null) return $user->role_id == 2;
    }
    
}
