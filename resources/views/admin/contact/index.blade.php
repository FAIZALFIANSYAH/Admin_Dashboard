@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Main Contact Email</h3></div>
                <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ $contact->email }}">
                        </div>
                    </div>
                    <div class="card-footer"><button type="submit" class="btn btn-primary">Update Email</button></div>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-info">
                <div class="card-header"><h3 class="card-title">Social Media Links</h3></div>
                <div class="card-body">
                    <form action="{{ route('social.add') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row">
                            <div class="col-5"><input type="text" name="platform" class="form-control" placeholder="Ex: Instagram" required></div>
                            <div class="col-5"><input type="url" name="url" class="form-control" placeholder="https://..." required></div>
                            <div class="col-2"><button type="submit" class="btn btn-success btn-block">Add</button></div>
                        </div>
                    </form>
                    <table class="table table-bordered">
                        <thead><tr class="text-center"><th>Platform</th><th>URL</th><th>Aksi</th></tr></thead>
                        <tbody>
                            @foreach($socials as $social)
                            <tr>
                                <td>{{ $social->platform }}</td>
                                <td class="small">{{ $social->url }}</td>
                                <td class="text-center">
                                    <form action="{{ route('social.delete', $social->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-xs btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection