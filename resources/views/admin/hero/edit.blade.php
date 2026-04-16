@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Hero Section</h3>
        </div>
        <form action="{{ route('hero.update', $hero->id) }}" method="POST">
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
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('hero.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection