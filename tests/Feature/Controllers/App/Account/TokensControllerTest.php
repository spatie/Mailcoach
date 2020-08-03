<?php

namespace Tests\Feature\Controllers\App\Account;

use App\Models\User;
use Tests\TestCase;

class TokensControllerTest extends TestCase
{
    /** @test */
    public function it_can_delete_a_personal_access_token()
    {
        $this->authenticate();

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

        $this->authenticate();

        $anotherUser = factory(User::class)->create();

        $anotherUser->createToken('test');

        $this
            ->delete(route('tokens.delete', $anotherUser->personalAccessTokens()->first()))
            ->assertForbidden();
    }
}
