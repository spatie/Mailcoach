<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this
            ->call(TemplateSeeder::class)
            ->call(EmailListSeeder::class)
            // ->call(CampaignSeeder::class)
            ->call(UserSeeder::class)
        ;
    }
}
