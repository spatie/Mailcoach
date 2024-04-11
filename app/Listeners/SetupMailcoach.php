<?php

namespace App\Listeners;

use Spatie\Mailcoach\Domain\Settings\Support\MenuItem;
use Spatie\Mailcoach\Domain\Shared\Events\ServingMailcoach;
use Spatie\Mailcoach\Mailcoach;

class SetupMailcoach
{
    public function handle(ServingMailcoach $event): void
    {
        Mailcoach::addUserMenuItemsBefore(
            MenuItem::make()
                ->label(__mc('Account'))
                ->url(route('account'))
                ->icon('heroicon-s-user'),
            MenuItem::make()
                ->label(__mc('Users'))
                ->url(route('users'))
                ->icon('heroicon-s-user-group'),
        );

        Mailcoach::addUserMenuItemsAfter(
            MenuItem::make()->divider(),
            MenuItem::make()
                ->label(__mc('Documentation'))
                ->icon('heroicon-s-academic-cap')
                ->external()
                ->url('https://mailcoach.app/self-hosted/documentation'),
            MenuItem::make()->divider(),
            MenuItem::make()
                ->isForm()
                ->label(__mc('Log out'))
                ->url(route('logout'))
                ->icon('heroicon-s-arrow-right-start-on-rectangle'),
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
