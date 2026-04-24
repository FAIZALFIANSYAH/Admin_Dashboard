@extends('layouts.app')

@section('content')
@can('dashboard')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
                <p class="text-muted mb-0">Ringkasan data portfolio yang tersimpan di panel admin.</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('Dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @forelse($stats as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="small-box bg-{{ $item['color'] }}">
                        <div class="inner">
                            <h3>{{ $item['value'] }}</h3>
                            <p>{{ $item['label'] }}</p>
                            <small>{{ $item['help'] }}</small>
                        </div>
                        <div class="icon">
                            <i class="fas {{ $item['icon'] }}"></i>
                        </div>
                        <a href="{{ $item['route'] }}" class="small-box-footer">
                            Buka halaman <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">Belum ada ringkasan yang bisa ditampilkan untuk permission akun ini.</div>
                </div>
            @endforelse
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-check mr-1"></i>
                            Status Konten Utama
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($contentHealth as $item)
                                <div class="{{ count($contentHealth) === 1 ? 'col-md-12' : 'col-md-4' }}">
                                    <div class="border rounded p-3 h-100">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="mb-0">{{ $item['title'] }}</h5>
                                            <span class="badge badge-{{ $item['status'] ? 'success' : 'danger' }}">
                                                {{ $item['status'] ? 'Siap' : 'Belum Lengkap' }}
                                            </span>
                                        </div>
                                        <p class="text-muted mb-3">{{ $item['description'] }}</p>
                                        <a href="{{ $item['route'] }}" class="btn btn-outline-primary btn-sm">
                                            {{ $item['action'] }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-folder-open mr-1"></i>
                            Project Terbaru
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tahun</th>
                                    <th>Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentProjects as $project)
                                    <tr>
                                        <td>
                                            <a href="{{ route('project.edit', $project->id) }}">{{ $project->title }}</a>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $project->category }}</span>
                                        </td>
                                        <td>{{ $project->year }}</td>
                                        <td>{{ $project->created_at?->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada project yang tersimpan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @canany(['experience', 'video'])
                    <div class="row">
                        @can('experience')
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-briefcase mr-1"></i>
                                            Experience Terbaru
                                        </h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush">
                                            @forelse($recentExperiences as $experience)
                                                <li class="list-group-item">
                                                    <strong>{{ $experience->position }}</strong>
                                                    <div>{{ $experience->company_name }}</div>
                                                    <small class="text-muted">
                                                        {{ $experience->start_year }} - {{ $experience->is_current ? 'Sekarang' : ($experience->end_year ?: '-') }}
                                                        @if($experience->location)
                                                            | {{ $experience->location }}
                                                        @endif
                                                    </small>
                                                </li>
                                            @empty
                                                <li class="list-group-item text-muted">Belum ada data pengalaman.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endcan

                        @can('video')
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-video mr-1"></i>
                                            Video Terbaru
                                        </h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush">
                                            @forelse($recentVideos as $video)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $video->title ?: 'Untitled video' }}</strong>
                                                        <div class="text-muted small">
                                                            {{ $video->video_url ? 'File video tersedia' : 'File video belum tersedia' }}
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('video.edit', $video->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                                </li>
                                            @empty
                                                <li class="list-group-item text-muted">Belum ada video yang ditambahkan.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                @endcanany
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bolt mr-1"></i>
                            Quick Actions
                        </h3>
                    </div>
                    <div class="card-body">
                        @can('hero')
                            <a href="{{ route('hero.index') }}" class="btn btn-primary btn-block mb-2">Kelola Hero Section</a>
                        @endcan
                        @can('about')
                            <a href="{{ route('about.index') }}" class="btn btn-outline-primary btn-block mb-2">Edit About</a>
                        @endcan
                        @can('project')
                            <a href="{{ route('project.create') }}" class="btn btn-outline-success btn-block mb-2">Tambah Project Baru</a>
                        @endcan
                        @can('video')
                            <a href="{{ route('video.create') }}" class="btn btn-outline-warning btn-block mb-2">Tambah Video Baru</a>
                        @endcan
                        @can('contact')
                            <a href="{{ route('contact.index') }}" class="btn btn-outline-dark btn-block">Atur Contact</a>
                        @endcan
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user mr-1"></i>
                            Ringkasan Portfolio
                        </h3>
                    </div>
                    <div class="card-body">
                        <dl class="mb-0">
                            @can('hero')
                                <dt>Hero Headline</dt>
                                <dd>{{ $hero?->headline ?: 'Belum ada headline.' }}</dd>
                            @endcan

                            @can('about')
                                <dt>About</dt>
                                <dd>{{ $about?->description ? \Illuminate\Support\Str::limit($about->description, 120) : 'Belum ada deskripsi about.' }}</dd>
                            @endcan

                            @can('contact')
                                <dt>Contact Email</dt>
                                <dd>{{ $contact?->email ?: 'Belum ada email kontak.' }}</dd>
                            @endcan

                            @can('project')
                                <dt>Project Data</dt>
                                <dd>Data project global. Jika diubah oleh akun ini, akun lain yang punya izin Project akan melihat perubahan yang sama.</dd>
                            @endcan
                        </dl>
                    </div>
                </div>

                @can('project')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tags mr-1"></i>
                            Kategori Project
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th class="text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projectCategories as $category)
                                    <tr>
                                        <td>{{ $category->category }}</td>
                                        <td class="text-right">{{ $category->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">Belum ada kategori project.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @endcan
            </div>
        </div>
    </div>
</section>
@endcan
@endsection
