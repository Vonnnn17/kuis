@extends('layouts.app')

@section('title', 'Knowledge Portal')

@section('content')
<div class="mb-4">
    <h3 class="mb-2">Portal Informasi Publik</h3>
    <p class="text-muted mb-0">Lihat informasi yang sudah dipublikasikan.</p>
</div>

<form action="{{ route('public.index') }}" method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Cari informasi...">
        </div>
        <div class="col-md-3">
            <select name="kategori_id" class="form-control">
                <option value="">Semua kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-block">Cari</button>
        </div>
    </div>
</form>

@if($informasis->isEmpty())
    <div class="alert alert-light border">Belum ada informasi publik.</div>
@else
    <div class="row">
        @foreach($informasis as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <small class="text-muted">{{ $item->kategori->nama ?? 'Umum' }}</small>
                        <h5 class="mt-2">{{ $item->judul }}</h5>
                        <p class="text-muted small mb-3">
                            {{ \Illuminate\Support\Str::limit($item->ringkasan ?? $item->isi, 120) }}
                        </p>
                        <a href="{{ route('public.show', $item) }}" class="btn btn-outline-primary btn-sm">Baca</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $informasis->links() }}
    </div>
@endif
@endsection