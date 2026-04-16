<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::all();
        return view('admin.tools.index', compact('tools'));
    }

    public function edit($id)
    {
        $tool = Tool::findOrFail($id);
        return view('admin.tools.edit', compact('tool'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        
        $tool = Tool::findOrFail($id);
        $tool->update([
            'name' => $request->name,
            'about_id' => 1 // ID Otomatis sesuai kesepakatan
        ]);

        return redirect()->route('tools.index')->with('success', 'Tool berhasil diperbarui!');
    }
}