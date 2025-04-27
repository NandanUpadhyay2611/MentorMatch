<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create mentor users
        $mentors = [
            [
                'name' => 'John Mentor',
                'email' => 'mentor@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_MENTOR,
            ],
            [
                'name' => 'Sarah Advisor',
                'email' => 'advisor@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_MENTOR,
            ],
            [
                'name' => 'Michael Consultant',
                'email' => 'michael@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_MENTOR,
            ],
            [
                'name' => 'Emily Expert',
                'email' => 'emily@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_MENTOR,
            ],
        ];

        foreach ($mentors as $mentor) {
            $user = User::create($mentor);
            Profile::factory()->create(['user_id' => $user->id]);
        }

        // Create startup users
        $startups = [
            [
                'name' => 'Startup Founder',
                'email' => 'startup@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_STARTUP,
            ],
            [
                'name' => 'Tech Entrepreneur',
                'email' => 'entrepreneur@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_STARTUP,
            ],
            [
                'name' => 'Innovation Labs',
                'email' => 'innovation@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_STARTUP,
            ],
            [
                'name' => 'Future Tech',
                'email' => 'future@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_STARTUP,
            ],
        ];

        foreach ($startups as $startup) {
            $user = User::create($startup);
            Profile::factory()->create(['user_id' => $user->id]);
        }

        // Create additional random users
        User::factory(10)->create(['role' => User::ROLE_MENTOR])
            ->each(function ($user) {
                Profile::factory()->create(['user_id' => $user->id]);
            });

        User::factory(10)->create(['role' => User::ROLE_STARTUP])
            ->each(function ($user) {
                Profile::factory()->create(['user_id' => $user->id]);
            });
    }
} 