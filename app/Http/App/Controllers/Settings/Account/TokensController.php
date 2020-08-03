<?php

namespace App\Http\App\Controllers\Settings\Account;

use App\Http\App\Requests\UpdatePasswordRequest;
use App\Models\PersonalAccessToken;

class TokensController
{
    public function index()
    {
        return view('app.settings.account.tokens', [
            'tokens' => auth()->user()->tokens,
        ]);
    }

    public function update(UpdatePasswordRequest $request)
    {
        auth()->user()->update(['password' => bcrypt($request->password)]);

        flash()->success(__('Your password has been updated.'));

        return redirect()->action([static::class, 'index']);
    }

    public function destroy(PersonalAccessToken $personalAccessToken)
    {
        $personalAccessToken->delete();

        flash()->success(__('The token has been deleted.'));

        return redirect()->route('tokens');
    }
}
