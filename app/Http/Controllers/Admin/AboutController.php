<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        $about = AboutSection::first();
        return view('admin.about.index', compact('about'));
    }

    public function edit($id) {
        $about = AboutSection::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title',
            'description' => 'required',
        ]);

        $about = AboutSection::findOrFail($id);
        $about->update($request->all());

        return redirect()->route('about.index')->with('success', 'About Me berhasil diperbarui!');
    }
}