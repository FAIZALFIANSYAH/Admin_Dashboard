@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Expertise</h3>
                </div>
                
                <form action="{{ route('expertise.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Skill Name</label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   placeholder="e.g. Backend Development"
                                   value="{{ old('name') }}"
                                   required>
                            
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Skill</button>
                        <a href="{{ route('expertise.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection