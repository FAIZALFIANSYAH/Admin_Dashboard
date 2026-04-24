@extends('layouts.app')

@section('content')
@can('products')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Produk Baru</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Inventaris</h3>
            </div>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama barang" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category" class="form-control">
                            <option value="Elektronik">Elektronik</option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Buku">Buku</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stock" class="form-control" placeholder="0" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="price" class="form-control" placeholder="1000" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="{{ route('products.index') }}" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endcan
@endsection
