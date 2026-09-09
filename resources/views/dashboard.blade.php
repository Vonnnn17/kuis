@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="page-title">Dashboard</h3>
        <div class="page-subtitle">Knowledge Management</div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card border-left-primary shadow-sm h-100">
            <div class="card-body">
                <div class="text-xs text-primary text-uppercase font-weight-bold">Kategori</div>
                <div class="h4 mt-2 mb-0">{{ \App\Models\Kategori::count() }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-left-success shadow-sm h-100">
            <div class="card-body">
                <div class="text-xs text-success text-uppercase font-weight-bold">Informasi</div>
                <div class="h4 mt-2 mb-0">{{ \App\Models\Informasi::count() }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-left-warning shadow-sm h-100">
            <div class="card-body">
                <div class="text-xs text-warning text-uppercase font-weight-bold">Draft</div>
                <div class="h4 mt-2 mb-0">{{ \App\Models\Informasi::where('status', 'draft')->count() }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-left-info shadow-sm h-100">
            <div class="card-body">
                <div class="text-xs text-info text-uppercase font-weight-bold">Published</div>
                <div class="h4 mt-2 mb-0">{{ \App\Models\Informasi::where('status', 'published')->count() }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="mb-3">Kategori</h5>
                <ul class="list-group list-group-flush">
                    @foreach(\App\Models\Kategori::take(5)->get() as $kategori)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>{{ $kategori->nama }}</span>
                            <span class="badge badge-light">{{ $kategori->informasis->count() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="mb-3">Informasi terbaru</h5>
                <ul class="list-group list-group-flush">
                    @foreach(\App\Models\Informasi::latest()->take(5)->get() as $item)
                        <li class="list-group-item px-0">
                            <div class="font-weight-bold">{{ $item->judul }}</div>
                            <small class="text-muted">{{ $item->status }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
