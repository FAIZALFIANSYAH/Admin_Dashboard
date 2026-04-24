<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Expertise;
use App\Models\HeroSection;
use App\Models\Project;
use App\Models\SocialLink;
use App\Models\Tool;
use App\Models\Video;

class DashboardController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $hero = HeroSection::latest()->first();
        $about = AboutSection::withCount(['expertises', 'tools'])->latest()->first();
        $contact = Contact::latest()->first();

        $stats = collect([
            [
                'permission' => 'hero',
                'label' => 'Hero Section',
                'value' => HeroSection::count(),
                'icon' => 'fa-rocket',
                'color' => 'info',
                'route' => route('hero.index'),
                'help' => $hero?->headline ? 'Headline sudah terisi.' : 'Belum ada headline.',
            ],
            [
                'permission' => 'expertise',
                'label' => 'Expertises',
                'value' => Expertise::count(),
                'icon' => 'fa-lightbulb',
                'color' => 'success',
                'route' => route('expertise.index'),
                'help' => 'Daftar keahlian/learning yang tampil di section About.',
            ],
            [
                'permission' => 'experience',
                'label' => 'Career Entries',
                'value' => Experience::count(),
                'icon' => 'fa-briefcase',
                'color' => 'warning',
                'route' => route('experience.index'),
                'help' => 'Riwayat pengalaman kerja dan perjalanan karier.',
            ],
            [
                'permission' => 'project',
                'label' => 'Projects',
                'value' => Project::count(),
                'icon' => 'fa-code',
                'color' => 'danger',
                'route' => route('project.index'),
                'help' => 'Project portfolio utama yang sudah dipublikasikan.',
            ],
            [
                'permission' => 'tools',
                'label' => 'Tools',
                'value' => Tool::count(),
                'icon' => 'fa-tools',
                'color' => 'primary',
                'route' => route('tools.index'),
                'help' => 'Stack dan tools yang ditampilkan di About.',
            ],
            [
                'permission' => 'video',
                'label' => 'Videos',
                'value' => Video::count(),
                'icon' => 'fa-video',
                'color' => 'secondary',
                'route' => route('video.index'),
                'help' => 'Video project atau reels yang tersedia.',
            ],
 ])->filter(fn (array $item): bool => $user->can($item['permission']))->values()->all();

        $contentHealth = collect([
            [
                'permission' => 'hero',
                'title' => 'Hero',
                'status' => (bool) $hero,
                'description' => $hero?->headline ?: 'Belum ada data hero.',
                'route' => route('hero.index'),
                'action' => 'Kelola Hero',
            ],
            [
                'permission' => 'about',
                'title' => 'About',
                'status' => (bool) $about && filled($about->description),
                'description' => $about?->description
                    ? 'Deskripsi about tersedia dengan ' . $about->expertises_count . ' expertise dan ' . $about->tools_count . ' tools.'
                    : 'Deskripsi about belum diisi.',
                'route' => route('about.index'),
                'action' => 'Edit About',
            ],
            [
                'permission' => 'contact',
                'title' => 'Contact',
                'status' => (bool) $contact && filled($contact->email),
                'description' => $contact?->email
                    ? 'Email utama: ' . $contact->email . '. Social link terdaftar: ' . SocialLink::count() . '.'
                    : 'Email kontak belum tersedia.',
                'route' => route('contact.index'),
                'action' => 'Atur Contact',
            ],
            [
                'permission' => 'project',
                'title' => 'Projects',
                'status' => Project::count() > 0,
                'description' => Project::count() . ' project tersimpan dan terhubung ke data portfolio global.',
                'route' => route('project.index'),
                'action' => 'Kelola Project',
            ],
            [
                'permission' => 'video',
                'title' => 'Videos',
                'status' => Video::count() > 0,
                'description' => Video::count() . ' video project tersimpan.',
                'route' => route('video.index'),
                'action' => 'Kelola Video',
            ],
 ])->filter(fn (array $item): bool => $user->can($item['permission']))->values()->all();

        $recentProjects = Project::latest()->take(5)->get();
        $recentExperiences = Experience::latest()->take(5)->get();
        $recentVideos = Video::latest()->take(5)->get();

        $projectCategories = Project::selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'stats',
            'hero',
            'about',
            'contact',
            'contentHealth',
            'recentProjects',
            'recentExperiences',
            'recentVideos',
            'projectCategories'
        ));
    }
}
