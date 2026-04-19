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
    /**
     * Get all portfolio data in one shot (Optional for Initial Load)
     */
    public function index(): JsonResponse
    {
        $data = [
            'hero'         => HeroSection::first(),
            'about'        => AboutSection::with(['expertises', 'tools'])->first(),
            'experiences'  => Experience::orderBy('start_year', 'desc')->get(),
            'projects'     => Project::with('images')->latest()->get(),
            'videos'       => Video::all(),
            'contact'      => Contact::first(),
            'social_links' => SocialLink::all(),
        ];

        return response()->json([
            'status' => 'success',
            'data'   => $data
        ], 200);
    }

    /**
     * Get Hero Section only
     */
    public function hero(): JsonResponse
    {
        $hero = HeroSection::first();
        return response()->json(['status' => 'success', 'data' => $hero]);
    }

    /**
     * Get About Section with Expertises and Tools
     */
    public function about(): JsonResponse
    {
        $about = AboutSection::with(['expertises', 'tools'])->first();
        return response()->json(['status' => 'success', 'data' => $about]);
    }

    /**
     * Get Experiences only
     */
    public function experiences(): JsonResponse
    {
        $experiences = Experience::orderBy('start_year', 'desc')->get();
        return response()->json(['status' => 'success', 'data' => $experiences]);
    }

    /**
     * Get all Projects (List)
     */
    public function projects(): JsonResponse
    {
        $projects = Project::latest()->get();
        return response()->json(['status' => 'success', 'data' => $projects]);
    }

    /**
     * Get Detailed Project by Slug
     */
    public function projectDetail($slug): JsonResponse
    {
        $project = Project::with('images')->where('slug', $slug)->first();

        if (!$project) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        return response()->json(['status' => 'success', 'data' => $project]);
    }

    /**
     * Get Videos only
     */
    public function videos(): JsonResponse
    {
        $videos = Video::all();
        return response()->json(['status' => 'success', 'data' => $videos]);
    }

    /**
     * Get Contact and Social Links
     */
    public function contact(): JsonResponse
    {
        $data = [
            'info'    => Contact::first(),
            'socials' => SocialLink::all()
        ];
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
