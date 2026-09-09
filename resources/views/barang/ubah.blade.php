@extends('layouts.app')

@section('title', 'Ubah Barang')
@section('page-heading', 'Master Data · Ubah Barang')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Ubah Data Barang</h1>
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
            <div class="card-header py-3 bg-warning text-dark">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-pencil-alt mr-1"></i> Edit Data Barang #{{ $barang->id }}</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('barang.update', $barang) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $barang->nama) }}" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-gray-700">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga', $barang->harga) }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-gray-700">Stok Unit <span class="text-danger">*</span></label>
                            <input type="number" name="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori_id" class="form-control custom-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/daftar-barang') }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-warning px-4"><i class="fas fa-check mr-1"></i> Perbarui Barang</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
