<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        // 1) Pick a start between tomorrow and next month
        $start = $this->faker->dateTimeBetween('+1 days', '+1 month');

        // 2) End two hours after start
        $end = (clone $start)->modify('+2 hours');

        // 3) Appearance any time between 1 day before start up until the start
        $appearance = $this->faker->dateTimeBetween('-1 days', $start);

        // 4) Takedown is exactly two days after end
        $takedown = (clone $end)->modify('+2 days');

        return [
            'user_id'             => 1, // or: User::factory()
            'name'                => $this->faker->sentence(3),
            'description'         => $this->faker->paragraph,
            'event_type'          => $this->faker->randomElement(['concert','theatre','seminar']),
            'event_sub_type'      => $this->faker->word,
            'start_datetime'      => $start,
            'end_datetime'        => $end,
            'appearance_datetime' => $appearance,
            'takedown_datetime'   => $takedown,
            'location_address'    => $this->faker->address,
            'website_url'         => $this->faker->url,
            'is_free'             => $this->faker->boolean(50),
            'price'               => $this->faker->optional()->randomFloat(2, 5, 100),
            'visibility'          => $this->faker->randomElement(['public','private']),
            'invitees'            => null,
            'age_restricted'      => $this->faker->boolean(20),
            'accessibility_info'  => null,
            'tags'                => null,
            'status'              => 'V',
            'image_path'          => null,
            'recurrence_rule'     => null,
            // add other fields if you’ve added them to fillable...
        ];
    }
}
