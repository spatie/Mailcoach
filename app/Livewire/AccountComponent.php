<?php

namespace App\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AccountComponent extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

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

    public function deleteTokenAction(): Action
    {
        return Action::make('deleteToken')
            ->requiresConfirmation()
            ->icon('heroicon-s-trash')
            ->color('danger')
            ->link()
            ->label('')
            ->tooltip(__mc('Delete token'))
            ->modalIcon('heroicon-s-trash')
            ->modalHeading(__mc('Delete token'))
            ->modalDescription(__mc('Are you sure you want to delete this token?'))
            ->modalCloseButton(false)
            ->action(function (array $arguments) {
                $token = Auth::user()->personalAccessTokens->find($arguments['token']);

                abort_unless($token, 404);

                $token->delete();

                notify(__mc('The token has been deleted.'));
            });
    }

    public function render()
    {
        return view('livewire.account', [
            'tokens' => Auth::user()->tokens ?? [],
        ])->layout('mailcoach::app.layouts.settings', ['title' => __mc('Account')]);
    }
}
