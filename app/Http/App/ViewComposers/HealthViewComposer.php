<?php

namespace App\Http\App\ViewComposers;

use App\Support\MailConfiguration\MailConfiguration;
use Illuminate\View\View;
use Spatie\Mailcoach\Support\HorizonStatus;

class HealthViewComposer
{
    protected HorizonStatus $horizonStatus;

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
