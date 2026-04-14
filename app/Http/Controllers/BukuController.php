<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $data = Buku::latest()->get();
        return view('buku.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
        ]);

        Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'stok' => $request->stok,
        ]);

        return back()->with('success', 'Data buku baru berhasil ditambahkan ke katalog!');
    }
}
