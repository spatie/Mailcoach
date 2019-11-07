<?php

namespace App\Http\App\Controllers\Settings\Account;

use App\Http\App\Requests\UpdateAccountRequest;
use App\Http\App\Resources\UserResource;
use Inertia\Inertia;

class AccountController
{
    public function index()
    {
        return inertia()->render('account.Index', [
            'user' => new UserResource(auth()->user()),
        ]);
    }

    public function update(UpdateAccountRequest $request)
    {
        auth()->user()->update([
            'email' => $request->email,
            'name' => $request->name,
        ]);

        flash()->success('Your account has been updated.');

        return redirect()->action([static::class, 'index']);
    }
}
