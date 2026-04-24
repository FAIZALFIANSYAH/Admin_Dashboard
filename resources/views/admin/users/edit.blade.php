@extends('layouts.app')

@section('content')
@can('users.edit')
<div class="container-fluid pt-4">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Role</label>
                    @if($user->isSuperadmin())
                    <input type="text" class="form-control" value="{{ $user->roleLabel() }}" disabled>
                    <small class="text-muted">Role superadmin dikunci agar akun supreme tetap memiliki akses penuh.</small>
                    @else
                    <select name="role" class="form-control" required>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}" @selected(old('role', $user->role) === $role)>{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    @endif
                    @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                </div>



                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Kosongkan jika password tidak ingin diganti.</small><br>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-warning">Update User</button>
            </div>
        </form>
    </div>
</div>
@endcan
@endsection
