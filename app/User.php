<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Mailcoach\Domain\Settings\Models\MailcoachUser;
use Spatie\Mailcoach\Domain\Shared\Traits\UsesMailcoachModels;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;

class User extends \Illuminate\Foundation\Auth\User implements MailcoachUser
{
    use HasApiTokens;
    use Notifiable;
    use ReceivesWelcomeNotification;
    use UsesMailcoachModels;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function personalAccessTokens(): MorphMany
    {
        return $this->morphMany(self::getPersonalAccessTokenClass(), 'tokenable');
    }

    public function canViewMailcoach(): bool
    {
        return true;
    }
}
