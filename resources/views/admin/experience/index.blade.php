@extends('layouts.app')

@section('content')
@can('experience')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Career Narrative List</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <a href="{{ route('experience.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Add New Experience
            </a>

            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="text-center">
                        <th style="width: 50px">No</th>
                        <th>Position</th>
                        <th>Company</th>
                        <th>Year</th>
                        <th style="width: 180px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($experiences as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $item->position }}</td>
                            <td>{{ $item->company_name }}</td>
                            <td class="text-center">
                                {{ $item->start_year }} - {{ $item->is_current ? 'Present' : $item->end_year }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('experience.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                 Edit
                                </a>

                                <form action="{{ route('experience.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengalaman ini?')">
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
                            <td colspan="5" class="text-center text-muted">Belum ada data pengalaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcan
@endsection
