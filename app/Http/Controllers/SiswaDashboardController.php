<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\Peminjaman;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        // Load borrowing history
        $riwayatPeminjaman = [];
        if ($anggota) {
            $riwayatPeminjaman = Peminjaman::with('buku')
                                ->where('anggota_id', $anggota->id)
                                ->orderBy('tanggal_pinjam', 'desc')
                                ->get();
        }

        // Load available books (stok > 0)
        $bukuTersedia = Buku::where('stok', '>', 0)->orderBy('judul')->get();

        return view('siswa.dashboard', compact('user', 'anggota', 'riwayatPeminjaman', 'bukuTersedia'));
    }

    /**
     * Siswa meminjam buku
     */
    public function pinjam(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $user = Auth::user();
        $anggota = $user->anggota;

        if (!$anggota) {
            return back()->withErrors(['Profil anggota belum terdaftar. Hubungi admin.']);
        }

        $buku = Buku::find($request->buku_id);

        if (!$buku || $buku->stok <= 0) {
            return back()->withErrors(['Stok buku sedang tidak tersedia.']);
        }

        // Check if student already borrows this book (prevent duplicate active loan)
        $sudahPinjam = Peminjaman::where('anggota_id', $anggota->id)
                        ->where('buku_id', $buku->id)
                        ->where('status', 'dipinjam')
                        ->exists();

        if ($sudahPinjam) {
            return back()->withErrors(['Kamu sudah meminjam buku ini dan belum mengembalikannya.']);
        }

        // Create peminjaman record
        Peminjaman::create([
            'buku_id' => $buku->id,
            'anggota_id' => $anggota->id,
            'tanggal_pinjam' => now()->toDateString(),
            'status' => 'dipinjam',
        ]);

        // Decrease stock
        $buku->stok -= 1;
        $buku->save();

        return back()->with('success', 'Berhasil meminjam buku "' . $buku->judul . '"!');
    }

    /**
     * Siswa mengembalikan buku
     */
    public function kembalikan($id)
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        if (!$anggota) {
            return back()->withErrors(['Profil anggota belum terdaftar.']);
        }

        $peminjaman = Peminjaman::where('id', $id)
                        ->where('anggota_id', $anggota->id)
                        ->where('status', 'dipinjam')
                        ->first();

        if (!$peminjaman) {
            return back()->withErrors(['Data peminjaman tidak ditemukan.']);
        }

        // Update peminjaman status
        $peminjaman->status = 'dikembalikan';
        $peminjaman->tanggal_kembali = now()->toDateString();
        $peminjaman->save();

        // Restore stock
        $buku = Buku::find($peminjaman->buku_id);
        if ($buku) {
            $buku->stok += 1;
            $buku->save();
        }

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }
}
