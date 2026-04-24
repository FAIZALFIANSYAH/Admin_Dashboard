@extends('layouts.app')

@section('content')
@can('project')
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
                            <input type="text" name="category" class="form-control" value="{{ $project->category }}" required>
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input type="number" name="year" class="form-control" value="{{ $project->year }}" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="5">{{ $project->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- Bagian Thumbnail Utama --}}
                        <div class="form-group">
                            <label>Current Thumbnail</label><br>
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" width="200" class="img-thumbnail mb-2 border-primary">
                            <input type="file" name="thumbnail" class="form-control">
                            <small class="text-muted">Leave blank if you don't want to change the thumbnail.</small>
                        </div>

                        <hr>

                        {{-- Bagian Galeri Tambahan --}}
                        <div class="form-group">
                            <label>Add More Photos to Gallery</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                            <small class="text-muted">Select multiple images to add to current gallery.</small>
                        </div>

                        <div class="form-group">
                            <label>Current Gallery Images</label>
                            <div class="row">
                                @forelse($project->images as $image)
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail" style="height: 80px; width: 100%; object-fit: cover;">
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted small italic">No additional images in gallery.</p>
                                    </div>
                                @endforelse
                            </div>
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
@endcan
@endsection
