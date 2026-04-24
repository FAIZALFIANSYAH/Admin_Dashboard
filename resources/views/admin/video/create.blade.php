@extends('layouts.app')

@section('content')
@can('video')
<div class="container-fluid pt-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add New Video Project</h3>
        </div>
        <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Video Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter title" required>
                </div>
                <div class="form-group">
                    <label>Thumbnail (Optional)</label>
                    <input type="file" name="thumbnail" class="form-control">
                </div>
                <div class="form-group">
                    <label>Video File (.mp4)</label>
                    <input type="file" name="video" class="form-control" required>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('video.index') }}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-primary">Upload Video</button>
            </div>
        </form>
    </div>
</div>
@endcan
@endsection
