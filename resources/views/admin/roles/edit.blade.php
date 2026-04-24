@extends('layouts.app')

@section('content')
@can('roles.edit')
<div class="container-fluid pt-4">

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Role</h3>
        </div>

        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">
                    <label>Nama Role</label>
                    <input type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $role->name) }}"
                        required>

                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                @php
                    $selectedPermissions = old('permissions', $selectedPermissions ?? []);
                @endphp

                <div class="form-group">
                    <label>Permissions</label>

                    <div class="row">
                        @foreach($permissions as $module => $items)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-header py-2">
                                    <strong>{{ $module }}</strong>
                                    <span class="badge badge-light float-right">{{ count($items) }}</span>
                                </div>
                                <div class="card-body p-3">
                                    @foreach($items as $permission)
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="edit_{{ $permission->id }}"
                                            name="permissions[]"
                                            value="{{ $permission->name }}"
                                            @checked(in_array($permission->name, $selectedPermissions, true))>

                                        <label class="custom-control-label w-100" for="edit_{{ $permission->id }}">
                                            <span class="d-block font-weight-bold">
                                                {{ $permission->display_name ?? \Illuminate\Support\Str::headline(str_replace('.', ' ', $permission->name)) }}
                                            </span>
                                            <small class="d-block text-muted">{{ $permission->name }}</small>
                                            @if($permission->description)
                                                <small class="d-block text-muted">{{ $permission->description }}</small>
                                            @endif
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @error('permissions')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @error('permissions.*')
                    <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('roles.index') }}"
                    class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit"
                    class="btn btn-warning">
                    Update Role
                </button>
            </div>
        </form>
    </div>

</div>
@endcan
@endsection
