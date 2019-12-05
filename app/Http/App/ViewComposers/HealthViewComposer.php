<?php

namespace App\Http\App\ViewComposers;

use Spatie\Mailcoach\Support\HorizonStatus;
use App\Support\MailConfiguration\MailConfiguration;
use Illuminate\View\View;

class HealthViewComposer
{
    /** @var \Spatie\Mailcoach\Support\HorizonStatus */
    protected HorizonStatus $horizonStatus;

    /** @var \App\Support\MailConfiguration\MailConfiguration */
    protected MailConfiguration $mailConfiguration;

    public function __construct(HorizonStatus $horizonStatus, MailConfiguration $mailConfiguration)
    {
        $this->horizonStatus = $horizonStatus;

        $this->mailConfiguration = $mailConfiguration;
    }

    public function compose(View $view)
    {
        $view->with([
            'horizonActive' => $this->horizonStatus->is(HorizonStatus::STATUS_ACTIVE),
            'mailConfigurationValid' => $this->mailConfiguration->isValid(),
        ]);
    }
}
