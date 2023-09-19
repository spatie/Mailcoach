<?php

namespace App\Console;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class MakeUserCommand extends Command
{
    protected $signature = 'mailcoach:make-user {--username=} {--email=} {--password=}';

    protected $description = 'Create a user with credentials.';

    public function handle()
    {
        $username = $this->option('username');
        $email = $this->option('email');
        $password = $this->option('password');

        if (! $username) {
            $username = $this->ask("What is the user's name?");
        }

        if (! $email) {
            $email = $this->ask('What is the email address?');
        }

        if (! $password) {
            $password = $this->secret('What is the password?');
        }

        $validator = Validator::make([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ], [
            'username' => ['required'],
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            $this->info('User not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        User::create([
            'name' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'email_verified_at' => now(),
        ]);

        $this->info("User {$username} created!");

        return self::SUCCESS;
    }
}
