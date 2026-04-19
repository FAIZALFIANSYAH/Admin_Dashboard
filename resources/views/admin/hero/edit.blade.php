@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Hero Section</h3>
        </div>
        {{-- TAMBAHKAN enctype di bawah ini --}}
        <form action="{{ route('hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Badge</label>
                    <input type="text" name="badge" class="form-control" value="{{ $hero->badge }}">
                </div>
                <div class="form-group">
                    <label>Headline</label>
                    <input type="text" name="headline" class="form-control" value="{{ $hero->headline }}">
                </div>

                {{-- TAMBAHKAN INPUT GAMBAR DI SINI --}}
                <div class="form-group">
                    <label>Hero Image</label>
                    @if($hero->image_url)
                        <div class="mb-2">
                            <small class="text-muted">Gambar saat ini:</small><br>
                            <img src="{{ asset('storage/' . $hero->image_url) }}" width="100" class="img-thumbnail">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    <small class="text-muted">Format: jpg, png, jpeg. Maks: 2MB</small>
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('hero.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection