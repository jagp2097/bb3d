<?php

namespace bagrap\Policies;

use bagrap\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
      return Auth::check() && $user->role_id == 1 ? true : false;
    }

    public function create(User $user)
    {
      if (Auth::check() && $user->role_id == 1) return true;
    }

    public function print(User $user)
    {
      if (Auth::check() && $user->role_id == 1) return true;
    }

    public function canjear(User $user)
    {
      if (Auth::check() && $user->role_id == 2) return true;
    }
}
