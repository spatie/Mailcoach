<?php

namespace Tests\Feature\Controllers\Auth;

use App\Http\Auth\Controllers\LoginController;
use App\Http\Auth\Controllers\LogoutController;
use App\Models\User;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    /** @test */
    public function it_can_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $this->assertTrue($this->isAuthenticated());

        $this
            ->post(action(LogoutController::class))
            ->assertRedirect(action([LoginController::class, 'showLoginForm']));
        $this->assertFalse($this->isAuthenticated());
    }
}
