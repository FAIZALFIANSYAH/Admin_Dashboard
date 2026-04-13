<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = \App\Models\Product::all();

    // Mengirim data tersebut ke file view
    return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi: Pastikan data yang diisi user sudah benar
    $request->validate([
        'name' => 'required|min:3',
        'category' => 'required',
        'stock' => 'required|numeric',
        'price' => 'required|numeric',
    ]);

    // Simpan ke database menggunakan Model
    \App\Models\Product::create([
        'name' => $request->name,
        'category' => $request->category,
        'stock' => $request->stock,
        'price' => $request->price,
    ]);

    // Lempar balik ke halaman index dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Cari data di database berdasarkan ID
    $product = \App\Models\Product::findOrFail($id);

    // Kirim data barang tersebut ke view edit
    return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi data baru
    $request->validate(['name' => 'required', 'stock' => 'required|numeric', 'price' => 'required|numeric']);

    // 2. Cari data lamanya
    $product = \App\Models\Product::findOrFail($id);

    // 3. Timpa data lama dengan data baru dari form ($request)
    $product->update([
        'name' => $request->name,
        'category' => $request->category,
        'stock' => $request->stock,
        'price' => $request->price,
    ]);

    return redirect()->route('products.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // 1. Cari barangnya
    $product = \App\Models\Product::findOrFail($id);

    // 2. Perintahkan Model untuk menghapus dari database
    $product->delete();

    // 3. Kembali ke index dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus selamanya!');
    }
}
