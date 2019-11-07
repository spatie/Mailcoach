<?php

namespace App\Support;

use App\Models\EmailList;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\EmailCampaigns\Enums\SubscriptionStatus;

class ImportSubscriberRow
{
    /** @var \App\Models\EmailList */
    private $emailList;

    private $values = [];

    public function __construct(EmailList $emailList, array $values)
    {
        $this->emailList = $emailList;

        $this->values = $values;
    }

    public function hasValidEmail(): bool
    {
        $validator = Validator::make($this->values, ['email' => 'required|email']);

        return !$validator->fails();
    }

    public function hasUnsubscribed(): bool
    {
        $subscriptionStatus = $this->emailList->getSubscriptionStatus($this->values['email']);

        return $subscriptionStatus === SubscriptionStatus::UNSUBSCRIBED;
    }

    public function getAllValues(): array
    {
        return $this->values;
    }

    public function getEmail(): string
    {
        return $this->values['email'] ?? '';
    }

    public function getAttributes(): array
    {
        return [
            'first_name' => $this->values['first_name'] ?? '',
            'last_name' => $this->values['last_name'] ?? '',
        ];
    }

    public function getExtraAttributes(): array
    {
        return collect($this->values)
            ->reject(function ($value, string $key) {
                return in_array($key, ['email', 'first_name', 'last_name']);
            })
            ->map(function ($value, string $key) {
                return [$key, $value];
            })
            ->reduce(function (array $result, $keyValuePair) {
                [$key, $value] = $keyValuePair;

                $key = Str::replaceFirst('extra_attributes.', '', $key);

                $result[$key] = $value;

                return $result;
            }, []);
    }
}
