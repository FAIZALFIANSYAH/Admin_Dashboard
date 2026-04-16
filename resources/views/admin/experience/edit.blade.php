@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card card-primary">
        <div class="card-header"><h3 class="card-title">Edit Career Narrative</h3></div>
        <form action="{{ route('experience.update', $experience->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" name="position" class="form-control" value="{{ $experience->position }}">
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control" value="{{ $experience->company_name }}">
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" value="{{ $experience->location }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Year</label>
                            <input type="text" name="start_year" class="form-control" value="{{ $experience->start_year }}">
                        </div>
                        <div class="form-group">
                            <label>End Year (Kosongkan jika masih aktif)</label>
                            <input type="text" name="end_year" class="form-control" value="{{ $experience->end_year }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $experience->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Experience</button>
                <a href="{{ route('experience.index') }}" class="btn btn-default">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection