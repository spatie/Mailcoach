<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string */
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function build()
    {
        return $this
            ->subject('Mailcoach testmail')
            ->to($this->email)
            ->from($this->email)
            ->view('mails.test');
    }
}
