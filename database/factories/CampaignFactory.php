<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator;
use Illuminate\Support\Str;
use Spatie\Mailcoach\Enums\CampaignStatus;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\EmailList;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'name' => $this->faker->word,
        'subject' => $this->faker->sentence,
        'html' => $this->faker->randomHtml(),
        'track_opens' => $this->faker->boolean,
        'track_clicks' => $this->faker->boolean,
        'status' => CampaignStatus::DRAFT,
        'uuid' => $this->faker->uuid,
        'last_modified_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
        'email_list_id' => function () {
            return EmailList::factory()->create(['uuid' => (string)Str::uuid()]);
        }
    ];
    }
}
