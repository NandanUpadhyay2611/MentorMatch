<?php

namespace Database\Factories;

use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MentorshipRequestFactory extends Factory
{
    protected $model = MentorshipRequest::class;

    public function definition(): array
    {
        $startup = User::where('role', 'startup')->inRandomOrder()->first();
        $mentor = User::where('role', 'mentor')->inRandomOrder()->first();
        $status = $this->faker->randomElement(['pending', 'accepted', 'rejected']);
        $proposedTime = $this->faker->dateTimeBetween('+1 day', '+30 days');
        $confirmedTime = $status === 'accepted' ? $proposedTime : null;

        return [
            'startup_id' => $startup->id,
            'mentor_id' => $mentor->id,
            'topic' => $this->faker->randomElement([
                'Product Development Strategy',
                'Marketing and Growth',
                'Technical Architecture',
                'Business Model Validation',
                'Fundraising Strategy',
                'Team Building',
                'User Acquisition',
                'Product-Market Fit',
                'Scaling Operations',
                'Competitive Analysis'
            ]),
            'message' => $this->faker->paragraph(3),
            'status' => $status,
            'proposed_time' => $proposedTime,
            'confirmed_time' => $confirmedTime,
        ];
    }
} 