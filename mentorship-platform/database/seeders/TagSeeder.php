<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            // Technology
            'Web Development',
            'Mobile Development',
            'AI/ML',
            'Blockchain',
            'Cloud Computing',
            'DevOps',
            'Cybersecurity',
            'Data Science',
            'IoT',
            'AR/VR',

            // Business
            'Startup Strategy',
            'Business Development',
            'Marketing',
            'Sales',
            'Finance',
            'Operations',
            'HR',
            'Legal',
            'Product Management',
            'Project Management',

            // Design
            'UI/UX Design',
            'Graphic Design',
            'Product Design',
            'Branding',
            'Motion Design',
            '3D Design',
            'Industrial Design',
            'Architecture',
            'Interior Design',
            'Fashion Design',

            // Industry Specific
            'Healthcare',
            'Education',
            'FinTech',
            'E-commerce',
            'SaaS',
            'Gaming',
            'Media',
            'Real Estate',
            'Transportation',
            'Energy',
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
} 