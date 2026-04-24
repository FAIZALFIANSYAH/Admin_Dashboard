@extends('layouts.app')

@section('content')
@can('project')
<div class="container-fluid pt-4">
    <div class="card card-success">
        <div class="card-header"><h3 class="card-title">Add New Project</h3></div>
        {{-- Enctype sudah benar --}}
        <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Project Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" placeholder="Ex: Web Design" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Year</label>
                            <input type="number" name="year" class="form-control" value="{{ date('Y') }}" required>
                        </div>
                    </div>
                </div>

                {{-- Input Foto Utama --}}
                <div class="form-group">
                    <label>Thumbnail / Cover Image</label>
                    <input type="file" name="thumbnail" class="form-control">
                </div>

                {{-- TAMBAHAN: Input Gallery Banyak Foto --}}
                <div class="form-group">
                    <label>Project Gallery (Optional Multiple Images)</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                    <small class="text-muted">Gunakan Ctrl + Klik untuk memilih banyak foto sekaligus.</small>
                </div>

                <div class="form-group">
                    <label>Description (Optional)</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save Project</button>
                <a href="{{ route('project.index') }}" class="btn btn-default">Back</a>
            </div>
        </form>
    </div>
</div>
@endcan
@endsection
