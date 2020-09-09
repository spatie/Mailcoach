<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator;
use Spatie\Mailcoach\Enums\SubscriberImportStatus;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\SubscriberImport;

class SubscriberImportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriberImport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'status' => SubscriberImportStatus::COMPLETED,
        'email_list_id' => EmailList::factory(),
        'imported_subscribers_count' => $this->faker->numberBetween(1, 1000),
        'error_count' => $this->faker->numberBetween(1, 5),
    ];
    }
}
