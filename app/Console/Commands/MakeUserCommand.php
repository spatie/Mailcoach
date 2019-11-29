<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserCommand extends Command
{
    protected $signature = 'make:user {--username=} {--email=} {--password=}';

    protected $description = 'Create a user with credentials.';

    public function handle()
    {
        $username = $this->option('username');
        $email = $this->option('email');
        $password = $this->option('password');

        if (! $username) {
            $username = $this->ask("What is the username?");
        }

        if (! $email) {
            $email = $this->ask("What is the email address?");
        }

        if (! $password) {
            $password = $this->secret("What is the password?");
        }

        User::create([
            'name' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'email_verified_at' => now(),
        ]);

        $this->info("User {$username} created!");
    }
}
