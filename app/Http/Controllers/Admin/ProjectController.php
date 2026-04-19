<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada
use Illuminate\Support\Str;             // Tambahkan ini agar Str tidak merah

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.project.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.project.create');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.project.edit', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'category'    => 'required',
            'year'        => 'required',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi 2MB
            'images.*'    => 'nullable|image|max:2048',                   // Galeri juga 2MB
            'description' => 'nullable'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        $project = Project::create($data);

        // Simpan Galeri jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects/gallery', 'public');
                $project->images()->create(['image_url' => $path]);
            }
        }

        return redirect()->route('project.index')->with('success', 'Proyek berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title'     => 'required',
            'category'  => 'required',
            'year'      => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi 2MB
            'images.*'  => 'nullable|image|max:2048',                   // Validasi 2MB
        ]);

        $data = $request->all();

        // TAMBAHKAN BARIS INI: Supaya kalau judul berubah, slug ikut update
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        // Logika Update Thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        $project->update($data);

        // Logika Tambah Foto Galeri Baru
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects/gallery', 'public');
                $project->images()->create(['image_url' => $path]);
            }
        }

        return redirect()->route('project.index')->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // 1. Hapus Thumbnail Utama
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        // 2. Hapus Semua Foto di Galeri (jika ada relasi images)
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_url);
        }

        // 3. Hapus Data dari Database
        $project->delete();

        return redirect()->route('project.index')->with('success', 'Project dan semua filenya berhasil dihapus!');
    }
}
