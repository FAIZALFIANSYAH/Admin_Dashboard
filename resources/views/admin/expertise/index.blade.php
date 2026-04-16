@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Learning / Expertises List</h3>
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
            
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th style="width: 50px" class="text-center">No</th>
                        <th>Skill / Learning Name</th>
                        <th style="width: 150px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expertises as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        {{-- Kita ganti $item->title menjadi $item->name sesuai database --}}
                        <td>{{ $item->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('expertise.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data skill.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection