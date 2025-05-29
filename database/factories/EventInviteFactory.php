<?php

namespace Database\Factories;

use App\Models\EventInvite;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventInviteFactory extends Factory
{
    protected $model = EventInvite::class;

    public function definition()
    {
        return [
            // either point at an existing event or create one on the fly:
            'event_id'    => Event::factory(),
            'email'       => $this->faker->safeEmail(),
            'token'       => Str::uuid(),
            'sent_at'     => now(),
            'accepted_at' => null,
        ];
    }
}
