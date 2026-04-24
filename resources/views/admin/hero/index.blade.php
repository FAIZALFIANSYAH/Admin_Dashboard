@extends('layouts.app')

@section('content')
@can('hero')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Hero Section Management</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Hero saat ini</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <table class="table table-bordered">

                    <tr>
                        <th>Hero Image</th>
                        <td>
                            {{-- 1. Cek dulu apakah data Hero ada di database --}}
                            @if(isset($hero))

                            {{-- 2. Jika ada, baru cek apakah dia punya file gambar --}}
                            @if($hero->image_url)
                            {{-- Menggunakan Storage::url lebih aman daripada asset('storage/...') --}}
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($hero->image_url) }}" width="200" class="img-thumbnail d-block mb-2">

                            <form action="{{ route('hero.deleteImage', $hero->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menyembunyikan gambar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash"></i> Remove Image Only
                                </button>
                            </form>
                            @else
                            <span class="badge badge-secondary">Belum ada foto profil</span>
                            @endif

                            @else
                            {{-- 3. Jika data Hero sama sekali belum ada di tabel --}}
                            <span class="text-danger">Data Hero belum di-seed / kosong</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">Badge</th>
                        <td>{{ $hero?->badge ?? 'Belum ada data' }}</td>
                    </tr>
                    <tr>
                        <th>Headline</th>
                        <td>{{ $hero?->headline ?? 'Belum ada data' }}</td>
                    </tr>
                    <tr>
                        <th>Subheadline</th>
                        <td>{{ $hero?->subheadline ?? 'Belum ada data' }}</td>
                    </tr>
                    <tr>
                        <th>CTA Text</th>
                        <td>{{ $hero?->cta_text ?? 'Belum ada data' }}</td>
                    </tr>
                </table>

                <div class="mt-4">
                    @if($hero)
                        <a href="{{ route('hero.edit', $hero->id) }}" class="btn btn-warning">Edit Hero Section</a>
                    @else
                        <div class="alert alert-warning mb-0">
                            Data Hero belum tersedia, jadi tombol edit belum bisa digunakan.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>
@endcan
@endsection
