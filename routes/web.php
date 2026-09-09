<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PublicController;



Route::get('/', [UtamaController::class, 'index'])->name('dashboard');


Route::get('/knowledge', [PublicController::class, 'index'])->name('public.index');
Route::get('/knowledge/{informasi}', [PublicController::class, 'show'])->name('public.show');


Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/informasi/tambah', [InformasiController::class, 'create'])->name('informasi.create');
Route::post('/informasi', [InformasiController::class, 'store'])->name('informasi.store');
Route::get('/informasi/{informasi}', [InformasiController::class, 'show'])->name('informasi.show');

Route::get('/informasi/{informasi}/ubah', [InformasiController::class, 'edit'])->name('informasi.edit');
Route::put('/informasi/{informasi}', [InformasiController::class, 'update'])->name('informasi.update');
Route::delete('/informasi/{informasi}', [InformasiController::class, 'destroy'])->name('informasi.destroy');


Route::get('/daftar-kategori', [KategoriController::class, 'tampil'])->name('kategori.index');
Route::get('/tambah-kategori', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/simpan-kategori', [KategoriController::class, 'simpan'])->name('kategori.simpan');
Route::get('/ubah-kategori/{kategori}', [KategoriController::class, 'ubah'])->name('kategori.ubah');
Route::put('/update-kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/hapus-kategori/{kategori}', [KategoriController::class, 'hapus'])->name('kategori.hapus');
Route::get('/daftar-barang', [BarangController::class, 'tampil'])->name('barang.index');
Route::get('/tambah-barang', [BarangController::class, 'create'])->name('barang.create');
Route::post('/simpan-barang', [BarangController::class, 'simpan'])->name('barang.simpan');
Route::get('/ubah-barang/{barang}', [BarangController::class, 'ubah'])->name('barang.ubah');
Route::put('/update-barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/hapus-barang/{barang}', [BarangController::class, 'hapus'])->name('barang.hapus');

Route::get('/horeee-saya-bisa', function (){
    return 'Ini adalah halaman saya';
});