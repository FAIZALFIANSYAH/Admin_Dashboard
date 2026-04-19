@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Tools List</h3></div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('tools.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Add New Tools
            </a>

            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Tool Name</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tools as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="{{ route('tools.edit', $item->id) }}" class="btn btn-sm btn-warning">
                             Edit
                            </a>

                            <form action="{{ route('tools.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengalaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                        </form>
                            </td>
                    </tr>
                    @empty
                    <tr><td colspan="3">Belum ada data tools.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection