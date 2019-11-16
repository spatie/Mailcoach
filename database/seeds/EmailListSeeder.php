<?php

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Models\EmailList;

class EmailListSeeder extends Seeder
{
    public function run()
    {
        factory(EmailList::class, 5)
            ->create()
            ->each(function (EmailList $emailList) {
                foreach (range(1, faker()->numberBetween(1, 100)) as $i) {
                    $email = faker()->email;
                    $emailList->subscribeNow($email);

                    if (faker()->boolean(5)) {
                        $emailList->unsubscribe($email);
                    }
                }
            });
    }
}
