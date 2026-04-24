<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expertise;
use App\Models\AboutSection;

class ExpertiseController extends Controller
{
    public function index()
    {
        $expertises = Expertise::all();
        return view('admin.expertise.index', compact('expertises'));
    }

    public function create()
    {
        return view('admin.expertise.create');
    }

    public function edit($id)
    {
        $expertise = Expertise::findOrFail($id);
        return view('admin.expertise.edit', compact('expertise'));
    }

    public function update(Request $request, $id)
    {
        $this->validateInput($request);

        $about = AboutSection::first();
        $expertise = Expertise::findOrFail($id);

        $expertise->update([
            'about_id' => $about->id,
            'name' => $request->name
        ]);

        return redirect()->route('expertise.index')->with('success', 'Skill updated!');
    }

    public function store(Request $request)
    {
        $this->validateInput($request);

        $about = AboutSection::first();
        Expertise::create([
            'about_id' => $about->id,
            'name' => $request->name
        ]);

        return redirect()->route('expertise.index')->with('success', 'Expertise added!');
    }

    public function destroy($id)
    {
        Expertise::findOrFail($id)->delete();
        return redirect()->route('expertise.index')->with('success', 'Expertise deleted!');
    }

    protected function validateInput(Request $request)
    {
        $request->validate(['name' => 'required']);
    }
}
