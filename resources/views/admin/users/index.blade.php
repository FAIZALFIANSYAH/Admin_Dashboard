@extends('layouts.app')

@section('content')
@can('users.index')
<div class="container-fluid pt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->has('user'))
        <div class="alert alert-danger">{{ $errors->first('user') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Manajemen Role & User</h3>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-user-plus mr-1"></i> Tambah User
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Hak Akses</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <span class="badge badge-{{ $item->roles->first()?->name === 'superadmin' ? 'danger' : ($item->roles->first()?->name === 'manager1' ? 'info' : 'success') }}">
                                    {{ $item->roles->first()?->name ?? 'Tanpa Role' }}
                                </span>
                            </td>
                            <td>
                                @if($item->roles->contains('name', 'superadmin'))
                                    <span class="badge badge-danger">Full Access</span>
                                @else
                                    @forelse($item->roles->flatMap->permissions->unique('name') as $permission)
                                        <span class="badge badge-light border">{{ $permission->display_name ?? $permission->name }}</span>
                                    @empty
                                        <span class="text-muted">Belum ada akses</span>
                                    @endforelse
                                @endif
                            </td>
                            <td>{{ $item->email_verified_at ? 'Verified' : 'Belum Verified' }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                                @if(! $item->roles->contains('name', 'superadmin'))
                                    <form action="{{ route('users.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcan
@endsection
