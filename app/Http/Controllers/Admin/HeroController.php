<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $hero = HeroSection::findOrFail($id);

        $request->validate([
            'badge' => 'required',
            'headline' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto 2MB
        ]);

        $data = $request->only(['badge', 'headline', 'subheadline', 'cta_text', 'cta_link']);

        if ($request->hasFile('image')) {
            // LOGIKA HAPUS FILE FISIK DIHAPUS (Sesuai Permintaan)
            // Kita langsung timpa saja image_url dengan path baru tanpa delete yang lama
            $data['image_url'] = $request->file('image')->store('hero', 'public');
        }

        $hero->update($data);

        return redirect()->route('hero.index')->with('success', 'Hero Section updated successfully!');
    }

    /**
     * Fitur baru: Menghapus gambar saja dari database
     * File fisik tetap ada di storage
     */
    public function deleteImage($id)
    {
        $hero = HeroSection::findOrFail($id);

        if ($hero->image_url) {
            // PERINTAH HAPUS: Ini yang akan menghapus file fisik di storage/app/public/hero/
            Storage::disk('public')->delete($hero->image_url);

            // Update database jadi null
            $hero->update(['image_url' => null]);
        }

        return redirect()->back()->with('success', 'Gambar berhasil dihapus permanen dari folder storage!');
    }
}
