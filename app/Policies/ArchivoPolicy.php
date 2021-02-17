<?php

namespace bagrap\Policies;

use bagrap\User;
use bagrap\Album;
use bagrap\Archivo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArchivoPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
      if (Auth::check() && $user->role_id == 2) return true;
    }

    public function create(User $user)
    {
      if (Auth::check() && $user->role_id == 1 || $user->role_id == 2) return true;
    }

    public function update(User $user, Archivo $archivo)
    {
      if (Auth::check() && $user->role_id == 2) return $user->id == $archivo->user_id;

      if (Auth::check() && $user->role_id == 1) return true;

    }

    public function show(User $user, Archivo $archivo)
    {
      if (Auth::check() && $user->role_id == 2) return $user->id == $archivo->user_id;

      if (Auth::check() && $user->role_id == 1) return true;
    }

    public function download(User $user, Archivo $archivo)
    {
      if (Auth::check() && $user->role_id == 2) return $user->id == $archivo->user_id;

      if (Auth::check() && $user->role_id == 1) return true;
    }

    public function delete(User $user, Archivo $archivo)
    {
      if (Auth::check() && $user->role_id == 2) return $user->id == $archivo->user_id;

      if (Auth::check() && $user->role_id == 1) return true;
    }

}
