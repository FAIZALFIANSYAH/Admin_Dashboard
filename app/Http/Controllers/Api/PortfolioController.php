<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Video;
use App\Models\Contact;
use App\Models\SocialLink;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'hero' => HeroSection::first(),
                'about' => AboutSection::with(['expertises', 'tools'])->first(),
                'experiences' => Experience::orderBy('start_year', 'desc')->get(),
                'projects' => Project::with('images')->get(),
                'videos' => Video::all(),
                'contact' => Contact::first(),
                'social_links' => SocialLink::all(),
            ]
        ]);
    }
}