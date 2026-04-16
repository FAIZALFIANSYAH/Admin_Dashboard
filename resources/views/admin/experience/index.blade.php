@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Career Narrative List</h3></div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Position</th>
                        <th>Company</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($experiences as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $item->position }}</td>
                        <td>{{ $item->company_name }}</td>
                        <td class="text-center">{{ $item->start_year }} - {{ $item->is_current ? 'Present' : $item->end_year }}</td>
                        <td class="text-center">
                            <a href="{{ route('experience.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada data pengalaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection