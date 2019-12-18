<?php

namespace App\Http\App\Controllers\Settings\Users;

use App\Http\App\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;

class CreateUserController
{
    public function __invoke(UpdateUserRequest $request)
    {
        $validatedProperties = $request->validated();

        $user = User::create(array_merge($validatedProperties, ['password' => Str::random(64)]));

        $expiresAt = now()->addDay();

        try {
            $user->sendWelcomeNotification($expiresAt);

            flash()->success("The user has been created. A mail with login instructions has been sent to {$user->email}");
        } catch (Exception $exception) {
            report($exception);
            flash()->warning("The user has been created. A mail with setup instructions could not be sent.");
        }

        return redirect()->action(UsersIndexController::class);
    }
}
