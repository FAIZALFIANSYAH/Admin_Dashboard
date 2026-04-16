<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.project.index', compact('projects'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'year' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);

        $data = $request->all();

        // Logika Upload Gambar
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada
            if ($project->thumbnail) {
                Storage::delete('public/' . $project->thumbnail);
            }
            // Simpan gambar baru ke folder storage/projects
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('project.index')->with('success', 'Project berhasil diperbarui!');
    }
}