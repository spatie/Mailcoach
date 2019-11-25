<?php

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Models\Template;

class TemplateSeeder extends Seeder
{
    public function run()
    {
        factory(Template::class, 1)->create([
            'html' => '<html><body><a href="https://spatie.be">Spatie</a><br /><a href="https://flare.io">Flare</a></body></html>'
        ]);
    }
}
