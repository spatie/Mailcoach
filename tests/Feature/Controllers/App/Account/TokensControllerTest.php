<?php

namespace Tests\Feature\Controllers\App\Account;

use App\Models\User;
use Tests\TestCase;

class TokensControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->authenticate();
    }

    /** @test */
    public function it_can_delete_a_personal_access_token()
    {
        $token = auth()->user()->personalAccessTokens()->first();

        $this
            ->delete(route('tokens.delete', $token->id))
            ->assertRedirect(route('tokens'));

        $this->assertDatabaseMissing('personal_access_tokens', [
            'id' => $token->id
        ]);
    }

    /** @test */
    public function it_will_not_delete_a_personal_access_token_belonging_to_another_user()
    {
        $this->withExceptionHandling();

        $anotherUser = factory(User::class)->create();

        $anotherUser->createToken('test');

        $this
            ->delete(route('tokens.delete', $anotherUser->personalAccessTokens()->first()))
            ->assertForbidden();
    }
}
