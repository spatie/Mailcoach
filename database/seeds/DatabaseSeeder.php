<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factory;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this
            ->call(UserSeeder::class)
            ->call(TemplateSeeder::class)
            ->call(EmailListSeeder::class);
    }
}
