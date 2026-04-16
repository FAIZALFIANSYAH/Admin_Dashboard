<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        // Mengambil data pertama dari tabel hero
        $hero = HeroSection::first();

        // Mengirim data $hero ke halaman view
        return view('admin.hero.index', compact('hero'));
    }

    public function edit($id)
{
    $hero = HeroSection::findOrFail($id);
    return view('admin.hero.edit', compact('hero'));
}

public function update(Request $request, $id)
{
    // 1. Validasi (Supaya data tidak kosong)
    $request->validate([
        'badge' => 'required',
        'headline' => 'required',
    ]);

    // 2. Cari datanya
    $hero = HeroSection::findOrFail($id);

    // 3. Update datanya
    $hero->update([
        'badge' => $request->badge,
        'headline' => $request->headline,
    ]);

    // 4. Kembali ke halaman utama dengan pesan sukses
    return redirect()->route('hero.index')->with('success', 'Data Hero berhasil diperbarui!');
}

}
