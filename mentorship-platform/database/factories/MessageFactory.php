<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        $request = MentorshipRequest::inRandomOrder()->first();
        $fromUser = $this->faker->randomElement([$request->startup, $request->mentor]);
        $toUser = $fromUser->id === $request->startup_id ? $request->mentor : $request->startup;

        return [
            'from_user_id' => $fromUser->id,
            'to_user_id' => $toUser->id,
            'mentorship_request_id' => $request->id,
            'body' => $this->faker->paragraph(2),
            'read_at' => $this->faker->optional(70)->dateTimeBetween('-1 day', 'now'),
        ];
    }
} 