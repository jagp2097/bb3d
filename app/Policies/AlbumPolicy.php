<?php

namespace bagrap\Policies;

use bagrap\User;
use bagrap\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      if (Auth::check() && $user->role_id == 2) return true;

      if (Auth::check() && $user->role_id == 1) return true;
    }

    public function update(User $user, Album $album)
    {
      if (Auth::check() && $user->role_id == 2) return $user->id == $album->user_id;
    }

    public function show(User $user, Album $album)
    {
      if (Auth::check() && $user->role_id == 2) return $user->id == $album->user_id;

      // if (Auth::check() && $user->role_id == 1) return true;
    }

    public function delete(User $user, Album $album)
    {
      if (Auth::check() && $user->role_id == 2) return $user->id == $album->user_id;
    }

}
