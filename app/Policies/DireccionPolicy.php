<?php

namespace bagrap\Policies;

use bagrap\User;
use bagrap\Direccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class DireccionPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
      if (Auth::check()) return $user->role_id == 2;
    }

    public function create(User $user)
    {
      if (Auth::check()) return $user->role_id == 2;
    }

    public function update(User $user)
    {
      if (Auth::check()) return $user->role_id == 2;
    }

    public function delete(User $user)
    {
      if (Auth::check()) return $user->role_id == 2;
    }
}
