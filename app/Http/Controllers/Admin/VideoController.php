<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('admin.video.index', compact('videos'));
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'title'         => 'nullable|string',
            'video_file'    => 'nullable|mimes:mp4,mov,ogg,qt|max:20000', // Max 20MB (sesuaikan limit server)
            'thumbnail_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['title']);

        // 1. Logika Upload File Video (.mp4)
        if ($request->hasFile('video_file')) {
            // Hapus video lama jika ada di storage
            if ($video->video_url && Storage::disk('public')->exists($video->video_url)) {
                Storage::disk('public')->delete($video->video_url);
            }
            // Simpan file video baru
            $data['video_url'] = $request->file('video_file')->store('videos', 'public');
        }

        // 2. Logika Upload Thumbnail (Cover)
        if ($request->hasFile('thumbnail_url')) {
            if ($video->thumbnail_url && Storage::disk('public')->exists($video->thumbnail_url)) {
                Storage::disk('public')->delete($video->thumbnail_url);
            }
            $data['thumbnail_url'] = $request->file('thumbnail_url')->store('video_thumbnails', 'public');
        }

        $video->update($data);

        return redirect()->route('video.index')->with('success', 'Video dan Thumbnail berhasil diupdate!');
    }

// 1. Menampilkan halaman form tambah
public function create()
{
    return view('admin.video.create');
}

// 2. Memproses penyimpanan data ke database & file ke storage
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'video' => 'required|mimes:mp4,mov,ogg|max:102400', // Max 100MB sesuai php.ini kita
    ]);

    $data = $request->all();

    // Upload Thumbnail jika ada
    if ($request->hasFile('thumbnail')) {
        $data['thumbnail_url'] = $request->file('thumbnail')->store('video_thumbnails', 'public');
    }

    // Upload Video (Wajib)
    if ($request->hasFile('video')) {
        $data['video_url'] = $request->file('video')->store('videos', 'public');
    }

    \App\Models\Video::create($data);

    return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan!');
}

// 3. Menghapus data dan file fisiknya
public function destroy($id)
{
    $video = \App\Models\Video::findOrFail($id);

    // Hapus file dari storage agar tidak memenuhi disk
    if ($video->thumbnail_url) {
        Storage::disk('public')->delete($video->thumbnail_url);
    }
    if ($video->video_url) {
        Storage::disk('public')->delete($video->video_url);
    }

    $video->delete();

    return redirect()->route('video.index')->with('success', 'Video berhasil dihapus!');
}
}
