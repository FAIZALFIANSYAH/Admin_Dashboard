@extends('layouts.app')

@section('content')
<section class="content">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Produk: {{ $product->name }}</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT') 
            
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category" class="form-control">
                        <option value="Elektronik" {{ $product->category == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="Pakaian" {{ $product->category == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                        <option value="Makanan" {{ $product->category == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="Buku" {{ $product->category == 'Buku' ? 'selected' : '' }}>Buku</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-warning">Update Data</button>
                <a href="{{ route('products.index') }}" class="btn btn-default float-right">Batal / Kembali</a>
            </div>
        </form>
    </div>
</section>
@endsection