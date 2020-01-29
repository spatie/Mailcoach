<?php

namespace Tests\Feature\Commands;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MakeUserCommandTest extends TestCase
{
    /** @test * */
    public function it_can_create_a_user()
    {
        $this->artisan('make:user')
            ->expectsQuestion('What is the username?', 'John')
            ->expectsQuestion('What is the email address?', 'admin@mailcoach.app')
            ->expectsQuestion('What is the password?', 'secret')
            ->expectsOutput('User John created!')
            ->assertExitCode(0);

        $this->assertEquals(1, User::count());
        tap(User::first(), function (User $user) {
            $this->assertEquals('John', $user->name);
            $this->assertEquals('admin@mailcoach.app', $user->email);
            $this->assertTrue(Hash::check('secret', $user->password));
        });
    }

    /** @test * */
    public function it_can_create_a_user_with_options()
    {
        $this->artisan('make:user --username=John --email=admin@mailcoach.app --password=secret')
            ->expectsOutput('User John created!')
            ->assertExitCode(0);

        $this->assertEquals(1, User::count());
        tap(User::first(), function (User $user) {
            $this->assertEquals('John', $user->name);
            $this->assertEquals('admin@mailcoach.app', $user->email);
            $this->assertTrue(Hash::check('secret', $user->password));
        });
    }
}
