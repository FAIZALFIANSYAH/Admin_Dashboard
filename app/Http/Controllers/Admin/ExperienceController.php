<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::all();
        return view('admin.experience.index', compact('experiences'));
    }

    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        return view('admin.experience.edit', compact('experience'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'position' => 'required',
            'company_name' => 'required',
            'start_year' => 'required',
        ]);

        $experience = Experience::findOrFail($id);
        $experience->update($request->all());

        return redirect()->route('experience.index')->with('success', 'Career Narrative berhasil diperbarui!');
    }
}