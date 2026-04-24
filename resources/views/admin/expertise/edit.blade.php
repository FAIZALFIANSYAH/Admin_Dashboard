@extends('layouts.app')

@section('content')
@can('expertise')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header">
            <h3>Edit Skill: {{ $expertise->title }}</h3>
        </div>
        <form action="{{ route('expertise.update', $expertise->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Skill Name</label>
                    <input type="text" name="title" class="form-control" value="{{ $expertise->title }}" required>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('expertise.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endcan
@endsection
