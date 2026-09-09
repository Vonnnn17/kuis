<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function tampil()
    {
        $barangs = Barang::with('kategori')->get();
        return view('barang.daftar', ['barangs' => $barangs]);
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barang.create', ['kategoris' => $kategoris]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ], [
            'nama.required' => 'Nama barang wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka bulat.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
        ]);

        $barang = new Barang;
        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->kategori_id = $request->kategori_id;
        $barang->save();

        return redirect('/daftar-barang')->with('sukses', 'Barang berhasil ditambahkan!');
    }

    public function ubah(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('barang.ubah', ['barang' => $barang, 'kategoris' => $kategoris]);
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ], [
            'nama.required' => 'Nama barang wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka bulat.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
        ]);

        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->kategori_id = $request->kategori_id;
        $barang->save();

        return redirect('/daftar-barang')->with('sukses', 'Barang berhasil diperbarui!');
    }

    public function hapus(Barang $barang)
    {
        $barang->delete();
        return redirect('/daftar-barang')->with('sukses', 'Barang berhasil dihapus!');
    }
}
