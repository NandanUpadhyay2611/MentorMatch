<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition(): array
    {
        $skills = [
            'Marketing' => ['Digital Marketing', 'Social Media', 'Content Strategy', 'SEO', 'Email Marketing'],
            'Technology' => ['Web Development', 'Mobile Development', 'Cloud Computing', 'AI/ML', 'DevOps'],
            'Business' => ['Strategy', 'Operations', 'Finance', 'Sales', 'Product Management'],
            'Design' => ['UI/UX', 'Graphic Design', 'Product Design', 'Branding', 'User Research'],
        ];

        $randomSkills = [];
        foreach ($skills as $category => $categorySkills) {
            $randomSkills = array_merge($randomSkills, $this->faker->randomElements($categorySkills, rand(2, 4)));
        }

        return [
            'bio' => $this->faker->paragraph(3),
            'skills' => $randomSkills,
            'experience' => $this->faker->paragraph(5),
            'availability' => $this->faker->boolean(80), // 80% chance of being available
        ];
    }
} 