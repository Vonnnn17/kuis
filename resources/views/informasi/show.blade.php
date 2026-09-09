@extends('layouts.app')

@section('title', $informasi->judul)

@section('content')
<div style="max-width: 850px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.75rem;">
        <a href="{{ route('informasi.index') }}" class="btn btn-secondary">
            &larr; Kembali ke Daftar Informasi
        </a>
        <div style="display: flex; gap: 0.5rem;">
            @if($informasi->status === 'published')
                <a href="{{ route('public.show', $informasi) }}" class="btn btn-secondary" target="_blank">
                    🌐 Buka di Portal Publik
                </a>
            @endif
            <a href="{{ route('informasi.edit', $informasi) }}" class="btn btn-warning">
                ✏️ Ubah
            </a>
            <form method="POST" action="{{ route('informasi.destroy', $informasi) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    🗑️ Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Main Detail Card -->
    <div class="card">
        <div class="card-body" style="padding: 2.25rem;">
            <!-- Category & Status Bar -->
            <div style="display: flex; gap: 0.6rem; align-items: center; margin-bottom: 1rem; flex-wrap: wrap;">
                <span class="badge badge-category">
                    📁 {{ $informasi->kategori->nama ?? 'Tanpa Kategori' }}
                </span>
                @if($informasi->status === 'published')
                    <span class="badge badge-published">🟢 Published</span>
                @else
                    <span class="badge badge-draft">🟡 Draft</span>
                @endif
                <span style="font-size: 0.8rem; color: #94a3b8; margin-left: auto;">
                    Dibuat: {{ $informasi->created_at->format('d M Y, H:i') }}
                </span>
            </div>

            <!-- Title -->
            <h1 style="font-size: 1.8rem; font-weight: 800; color: #0f172a; line-height: 1.3; margin-bottom: 1.25rem;">
                {{ $informasi->judul }}
            </h1>

            <!-- Summary Box -->
            @if($informasi->ringkasan)
                <div style="background-color: #f1f5f9; border-left: 4px solid #6366f1; padding: 1rem 1.25rem; border-radius: 6px; margin-bottom: 1.5rem; font-style: italic; color: #334155; font-size: 0.95rem;">
                    <strong>Ringkasan:</strong> {{ $informasi->ringkasan }}
                </div>
            @endif

            <!-- Main Content -->
            <div style="color: #334155; font-size: 1rem; line-height: 1.8; white-space: pre-line; margin-bottom: 2rem;">
{{ $informasi->isi }}
            </div>

            <!-- Meta Information Footer -->
            <div style="padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1rem; font-size: 0.85rem; color: #64748b;">
                <div>
                    <strong>Sumber:</strong> 
                    @if($informasi->sumber)
                        @if(filter_var($informasi->sumber, FILTER_VALIDATE_URL))
                            <a href="{{ $informasi->sumber }}" target="_blank" style="color: #4f46e5;">{{ $informasi->sumber }} ↗</a>
                        @else
                            {{ $informasi->sumber }}
                        @endif
                    @else
                        <em>Tidak dicantumkan</em>
                    @endif
                </div>
                <div>
                    <strong>Terakhir Diperbarui:</strong> {{ $informasi->updated_at->format('d M Y, H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
