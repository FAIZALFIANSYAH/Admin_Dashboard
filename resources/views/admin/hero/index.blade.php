@extends('layouts.app')

@section('content')
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
            <th style="width: 200px;">Badge</th>
            <td>{{ $hero->badge ?? 'Belum ada data' }}</td>
        </tr>
        <tr>
            <th>Headline</th>
            <td>{{ $hero->headline ?? 'Belum ada data' }}</td>
        </tr>
        <tr>
            <th>Subheadline</th>
            <td>{{ $hero->subheadline ?? 'Belum ada data' }}</td>
        </tr>
        <tr>
            <th>CTA Text</th>
            <td>{{ $hero->cta_text ?? 'Belum ada data' }}</td>
        </tr>
    </table>
    
    <div class="mt-4">
        <a href="{{ route ('hero.edit', $hero->id) }}" class="btn btn-warning">Edit Hero Section</a>
    </div>
    
</div>
        </div>
    </div>
</section>
@endsection