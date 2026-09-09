@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page-heading', 'Master Data · Tambah Kategori')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Tambah Kategori Baru</h1>
            <a href="{{ url('/daftar-kategori') }}" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-triangle mr-1"></i> Terjadi kesalahan validasi:</strong>
                <ul class="mb-0 mt-1 pl-4 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-folder-plus mr-1"></i> Form Kategori</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/simpan-kategori') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Contoh: Pemrograman Web, AI, Kesehatan" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Deskripsi singkat ruang lingkup kategori...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/daftar-kategori') }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save mr-1"></i> Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection