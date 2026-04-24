@extends('layouts.app')
@section('content')
@can('about')
<div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header"><h3>About Me Management</h3></div>
        <div class="card-body">
            @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            <table class="table">
                <tr><th>Description</th><td>{{ $about->description }}</td></tr>
            </table>
            <a href="{{ route('about.edit', $about->id) }}" class="btn btn-warning mt-3">Edit About</a>
        </div>
    </div>
</div>
@endcan
@endsection
