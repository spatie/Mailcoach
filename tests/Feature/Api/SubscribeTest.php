<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Mailcoach\Models\EmailList;
use Tests\TestCase;

class SubscribeTest extends TestCase
{
    use RefreshDatabase;

    /** @var \Spatie\Mailcoach\Models\EmailList */
    private $emailList;

    protected function setUp(): void
    {
        parent::setUp();

        $this->emailList = EmailList::create([
            'name' => 'subscribers',
        ]);
    }

    /** @test * */
    public function it_can_create_a_subscription_from_a_post_request()
    {
        $this->withExceptionHandling();

        $this->post('/api/subscribe', [
            'list_uuid' => (string)$this->emailList->uuid,
            'email' => 'john@example.com',
        ])
            ->assertRedirect('/')
            ->assertSessionHasNoErrors();

        $this->assertEquals(1, $this->emailList->subscribers()->count());
        $this->assertEquals('john@example.com', $this->emailList->subscribers()->first()->email);
    }

    /** @test * */
    public function it_redirects_to_a_specified_url_after_subscribing()
    {
        $this->emailList->update(['redirect_after_subscribed' => '/my/redirect']);

        $this->post('/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
            'email' => 'john@doe.com',
        ])->assertRedirect('/my/redirect');
    }

    /** @test */
    public function it_redirects_to_a_specified_url_after_subscribing_when_pending()
    {
        $this->emailList->update([
            'redirect_after_pending' => '/my/redirect',
            'requires_double_opt_in' => true,
        ]);

        $this->post('/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
            'email' => 'john@doe.com',
        ])->assertRedirect('/my/redirect');
    }

    /** @test * */
    public function it_redirects_to_a_specified_url_after_subscribing_when_already_subscribed()
    {
        $this->emailList->update([
            'redirect_after_already_subscribed' => '/my/redirect',
        ]);

        $this->emailList->subscribe('john@doe.com');

        $this->post('/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
            'email' => 'john@doe.com',
        ])->assertRedirect('/my/redirect');
    }

    /** @test * */
    public function it_returns_json_when_the_request_wants_json()
    {
        $this->json('POST', '/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
            'email' => 'john@doe.com',
            'redirect' => 'https://example.com',
        ])->assertSuccessful()->assertStatus(201)->assertSee('subscribed');
    }

    /** @test * */
    public function it_returns_json_when_the_request_wants_json_when_pending()
    {
        $this->emailList->update(['requires_double_opt_in' => true]);

        $this->json('POST', '/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
            'email' => 'john@doe.com',
            'redirect' => 'https://example.com',
        ])->assertSuccessful()->assertStatus(201)->assertSee('pending');
    }

    /** @test * */
    public function it_can_accept_a_first_and_last_name()
    {
        $this->post('/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
            'email' => 'john@doe.com',
            'extra_attributes' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
            ],
        ])->assertRedirect()->assertSessionHasNoErrors();

        $this->assertEquals('John', $this->emailList->subscribers()->first()->first_name);
        $this->assertEquals('Doe', $this->emailList->subscribers()->first()->last_name);
    }

    /** @test * */
    public function it_requires_an_email()
    {
        $this->withExceptionHandling();

        $this->post('/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
        ])->assertSessionHasErrors('email');
    }

    /** @test * */
    public function it_requires_a_valid_email()
    {
        $this->withExceptionHandling();

        $this->post('/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
            'email' => 'not-valid',
        ])->assertSessionHasErrors('email');
    }

    /** @test * */
    public function it_returns_an_error_if_the_subscriber_is_already_added()
    {
        $this->withExceptionHandling();

        $this->emailList->subscribe('john@doe.com');

        $this->post('/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
            'email' => 'john@doe.com',
        ])->assertSessionHasErrors('email');

        $response = $this->json('POST', '/api/subscribe', [
            'list_uuid' => $this->emailList->uuid,
            'email' => 'john@doe.com',
        ]);
        $response->assertStatus(400);
        $this->assertEquals(__('email-campaigns::messages.email_list_email', [
            'attribute' => 'email',
        ]), $response->json());
    }

    /** @test * */
    public function it_requires_a_list_uuid()
    {
        $this->withExceptionHandling();

        $this->post('/api/subscribe', [
            'list_uuid' => '',
            'email' => 'john@doe.com',
        ])->assertSessionHasErrors('list_uuid');
    }

    /** @test * */
    public function it_requires_an_existing_list_uuid()
    {
        $this->withExceptionHandling();

        $this->post('/api/subscribe', [
            'list_uuid' => 10,
            'email' => 'john@doe.com',
        ])->assertSessionHasErrors('list_uuid');
    }
}
