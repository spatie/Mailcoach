<?php

namespace Tests\Feature\Controllers\Auth;

use App\Http\Auth\Controllers\ForgotPasswordController;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    /** @var \App\Models\User  */
    private $user;

    /** @var string */
    private $resetUrl;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'email' => 'john@example.com',
            'password' => bcrypt('my-password'),
        ]);

        $this->resetUrl = action([ForgotPasswordController::class, 'sendResetLinkEmail']);

        Notification::fake();
    }

    /** @test */
    public function it_can_send_a_reset_password_notification()
    {
        $this
            ->post($this->resetUrl, ['email' => 'john@example.com'])
            ->assertRedirect();

        Notification::assertSentTo($this->user, ResetPassword::class);
    }

    /** @test */
    public function it_will_not_send_a_password_reset_notification_when_given_a_wrong_email_address()
    {
        $this
            ->post($this->resetUrl, ['email' => 'non-existing@example.com'])
            ->assertRedirect();

        Notification::assertNotSentTo($this->user, ResetPassword::class);
    }
}
