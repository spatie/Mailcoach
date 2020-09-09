<?php

namespace Database\Seeders;

use Database\Factories\TemplateFactory;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    public function run()
    {
        TemplateFactory::new()->create([
            'name' => 'simple',
            'html' => 'dummy content',
        ]);
    }
}
