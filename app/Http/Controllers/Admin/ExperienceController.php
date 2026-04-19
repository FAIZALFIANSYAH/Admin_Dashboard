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

      public function create()
{
    return view('admin.experience.create');
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

    public function store(Request $request)
{
    $data = $request->validate([
        'position' => 'required',
        'company_name' => 'required',
        'location' => 'required',
        'start_year' => 'required',
        'end_year' => 'nullable',
        'is_current' => 'boolean',
        'description' => 'required'
    ]);

    \App\Models\Experience::create($data);
    return redirect()->route('experience.index')->with('success', 'Experience added.');
}

public function destroy($id)
{
    \App\Models\Experience::findOrFail($id)->delete();
    return redirect()->route('experience.index')->with('success', 'Experience deleted.');
}
}