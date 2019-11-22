<?php

namespace App\Http\App\Controllers\Settings\Users;

use App\Http\App\Requests\UpdateUserRequest;
use App\Http\App\Resources\UserResource;
use App\Models\User;

class UpdateUserController
{
    public function edit(User $user)
    {
        return view('app.settings.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user, UpdateUserRequest $updateUserRequest)
    {
        $user->update($updateUserRequest->validated());

        flash()->success('The user has been updated.');

        return redirect()->action(UsersIndexController::class);
    }
}
