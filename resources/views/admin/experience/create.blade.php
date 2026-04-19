@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add New Career Narrative</h3>
        </div>
        
        <form action="{{ route('experience.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="position">Position</label>
                    <input type="text" name="position" class="form-control" id="position" placeholder="Contoh: Web Developer" value="{{ old('position') }}" required>
                </div>

                <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Contoh: PT. Maju Mundur" value="{{ old('company_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" placeholder="Contoh: Jakarta / Remote" value="{{ old('location') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_year">Start Year</label>
                            <input type="text" name="start_year" class="form-control" id="start_year" placeholder="2022" value="{{ old('start_year') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_year">End Year</label>
                            <input type="text" name="end_year" class="form-control" id="end_year" placeholder="2024" value="{{ old('end_year') }}">
                            <small class="text-muted text-italic">*Kosongkan jika masih bekerja di sini</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_current" class="custom-control-input" id="is_current" value="1">
                        <label class="custom-control-label" for="is_current">Still Working Here (Present)</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Jelaskan tugas atau pencapaianmu...">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('experience.index') }}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-primary float-right">Save Experience</button>
            </div>
        </form>
    </div>
</div>
@endsection