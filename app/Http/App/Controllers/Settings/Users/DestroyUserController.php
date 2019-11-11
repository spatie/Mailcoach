<?php

namespace App\Http\App\Controllers\Settings\Users;

use App\Models\User;

class DestroyUserController
{
    public function __invoke(User $user)
    {
        if ($user->id === auth()->user()->id) {
            flash()->error('You cannot delete yourself!');

            return redirect()->action(UsersIndexController::class);
        }

        $user->delete();

        flash()->success('The user has been deleted.');

        return redirect()->action(UsersIndexController::class);
    }
}
