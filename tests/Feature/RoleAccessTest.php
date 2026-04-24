<?php

namespace Tests\Feature;

use App\Models\AboutSection;
use App\Models\Contact;
use App\Models\HeroSection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager1_can_access_text_content_routes_only(): void
    {
        HeroSection::create([
            'badge' => 'Badge',
            'headline' => 'Headline',
        ]);

        AboutSection::create([
            'description' => 'About text',
        ]);

        $manager1 = User::where('email', 'manager1@gmail.com')->firstOrFail();

        $this->actingAs($manager1)->get(route('hero.index'))->assertOk();
        $this->actingAs($manager1)->get(route('about.index'))->assertOk();
        $this->actingAs($manager1)->get(route('experience.index'))->assertOk();
        $this->actingAs($manager1)->get(route('Dashboard.index'))->assertForbidden();
        $this->actingAs($manager1)->get(route('project.index'))->assertForbidden();
    }

    public function test_manager2_can_access_dashboard_and_projects_only(): void
    {
        $manager2 = User::where('email', 'manager2@gmail.com')->firstOrFail();

        $this->actingAs($manager2)->get(route('Dashboard.index'))->assertOk();
        $this->actingAs($manager2)->get(route('project.index'))->assertOk();
        $this->actingAs($manager2)->get(route('hero.index'))->assertForbidden();
        $this->actingAs($manager2)->get(route('about.index'))->assertForbidden();
        $this->actingAs($manager2)->get(route('users.index'))->assertForbidden();
    }

    public function test_superadmin_can_access_user_management(): void
    {
        Contact::create([
            'email' => 'contact@example.com',
        ]);

        $superadmin = User::where('email', 'muhfaiza206@gmail.com')->firstOrFail();

        $this->actingAs($superadmin)->get(route('users.index'))->assertOk();
        $this->actingAs($superadmin)->get(route('contact.index'))->assertOk();
        $this->actingAs($superadmin)->get(route('video.index'))->assertOk();
    }
}
