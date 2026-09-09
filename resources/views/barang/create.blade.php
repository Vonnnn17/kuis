@extends('layouts.app')

@section('title', 'Tambah Barang')
@section('page-heading', 'Master Data · Tambah Barang')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Tambah Barang Baru</h1>
            <a href="{{ url('/daftar-barang') }}" class="btn btn-secondary btn-sm shadow-sm">
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
                <h6 class="m-0 font-weight-bold"><i class="fas fa-box mr-1"></i> Form Data Barang</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/simpan-barang') }}" method="POST">
                    @csrf 

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Contoh: Laptop Asus ROG" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-gray-700">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" placeholder="Contoh: 15000000" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-gray-700">Stok Unit <span class="text-danger">*</span></label>
                            <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" placeholder="Contoh: 10" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori_id" class="form-control custom-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/daftar-barang') }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save mr-1"></i> Simpan Barang</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
