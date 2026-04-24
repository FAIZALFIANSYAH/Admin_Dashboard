<?php

namespace Tests\Feature;

use App\Models\HeroSection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HeroNullStateTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager1_can_open_hero_page_when_hero_data_is_empty(): void
    {
        HeroSection::query()->delete();
        $manager1 = User::where('email', 'manager1@gmail.com')->firstOrFail();

        $response = $this->actingAs($manager1)->get(route('hero.index'));

        $response->assertOk();
        $response->assertSee('Data Hero belum di-seed / kosong');
        $response->assertSee('Data Hero belum tersedia, jadi tombol edit belum bisa digunakan.');
    }
}
