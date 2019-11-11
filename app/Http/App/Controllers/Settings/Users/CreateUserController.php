<?php

namespace App\Http\App\Controllers\Settings\Users;

use App\Actions\CreateUserAction;
use App\Http\App\Requests\UpdateUserRequest;
use App\Http\App\Resources\UserResource;
use App\Models\User;

class CreateUserController
{
    public function create()
    {
        return view('app.users.create', [
            'user' => new User(),
        ]);
    }

    public function store(UpdateUserRequest $request, CreateUserAction $createUserAction)
    {
        $createUserAction->execute($request->validated());

        return redirect()->action(UsersIndexController::class);
    }
}
