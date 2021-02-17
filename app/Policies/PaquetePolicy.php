<?php

namespace bagrap\Policies;

use bagrap\User;
use bagrap\Paquete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaquetePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      if (Auth::check()) return $user->role_id == 1;
    }

    public function update(User $user)
    {
      if (Auth::check()) return $user->role_id == 1;
    }

    public function show(User $user)
    {
      if (Auth::check() && $user->role_id == 1 || $user->role_id == 2) return true;
    }

    public function delete(User $user)
    {
      if (Auth::check()) return $user->role_id == 1;
    }

}
