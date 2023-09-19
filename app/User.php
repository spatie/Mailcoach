<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Mailcoach\Domain\Settings\Models\MailcoachUser;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;

class User extends \Illuminate\Foundation\Auth\User implements MailcoachUser
{
    use HasApiTokens;
    use Notifiable;
    use ReceivesWelcomeNotification;

    public function canViewMailcoach(): bool
    {
        return true;
    }
}
