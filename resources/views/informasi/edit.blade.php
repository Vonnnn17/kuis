@extends('layouts.app')

@section('title', 'Ubah Informasi')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
            <h2 style="font-size: 1.5rem; font-weight: 800; color: #0f172a;">
                ✏️ Ubah Informasi
            </h2>
            <p style="color: #64748b; font-size: 0.9rem;">
                Perbarui rincian knowledge/informasi yang dipilih.
            </p>
        </div>
        <a href="{{ route('informasi.index') }}" class="btn btn-secondary">
            &larr; Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="display: block;">
            <div style="font-weight: 700; margin-bottom: 0.4rem;">⚠️ Terjadi kesalahan validasi:</div>
            <ul style="margin-left: 1.25rem; font-size: 0.88rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body" style="padding: 2rem;">
            <!-- Wajib: Method PUT dan CSRF -->
            <form action="{{ route('informasi.update', $informasi) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="form-group">
                    <label class="form-label">
                        Judul Informasi <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="judul" 
                        class="form-control @error('judul') is-invalid @enderror" 
                        value="{{ old('judul', $informasi->judul) }}" 
                        required
                    >
                    @error('judul')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Baris Kategori & Status -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <!-- Kategori (Eloquent Relation) -->
                    <div class="form-group">
                        <label class="form-label">
                            Kategori <span class="required">*</span>
                        </label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $informasi->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status (Draft / Published) -->
                    <div class="form-group">
                        <label class="form-label">
                            Status Publikasi <span class="required">*</span>
                        </label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status', $informasi->status) === 'draft' ? 'selected' : '' }}>Draft (Hanya Admin)</option>
                            <option value="published" {{ old('status', $informasi->status) === 'published' ? 'selected' : '' }}>Published (Dapat Diakses Publik)</option>
                        </select>
                        @error('status')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Ringkasan -->
                <div class="form-group">
                    <label class="form-label">
                        Ringkasan Singkat
                    </label>
                    <textarea 
                        name="ringkasan" 
                        class="form-control @error('ringkasan') is-invalid @enderror" 
                        rows="2" 
                        style="min-height: 70px;"
                    >{{ old('ringkasan', $informasi->ringkasan) }}</textarea>
                    <div class="form-text-muted">Ringkasan singkat informasi (maksimal 500 karakter).</div>
                    @error('ringkasan')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Isi Informasi (Konten Lengkap) -->
                <div class="form-group">
                    <label class="form-label">
                        Isi Informasi Lengkap <span class="required">*</span>
                    </label>
                    <textarea 
                        name="isi" 
                        class="form-control @error('isi') is-invalid @enderror" 
                        rows="8" 
                        required
                    >{{ old('isi', $informasi->isi) }}</textarea>
                    @error('isi')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sumber Referensi -->
                <div class="form-group">
                    <label class="form-label">
                        Sumber Referensi / Dokumen
                    </label>
                    <input 
                        type="text" 
                        name="sumber" 
                        class="form-control @error('sumber') is-invalid @enderror" 
                        value="{{ old('sumber', $informasi->sumber) }}"
                    >
                    @error('sumber')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Update -->
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 2rem; padding-top: 1.25rem; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('informasi.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        🔄 Perbarui Informasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
