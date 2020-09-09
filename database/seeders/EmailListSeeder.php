<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\Subscriber;

class EmailListSeeder extends Seeder
{
    public function run()
    {
        $emailList = EmailList::create([
            'name' => 'test list',
            'default_from_email' => 'freek@spatie.be',
            'default_from_name' => 'Freek Van der Herten',
        ]);

        foreach (range(1, 10) as $i) {
            Subscriber::createWithEmail("test{$i}@example.com")->subscribeTo($emailList);
        }

        Subscriber::first()->update(['subscribed_at' => null]);
    }
}
