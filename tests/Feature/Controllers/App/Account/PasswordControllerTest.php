<?php

namespace Tests\Feature\Controllers\App\Account;

use App\Http\App\Controllers\Settings\Account\PasswordController;
use App\Models\User;
use Tests\TestCase;

class PasswordControllerTest extends TestCase
{
    /** @test */
    public function it_can_change_the_password_of_the_authenticated_user()
    {
        $currentPassword = 'current-password';
        $newPassword = 'my-new-password';

        $user = factory(User::class)->create([
            'password' => bcrypt($currentPassword),
        ]);

        $this->actingAs($user);

        $this
            ->put(action([PasswordController::class, 'update']), [
                'current_password' => $currentPassword,
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(action([PasswordController::class, 'index']));

        $this->assertTrue(auth()->validate([
            'email' => auth()->user()->email,
            'password' => $newPassword,
        ]));
    }

    /** @test */
    public function it_will_fail_if_the_current_password_is_not_correct()
    {
        $newPassword = 'my-new-password';

        $this->authenticate();

        $this->withExceptionHandling();

        $this
            ->put(action([PasswordController::class, 'update']), [
                'current_password' => 'wrong-current-password',
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
            ])
            ->assertSessionHasErrors('current_password');
    }
}
