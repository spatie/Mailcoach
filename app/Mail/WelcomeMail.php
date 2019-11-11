<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;

class WelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var \App\Models\User */
    public $user;

    /** @var string */
    public $token;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->token = Password::getRepository()->create($user);
    }

    public function build()
    {
        return $this
            ->to($this->user->email)
            ->subject('Welcome to ' . config('app.name'))
            ->view('mails.welcome');
    }
}
