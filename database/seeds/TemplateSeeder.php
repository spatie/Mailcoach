<?php

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Models\Template;

class TemplateSeeder extends Seeder
{
    public function run()
    {
        factory(Template::class)->create([
            'name' => 'simple',
            'html' => 'dummy content',
        ]);
    }
}
