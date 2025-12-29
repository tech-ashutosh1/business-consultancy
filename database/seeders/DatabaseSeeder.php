<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Add test contact data
        Contact::create([
            'name' => 'John Smith',
            'email' => 'john.smith@example.com',
            'subject' => 'Business Inquiry',
            'message' => 'I am interested in your consulting services for my company. Please get in touch with me soon.',
        ]);

        Contact::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah.j@example.com',
            'subject' => 'Service Details',
            'message' => 'Could you provide more information about your strategic planning services?',
        ]);

        Contact::create([
            'name' => 'Michael Chen',
            'email' => 'michael.chen@example.com',
            'subject' => 'Project Proposal',
            'message' => 'We are looking for a consultant to help us with our digital transformation initiative. Can we schedule a meeting?',
        ]);

        Contact::create([
            'name' => 'Emma Wilson',
            'email' => 'emma.w@example.com',
            'subject' => 'General Question',
            'message' => 'What are your areas of expertise and how can you help my business grow?',
        ]);

        Contact::create([
            'name' => 'Robert Davis',
            'email' => 'robert.d@example.com',
            'subject' => 'Pricing Inquiry',
            'message' => 'I would like to know about your pricing structure and available packages.',
        ]);
    }
}
