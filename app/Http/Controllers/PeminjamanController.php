<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with('buku','anggota')->orderBy('created_at','desc')->get();
        $bukus = Buku::all();
        $anggotas = Anggota::all();
        $dipinjam = Peminjaman::where('status','dipinjam')->count();
        $dikembalikan = Peminjaman::where('status','dikembalikan')->count();

        return view('index', compact('data','bukus','anggotas','dipinjam','dikembalikan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'anggota_id' => 'required',
            'tanggal_pinjam' => 'required'
        ]);

        $buku = Buku::find($request->buku_id);
        if ($buku && $buku->stok > 0) {
            $buku->stok -= 1;
            $buku->save();
            
            Peminjaman::create($request->all());
            return back()->with('success', 'Transaksi peminjaman sukses dicatat & stok buku berkurang!');
        }

        return back()->withErrors(['Buku / inventori tidak tersedia karena stok sedang kosong.']);
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::find($id);
        if ($peminjaman && $peminjaman->status === 'dipinjam') {
            $buku = Buku::find($peminjaman->buku_id);
            if ($buku) {
                $buku->stok += 1;
                $buku->save();
            }
            $peminjaman->status = 'dikembalikan';
            $peminjaman->tanggal_kembali = now()->toDateString();
            $peminjaman->save();
            return back()->with('success', 'Buku berhasil dikembalikan dan stok telah bertambah kembali!');
        }

        return back()->withErrors(['Data peminjaman tidak ditemukan atau sudah dikembalikan.']);
    }
}
