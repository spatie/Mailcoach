<?php

namespace App\Listeners;

use Spatie\Mailcoach\Mailcoach;
use Spatie\Mailcoach\Domain\Settings\Support\MenuItem;

class SetupMailcoach
{
    public function handle(): void
    {
        Mailcoach::addUserMenuItemsBefore(
            MenuItem::make()
                ->label(__mc('Account'))
                ->url(route('account'))
                ->icon('fa-user'),
            MenuItem::make()
                ->label(__mc('Users'))
                ->url(route('users'))
                ->icon('fa-users'),
        );

        Mailcoach::addUserMenuItemsAfter(
            MenuItem::make()
                ->isForm()
                ->label(__mc('Log out'))
                ->url(route('logout'))
                ->icon('fa-power-off text-red-500'),
        );

        Mailcoach::addSettingsMenuItemsBefore(
            MenuItem::make()
                ->label(__mc('Account'))
                ->url(route('account')),
            MenuItem::make()
                ->label(__mc('Users'))
                ->url(route('users')),
        );
    }
}
