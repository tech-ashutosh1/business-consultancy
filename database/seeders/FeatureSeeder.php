<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\TeamMember;

class FeatureSeeder extends Seeder
{
    public function run()
    {
        // Seed Testimonials
        Testimonial::create([
            'name' => 'Sarah Johnson',
            'position' => 'CEO',
            'company' => 'TechStart Inc.',
            'content' => 'The consultancy provided invaluable insights that helped us scale our operations by 200% in just one year. Highly recommended!',
            'rating' => 5,
        ]);

        Testimonial::create([
            'name' => 'Michael Chen',
            'position' => 'Director of Operations',
            'company' => 'Global Logistics',
            'content' => 'Professional, knowledgeable, and results-driven. They transformed our supply chain efficiency completely.',
            'rating' => 5,
        ]);

        Testimonial::create([
            'name' => 'Emily Davis',
            'position' => 'Founder',
            'company' => 'Creative Solutions',
            'content' => 'A true partner in our success. Their strategic guidance was exactly what we needed to navigate our market expansion.',
            'rating' => 4,
        ]);

        // Seed Team Members
        TeamMember::create([
            'name' => 'David Wilson',
            'position' => 'Senior Strategy Consultant',
            'bio' => 'With over 15 years of experience in corporate strategy, David specializes in helping companies navigate complex market transitions and digital transformation.',
            'linkedin_url' => 'https://linkedin.com',
            'twitter_url' => 'https://twitter.com',
        ]);

        TeamMember::create([
            'name' => 'Jennifer Lee',
            'position' => 'Financial Advisory Lead',
            'bio' => 'Jennifer brings a wealth of knowledge in financial planning and risk management, having worked with Fortune 500 companies for over a decade.',
            'linkedin_url' => 'https://linkedin.com',
        ]);

        TeamMember::create([
            'name' => 'Robert Taylor',
            'position' => 'Operations Specialist',
            'bio' => 'Robert is an expert in operational efficiency and process optimization, dedicated to helping businesses streamline their workflows and reduce costs.',
            'twitter_url' => 'https://twitter.com',
        ]);
    }
}
