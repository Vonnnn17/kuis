<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Kategori;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        // Hanya yang berstatus 'published'
        $query = Informasi::with('kategori')->where('status', 'published');

        // Pencarian (Bonus)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        // Filter Kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $informasis = $query->latest()->paginate(6)->withQueryString();
        $kategoris = Kategori::withCount(['informasis' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        return view('public.index', compact('informasis', 'kategoris'));
    }

   
    public function show(Informasi $informasi)
    {
        
        if ($informasi->status !== 'published') {
            abort(404, 'Informasi tidak ditemukan atau belum dipublikasikan.');
        }

        $informasi->load('kategori');

        $terkait = Informasi::where('kategori_id', $informasi->kategori_id)
            ->where('status', 'published')
            ->where('id', '!=', $informasi->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.show', compact('informasi', 'terkait'));
    }
}
