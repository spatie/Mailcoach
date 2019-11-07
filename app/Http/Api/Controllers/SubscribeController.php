<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\CreateSubscriptionRequest;
use App\Models\EmailList;
use Spatie\MailCoach\Enums\SubscriptionStatus;
use Spatie\MailCoach\Models\Subscription;
use Symfony\Component\HttpFoundation\Response;

class SubscribeController
{
    public function __invoke(CreateSubscriptionRequest $request)
    {
        $emailList = EmailList::findByUuid($request->list_uuid);

        if ($response = $this->ensureEmailIsNotSubscribed($request->email, $emailList)) {
            return $response;
        }

        $subscription = $emailList->subscribe($request->email, $request->extra_attributes ?? []);

        return $this->redirectAfterSubscribing($emailList, $subscription);
    }

    private function ensureEmailIsNotSubscribed(string $email, EmailList $list): ?Response
    {
        if ($list->getSubscriptionStatus($email) !== SubscriptionStatus::SUBSCRIBED) {
            return null;
        }

        $message = __('email-campaigns::messages.email_list_email', [
            'attribute' => 'email',
        ]);

        if (request()->wantsJson()) {
            return response()->json($message, 400);
        }

        if ($list->redirect_after_already_subscribed) {
            return redirect($list->redirect_after_already_subscribed);
        }

        return back()->withErrors(['email' => $message]);
    }

    private function redirectAfterSubscribing(EmailList $emailList, Subscription $subscription): Response
    {
        if (request()->wantsJson()) {
            return response()->json($subscription->status, 201);
        }

        if ($emailList->redirect_after_pending && $subscription->status === SubscriptionStatus::PENDING) {
            return redirect($emailList->redirect_after_pending);
        }

        if ($emailList->redirect_after_subscribed && $subscription->status === SubscriptionStatus::SUBSCRIBED) {
            return redirect($emailList->redirect_after_subscribed);
        }

        return back()->with('status', $subscription->status);
    }
}
