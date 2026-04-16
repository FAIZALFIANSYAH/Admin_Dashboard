@extends('layouts.app')
@section('content')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header"><h3>Edit About Me</h3></div>
        <form action="{{ route('about.update', $about->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ $about->description }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection