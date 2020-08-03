<?php

namespace App\Policies;

use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalAccessTokenPolicy
{
    use HandlesAuthorization;

    public function administer(User $user, PersonalAccessToken  $personalAccessToken)
    {
        return $user->id === $personalAccessToken->user()->id;
    }
}
