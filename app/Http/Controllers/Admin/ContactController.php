<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first(); // Mengambil satu-satunya data email
        $socials = SocialLink::all(); // Mengambil daftar platform dan url
        return view('admin.contact.index', compact('contact', 'socials'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['email' => 'required|email']);
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return back()->with('success', 'Email contact berhasil diperbarui!');
    }

    public function addSocial(Request $request)
    {
        $request->validate([
            'platform' => 'required',
            'url' => 'required|url'
        ]);
        SocialLink::create($request->all());
        return back()->with('success', 'Social link berhasil ditambahkan!');
    }

    public function deleteSocial($id)
    {
        SocialLink::findOrFail($id)->delete();
        return back()->with('success', 'Social link berhasil dihapus!');
    }
}