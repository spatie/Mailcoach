<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionalTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $theme = 'mailcoach::mails.layout.mailcoach';

    private string $fromEmail;
    private string $toEmail;

    public function __construct(string $fromEmail, string $toEmail)
    {
        $this->fromEmail = $fromEmail;
        $this->toEmail = $toEmail;
    }

    public function build()
    {
        return $this
            ->subject(__('Mailcoach transactional testmail'))
            ->to($this->toEmail)
            ->from($this->fromEmail)
            ->markdown('mails.test');
    }
}
