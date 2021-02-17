<?php

namespace bagrap\Policies;

use bagrap\User;
use bagrap\Opinion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class OpinionPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        if (Auth::check()) return $user->role_id == 1;
    }

}
