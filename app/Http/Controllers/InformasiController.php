<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Kategori;

class InformasiController extends Controller
{
    /**
     * Tampilkan daftar informasi (Admin) dengan Search, Filter & Pagination
     */
    public function index(Request $request)
    {
        $query = Informasi::with('kategori');

        // Fitur Pencarian (Bonus)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%")
                  ->orWhere('sumber', 'like', "%{$search}%");
            });
        }

        // Filter status (draft / published)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $informasis = $query->latest()->paginate(8)->withQueryString();
        $kategoris = Kategori::all();

        return view('informasi.index', compact('informasis', 'kategoris'));
    }

    /**
     * Form tambah informasi
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('informasi.create', compact('kategoris'));
    }

    /**
     * Simpan informasi baru (Validation & CSRF)
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'kategori_id' => 'required|exists:kategoris,id',
            'ringkasan' => 'nullable|string|max:500',
            'isi' => 'required|string',
            'sumber' => 'nullable|string|max:300',
            'status' => 'required|in:draft,published',
        ], [
            'judul.required' => 'Judul informasi wajib diisi.',
            'judul.max' => 'Judul tidak boleh melebihi 200 karakter.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'isi.required' => 'Isi informasi wajib diisi.',
            'status.required' => 'Status wajib ditentukan (draft atau published).',
            'status.in' => 'Status hanya boleh draft atau published.',
        ]);

        Informasi::create($request->only([
            'judul',
            'kategori_id',
            'ringkasan',
            'isi',
            'sumber',
            'status',
        ]));

        return redirect()->route('informasi.index')->with('sukses', 'Informasi berhasil ditambahkan!');
    }

    /**
     * Detail informasi (Admin)
     */
    public function show(Informasi $informasi)
    {
        $informasi->load('kategori');
        return view('informasi.show', compact('informasi'));
    }

    /**
     * Form edit informasi
     */
    public function edit(Informasi $informasi)
    {
        $kategoris = Kategori::all();
        return view('informasi.edit', compact('informasi', 'kategoris'));
    }

    /**
     * Perbarui informasi (PUT Method, Validation)
     */
    public function update(Request $request, Informasi $informasi)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'kategori_id' => 'required|exists:kategoris,id',
            'ringkasan' => 'nullable|string|max:500',
            'isi' => 'required|string',
            'sumber' => 'nullable|string|max:300',
            'status' => 'required|in:draft,published',
        ], [
            'judul.required' => 'Judul informasi wajib diisi.',
            'judul.max' => 'Judul tidak boleh melebihi 200 karakter.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'isi.required' => 'Isi informasi wajib diisi.',
            'status.required' => 'Status wajib ditentukan (draft atau published).',
            'status.in' => 'Status hanya boleh draft atau published.',
        ]);

        $informasi->update($request->only([
            'judul',
            'kategori_id',
            'ringkasan',
            'isi',
            'sumber',
            'status',
        ]));

        return redirect()->route('informasi.index')->with('sukses', 'Informasi berhasil diperbarui!');
    }

    /**
     * Hapus informasi (DELETE Method)
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();
        return redirect()->route('informasi.index')->with('sukses', 'Informasi berhasil dihapus!');
    }
}
