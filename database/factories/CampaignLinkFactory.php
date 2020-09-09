<?php

namespace Spatie\Mailcoach\Tests\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\CampaignLink;

class CampaignLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CampaignLink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'campaign_id' => Campaign::factory(),
        'url' => $this->faker->url,
    ];
    }
}
