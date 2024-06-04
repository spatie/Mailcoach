<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\WelcomeNotification\WelcomeNotification;

class CreateUserComponent extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public string $email = '';

    public string $name = '';

    public function saveUser()
    {
        $validated = $this->validate([
            'email' => ['required', 'email:rfc', Rule::unique('users', 'email')],
            'name' => 'required|string',
        ]);

        /** @var User $user */
        $user = User::make();
        $user->email = $validated['email'];
        $user->name = $validated['name'];
        $user->password = Hash::make(Str::random(64));
        $user->save();

        try {
            $user->sendWelcomeNotification(now()->addDay());

            notify(__mc('The user has been created. A mail with login instructions has been sent to :email', ['email' => $user->email]));

        } catch (\Throwable $e) {
            report($e);
            notifyError(__mc('The user has been created. A mail with setup instructions could not be sent: '.$e->getMessage()));
        }

        return redirect()->route('users.edit', $user);
    }

    public function render()
    {
        return view('livewire.users.create');
    }
}
