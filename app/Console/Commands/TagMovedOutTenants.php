<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Mailcoach\Domain\Audience\Models\Subscriber;

class TagMovedOutTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tag-moved-out-tenants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will add ex-tenant tag to tenants who have moved out';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Subscriber::query()
            ->withExtraAttributes('move_out_date', '!=', null)
            ->withExtraAttributes('move_out_date', '<', now()->toDateString())
            ->cursor()
            ->each(fn (Subscriber $subscriber) => $subscriber->addTag('ex-tenant'));
    }
}
