<?php

namespace bagrap\Policies;

use bagrap\User;
use Openpay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class OpenpayPolicy
{
    use HandlesAuthorization;

    public function checkout(User $user)
    {
      if (Auth::check() && $user->openpay_id != null && $user->role_id == 2) return true;
    }

    public function getCardsClient(User $user)
    {
      if (Auth::check() && $user->openpay_id != null) return true;
    }

    public function addCardForm(User $user)
    {
      if (Auth::check() && $user->openpay_id != null && $user->role_id == 2) return true;
    }

    public function addCardClient(User $user)
    {
      if (Auth::check()) return $user->role_id == 2;
    }

    public function deleteCardClient(User $user)
    {
      if (Auth::check() && $user->openpay_id != null) return $user->role_id == 2;
    }

    public function refund(User $user)
    {
      if (Auth::check() && $user->role_id == 1) return true;
    }

}
