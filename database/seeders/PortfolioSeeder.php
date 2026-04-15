<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Video;
use App\Models\Contact;
use App\Models\SocialLink;


class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // 1. Hero Section [cite: 2-9]
    HeroSection::create([
        'badge' => 'Available for Work',
        'headline' => 'RPL Boys & From Jenpo.',
        'subheadline' => 'Focus internship.',
        'cta_text' => 'View My Projects',
        'cta_link' => '#projects',
        'image_url' => '/images/RplDesain.jpeg'
    ]);

    // 2. About Section & Relasi [cite: 12-22]
    $about = AboutSection::create([
        'description' => "I'm currently focused on running the PKL away in Caruban cheerful."
    ]);

    $about->expertises()->createMany([
        ['name' => 'Backend Development'],
        ['name' => 'UI/UX Design'],
        ['name' => 'Projects Documentation'],
    ]);

    $about->tools()->createMany([
        ['name' => 'Laravel & Vscode'],
        ['name' => 'Tailwind & Modern CSS'],
        ['name' => 'Github'],
    ]);

    // 3. Experiences (Data Karir kamu) [cite: 23-33]
    Experience::create([
        'position' => 'Learn C++ Language and Logic Programming',
        'company_name' => 'Lower Lab RPL, Jenpo',
        'location' => 'Jenpo',
        'start_year' => '2024',
        'end_year' => '2025',
        'is_current' => false,
        'description' => 'Building a robust foundation in programming logic through data structures.'
    ]);

    Experience::create([
        'position' => 'Learn Laravel',
        'company_name' => 'Vexa Game',
        'location' => 'Caruban',
        'start_year' => '2026',
        'end_year' => 'Present',
        'is_current' => true,
        'description' => 'Implementing MVC architecture to build secure database management systems.'
    ]);

    // 4. Projects [cite: 34-42]
    $project = Project::create([
        'title' => 'Branding Identity',
        'slug' => 'branding-identity',
        'category' => 'Design & Concept',
        'year' => '2026',
        'thumbnail' => '/images/softwareEnthusias.jpeg',
        'description' => 'Full branding project for software enthusiasts.'
    ]);

    // 5. Videos (Video Reel)
    Video::create([
        'title' => 'STMJ Day',
        'video_url' => '/videos/stmjDay\'s.mp4',
    ]);

    Video::create([
        'title' => 'Flare STMJ',
        'video_url' => '/videos/flareSTMJ.mp4',
    ]);

    // 6. Contact & Social [cite: 47-53]
    Contact::create(['email' => 'muhfaiza@gmail.com']);
    SocialLink::create(['platform' => 'Instagram', 'url' => 'https://instagram.com/softwareboys61']);
}
}
