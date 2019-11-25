<?php

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\Subscriber;

class EmailListSeeder extends Seeder
{
    public function run()
    {
        factory(EmailList::class, 1)
            ->create()
            ->each(function (EmailList $emailList) {
                foreach (range(1, faker()->numberBetween(1, 100)) as $i) {
                    $email = faker()->email;
                    $emailList->subscribeSkippingDoubleOptIn($email);

                    if (faker()->boolean(5)) {
                        $emailList->unsubscribe($email);
                    }
                }
            });

        $emailList = EmailList::create([
            'name' => 'freek.dev newsletter #1',
            'default_from_email' => 'freek@spatie.be',
            'default_from_name' => 'Freek Van der Herten',
        ]);

        Subscriber::createWithEmail('freek@spatie.be')->subscribeTo($emailList);
    }
}
