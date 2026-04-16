@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">My Projects</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Thumbnail</th>
                        <th>Project Title</th>
                        <th>Category</th>
                        <th>Year</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" width="100" alt="thumb">
                        </td>
                        <td>{{ $item->title }}</td>
                        <td><span class="badge badge-info">{{ $item->category }}</span></td>
                        <td>{{ $item->year }}</td>
                        <td>
                            <a href="{{ route('project.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6">Belum ada project yang ditambahkan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection