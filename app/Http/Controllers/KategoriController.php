<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
// use DB;

class KategoriController extends Controller
{
    public function tampil()
    {
        $kategoris = Kategori::all();
        return view('kategori.daftar', ['kategoris' => $kategoris]);
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function simpan(Request $request){
        $request->validate([
            'nama' => 'required|string|max:50|regex:/^[^0-9]*$/',
            'deskripsi' => 'nullable|string',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.max' => 'Nama kategori maksimal 50 karakter.',
            'nama.regex' => 'Nama kategori tidak boleh mengandung angka.',
        ]);

        $kategori = new Kategori;
        $kategori->nama = $request->get('nama');
        $kategori->deskripsi = $request->get('deskripsi');
        $kategori->save();

        return redirect('/daftar-kategori')->with('sukses', 'Kategori berhasil ditambahkan!');
    }

    public function hapus(Kategori $kategori) {
        $kategori->delete();
        return redirect('/daftar-kategori')->with('sukses', 'Kategori berhasil dihapus!');
    }

    public function ubah(Kategori $kategori) {
        return view('kategori.ubah', ['kategori' => $kategori]);
    }

     public function update(Request $request, Kategori $kategori) {
        $request->validate([
            'nama' => 'required|string|max:50|regex:/^[^0-9]*$/',
            'deskripsi' => 'nullable|string',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.max' => 'Nama kategori maksimal 50 karakter.',
            'nama.regex' => 'Nama kategori tidak boleh mengandung angka.',
        ]);

        $kategori->nama = $request->get('nama');
        $kategori->deskripsi = $request->get('deskripsi');
        $kategori->save();
        
        return redirect('/daftar-kategori')->with('sukses', 'Kategori berhasil diperbarui!');
    }

}
