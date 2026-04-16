@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card card-primary">
        <div class="card-header"><h3 class="card-title">Update Video File</h3></div>
        <form action="{{ route('video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Judul Video</label>
                    <input type="text" name="title" class="form-control" value="{{ $video->title }}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>File Video (.mp4)</label>
                        @if($video->video_url)
                            <div class="mb-2">
                                <video width="200" controls>
                                    <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                                </video>
                            </div>
                        @endif
                        <input type="file" name="video_file" class="form-control">
                        <small class="text-muted">Format: mp4. Max: 20MB.</small>
                    </div>

                    <div class="col-md-6">
                        <label>Thumbnail Cover</label>
                        @if($video->thumbnail_url)
                            <img src="{{ asset('storage/' . $video->thumbnail_url) }}" width="150" class="d-block mb-2 img-thumbnail">
                        @endif
                        <input type="file" name="thumbnail_url" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('video.index') }}" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection