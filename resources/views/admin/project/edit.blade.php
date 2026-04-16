@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Project: {{ $project->title }}</h3>
        </div>
        <form action="{{ route('project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Project Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" value="{{ $project->category }}" placeholder="Web Dev / UI UX" required>
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" name="year" class="form-control" value="{{ $project->year }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Thumbnail</label><br>
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" width="150" class="img-thumbnail mb-2">
                            <input type="file" name="thumbnail" class="form-control">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ $project->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('project.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection