<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;
use Livewire\Component;

class AccountComponent extends Component
{
    public string $email;

    public string $name;

    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $tokenName = '';

    public string $newToken = '';

    public function mount()
    {
        $this->email = Auth::user()->email;
        $this->name = Auth::user()->name;
    }

    public function save()
    {
        $this->validate([
            'email' => ['required', 'email:rfc,dns', Rule::unique('users')->ignore(Auth::user()->id)],
            'name' => ['required'],
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        notify(__mc('Your account has been updated.'));
    }

    public function savePassword()
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->save();

        notify(__mc('Your password has been updated.'));

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function saveToken()
    {
        $this->validate(['tokenName' => ['required']]);

        /** @var \Laravel\Sanctum\NewAccessToken $token */
        $token = Auth::user()?->createToken($this->tokenName);

        $this->newToken = $token->plainTextToken;

        notify(__mc('The token has been created.'));

        $this->tokenName = '';
    }

    public function deleteToken(PersonalAccessToken $token)
    {
        abort_unless($token?->tokenable_id === Auth::id(), 403);

        $token->delete();

        notify(__mc('The token has been deleted.'));
    }

    public function render()
    {
        return view('livewire.account', [
            'tokens' => Auth::user()->tokens ?? [],
        ])->layout('mailcoach::app.layouts.settings', ['title' => __mc('Account')]);
    }
}
