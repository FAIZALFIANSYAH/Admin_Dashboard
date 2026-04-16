@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header"><h3 class="card-title">My Video Projects</h3></div>
        <div class="card-body">
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Video Path</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($videos as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
    @if($item->thumbnail_url)
        <img src="{{ asset('storage/' . $item->thumbnail_url) }}" width="80" class="img-thumbnail">
    @else
        <span class="badge badge-secondary">No Thumbnail</span>
    @endif
</td>
                        <td>{{ $item->title ?? 'Untitled' }}</td>
                        <td>
    @if($item->video_url)
        <a href="{{ asset('storage/' . $item->video_url) }}" target="_blank" class="btn btn-xs btn-outline-primary">
            <i class="fas fa-play"></i> Lihat Video
        </a>
    @else
        <span class="badge badge-danger">Video Missing</span>
    @endif
</td>
                        <td>
                            <a href="{{ route('video.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">Belum ada video.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection