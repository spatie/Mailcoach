<?php

namespace App\Livewire;

use App\Models\User;
use Closure;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Mailcoach\Livewire\TableComponent;

class UsersComponent extends TableComponent
{
    public function getTitle(): string
    {
        return __mc('Users');
    }

    public function getLayout(): string
    {
        return 'mailcoach::app.layouts.settings';
    }

    public function getLayoutData(): array
    {
        return [
            'title' => __mc('Users'),
            'create' => 'user',
            'createText' => 'Create user',
            'createComponent' => CreateUserComponent::class,
        ];
    }

    public function deleteUser(User $user)
    {
        if ($user->id === Auth::user()->id) {
            $this->flashError(__mc('You cannot delete yourself!'));

            return;
        }

        $user->delete();

        notify(__mc('The user has been deleted.'));
    }

    protected function getTableQuery(): Builder
    {
        return User::query();
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'email';
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('email')
                ->label(__mc('Email'))
                ->extraAttributes(['class' => 'link'])
                ->sortable()
                ->searchable(),
            TextColumn::make('name')
                ->label(__mc('Name'))
                ->sortable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('delete')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->label('')
                ->tooltip(__mc('Delete'))
                ->modalHeading(__mc('Delete'))
                ->requiresConfirmation()
                ->hidden(fn (User $user) => $user->id === Auth::user()->id)
                ->action(fn (User $user) => $this->deleteUser($user)),
        ];
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn (User $user) => route('users.edit', $user);
    }
}
