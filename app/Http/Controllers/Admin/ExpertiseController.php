<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    public function index() {
    $expertises = \App\Models\Expertise::all(); // Pakai all() karena skill biasanya banyak
    return view('admin.expertise.index', compact('expertises'));
}

 public function create()
{
    return view('admin.expertise.create');
}

public function edit($id) {
    $expertise = \App\Models\Expertise::findOrFail($id);
    return view('admin.expertise.edit', compact('expertise'));
}

public function update(Request $request, $id) {
    $expertise = \App\Models\Expertise::findOrFail($id);
    $expertise->update($request->all());
    return redirect()->route('expertise.index')->with('success', 'Skill updated!');
}

public function store(Request $request) {
    $request->validate(['name' => 'required']);
    
    $about = \App\Models\AboutSection::first();

    \App\Models\Expertise::create([
        'about_id' => $about->id,
        'name' => $request->name
    ]);

    return redirect()->route('expertise.index')->with('success', 'Expertise added!');
}

public function destroy($id) {
    \App\Models\expertise::findOrFail($id)->delete();
    return redirect()->route('expertise.index')->with('success', 'Expertise deleted!');
}

}
