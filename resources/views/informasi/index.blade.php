@extends('layouts.app')

@section('title', 'Daftar Informasi')

@section('content')
<div style="max-width: 1100px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 20px; flex-wrap: wrap;">
        <div>
            <h2 style="margin:0; font-size: 2rem; color: #0f172a;">Daftar Informasi</h2>
            <p style="margin: 6px 0 0; color: #64748b;">Kelola artikel dan pengetahuan sistem.</p>
        </div>
        <a href="{{ route('informasi.create') }}" class="btn btn-primary">+ Tambah Informasi</a>
    </div>

    <div class="card" style="margin-bottom: 22px;">
        <div class="card-body" style="padding: 18px 20px;">
            <form action="{{ route('informasi.index') }}" method="GET" style="display: grid; grid-template-columns: 1.5fr 1fr 1fr auto; gap: 12px;">
                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Cari judul / ringkasan / isi...">
                <select name="kategori_id" class="form-select">
                    <option value="">Semua kategori</option>
                    @foreach(App\Models\Kategori::all() as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                <select name="status" class="form-select">
                    <option value="">Semua status</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                <button type="submit" class="btn btn-secondary">Filter</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="padding: 0;">
            <div style="overflow-x:auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #f8fafc;">
                        <tr>
                            <th style="padding: 14px 16px; text-align: left;">Judul</th>
                            <th style="padding: 14px 16px; text-align: left;">Kategori</th>
                            <th style="padding: 14px 16px; text-align: left;">Status</th>
                            <th style="padding: 14px 16px; text-align: left;">Sumber</th>
                            <th style="padding: 14px 16px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($informasis as $item)
                            <tr style="border-top: 1px solid #e2e8f0;">
                                <td style="padding: 14px 16px;">
                                    <strong>{{ $item->judul }}</strong><br>
                                    <small style="color:#64748b;">{{ Str::limit($item->ringkasan ?? $item->isi, 70) }}</small>
                                </td>
                                <td style="padding: 14px 16px;">{{ $item->kategori->nama ?? '-' }}</td>
                                <td style="padding: 14px 16px;">
                                    @if($item->status == 'published')
                                        <span class="badge badge-published">Published</span>
                                    @else
                                        <span class="badge badge-draft">Draft</span>
                                    @endif
                                </td>
                                <td style="padding: 14px 16px;">{{ $item->sumber ?? '-' }}</td>
                                <td style="padding: 14px 16px; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 8px;">
                                        <a href="{{ route('informasi.show', $item) }}" class="btn btn-secondary" style="padding: 6px 10px;">Lihat</a>
                                        <a href="{{ route('informasi.edit', $item) }}" class="btn btn-warning" style="padding: 6px 10px;">Ubah</a>
                                        <form action="{{ route('informasi.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="padding: 6px 10px;">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 30px; text-align: center; color: #64748b;">
                                    Belum ada informasi yang dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="margin-top: 18px;">
        {{ $informasis->links() }}
    </div>
</div>
@endsection
