<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Informasi;

class UtamaController extends Controller
{
  
    public function index()
    {
        $totalKategori = Kategori::count();
        $totalInformasi = Informasi::count();
        $totalPublished = Informasi::where('status', 'published')->count();
        $totalDraft = Informasi::where('status', 'draft')->count();

        $latestInformasi = Informasi::with('kategori')->latest()->take(5)->get();
        $kategoriList = Kategori::withCount('informasis')->get();

        return view('dashboard', compact(
            'totalKategori',
            'totalInformasi',
            'totalPublished',
            'totalDraft',
            'latestInformasi',
            'kategoriList'
        ));
    }
}
