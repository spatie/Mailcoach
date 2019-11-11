<?php

namespace App\Http\App\Controllers\Settings\Users;

use App\Actions\CreateUserAction;
use App\Http\App\Requests\UpdateUserRequest;
use App\Http\App\Resources\UserResource;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreateUserController
{
    public function create()
    {
        return view('app.users.create', [
            'user' => new User(),
        ]);
    }

    public function store(UpdateUserRequest $request)
    {
        $validatedProperties = $request->validated();

        $user = User::create(array_merge($validatedProperties, ['password' => Str::random(64)]));

        Mail::send(new WelcomeMail($user));

        flash()->success("The user has been created. A mail with login instructions has been sent to {$user->email}");

        return redirect()->action(UsersIndexController::class);
    }
}
