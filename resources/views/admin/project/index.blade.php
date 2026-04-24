@extends('layouts.app')

@section('content')
@can('project')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">My Projects</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('project.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Add New Project
            </a>

            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Thumbnail</th>
                        <th>Project Title</th>
                        <th>Category</th>
                        <th>Year</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($item->thumbnail)
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($item->thumbnail) }}" target="_blank" class="btn btn-xs btn-outline-info">
                                <i class="fas fa-image"></i> Lihat Gambar
                            </a>
                            @else
                            <span class="badge badge-danger">Thumbnail Missing</span>
                            @endif
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <span class="badge badge-info">{{ $item->category }}</span>
                        </td>
                        <td>{{ $item->year }}</td>
                        <td>
                            <a href="{{ route('project.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('project.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus project ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-muted">Belum ada project yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcan
@endsection
