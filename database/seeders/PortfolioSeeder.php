<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Video;
use App\Models\Contact;
use App\Models\SocialLink;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Hero Section
        HeroSection::create([
            'badge' => 'Available for Work',
            'headline' => 'RPL Boys & From Jenpo.',
            'subheadline' => 'Focus internship.',
            'cta_text' => 'View My Projects',
            'cta_link' => '#projects',
            'image_url' => 'hero/RplDesain.jpeg' // Path standar CRUD Hero
        ]);

        // 2. About Section
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

        // 3. Experiences
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
            'position' => 'Learn Backend with Node.js and React with Vue.js',
            'company_name' => 'Upper Lab RPL, Jenpo',
            'location' => 'Jenpo',
            'start_year' => '2025',
            'end_year' => '2026',
            'is_current' => false,
            'description' => 'Developing dynamic web applications with complex API integrations.'
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

        // 4. Projects (Path disesuaikan ke projects/thumbnails/)
        $projects = [
            [
                'title' => 'Branding Identity',
                'category' => 'Design & Concept',
                'thumbnail' => 'projects/thumbnails/softwareEnthusias.jpeg',
            ],
            [
                'title' => 'Dashboard UI',
                'category' => 'Web App Design',
                'thumbnail' => 'projects/thumbnails/softwareBus.jpeg',
            ],
            [
                'title' => 'Abstract Art',
                'category' => '3D Illustration',
                'thumbnail' => 'projects/thumbnails/inWilis.jpeg',
            ],
            [
                'title' => 'Editorial Design',
                'category' => 'Typography System',
                'thumbnail' => 'projects/thumbnails/inJogja.jpeg',
            ],
        ];

        foreach ($projects as $proj) {
            Project::create([
                'title' => $proj['title'],
                'slug' => Str::slug($proj['title']) . '-' . Str::random(5),
                'category' => $proj['category'],
                'year' => '2026',
                'thumbnail' => $proj['thumbnail'],
                'description' => 'Full branding project for ' . $proj['title']
            ]);
        }

        // 5. Videos (Path disesuaikan ke videos/)
        Video::create([
            'title' => 'STMJ Day',
            'video_url' => 'videos/stmjDay\'s.mp4',
        ]);

        Video::create([
            'title' => 'Flare STMJ',
            'video_url' => 'videos/flareSTMJ.mp4',
        ]);

        // 6. Contact & Social
        Contact::create(['email' => 'muhfaiza@gmail.com']);
        SocialLink::create(['platform' => 'Instagram', 'url' => 'https://instagram.com/softwareboys61']);
    }
}
