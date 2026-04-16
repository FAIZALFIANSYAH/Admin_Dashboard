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

public function edit($id) {
    $expertise = \App\Models\Expertise::findOrFail($id);
    return view('admin.expertise.edit', compact('expertise'));
}

public function update(Request $request, $id) {
    $expertise = \App\Models\Expertise::findOrFail($id);
    $expertise->update($request->all());
    return redirect()->route('expertise.index')->with('success', 'Skill updated!');
}
}
