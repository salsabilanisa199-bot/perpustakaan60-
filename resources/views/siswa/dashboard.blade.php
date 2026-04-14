<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa — Perpusku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --glass-bg: rgba(255, 255, 255, 0.72);
            --glass-border: rgba(255, 255, 255, 0.45);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            min-height: 100vh;
            padding-bottom: 3rem;
            color: #1e1b4b;
        }

        /* ===== NAVBAR ===== */
        .top-nav {
            background: rgba(15, 12, 41, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(99, 102, 241, 0.3);
            padding: 0.85rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .top-nav .brand {
            color: #fff;
            font-weight: 700;
            font-size: 1.25rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .top-nav .brand i {
            font-size: 1.5rem;
            color: var(--accent);
        }
        .nav-pills-custom .nav-link {
            color: rgba(255,255,255,0.6);
            font-weight: 500;
            font-size: 0.9rem;
            border-radius: 50px;
            padding: 0.45rem 1.1rem;
            transition: all 0.3s;
        }
        .nav-pills-custom .nav-link:hover,
        .nav-pills-custom .nav-link.active {
            color: #fff;
            background: var(--primary);
        }
        .btn-logout {
            background: rgba(239,68,68,0.15);
            color: #fca5a5;
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 0.4rem 1.2rem;
            transition: all 0.3s;
        }
        .btn-logout:hover {
            background: var(--danger);
            color: #fff;
        }

        /* ===== GLASS CARD ===== */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 40px rgba(0,0,0,0.12);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 48px rgba(0,0,0,0.18);
        }

        /* ===== TAB CONTENT ===== */
        .tab-content > .tab-pane { animation: fadeUp 0.4s ease; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== PROFILE ===== */
        .profile-avatar {
            width: 90px; height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex; align-items: center; justify-content: center;
            font-size: 2.5rem; color: #fff;
            box-shadow: 0 6px 20px rgba(99,102,241,0.35);
        }
        .info-label { font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; }
        .info-value { font-weight: 500; color: #1e293b; }

        /* ===== STATS ===== */
        .stat-card {
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            top: -20px; right: -20px;
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
        }
        .stat-card .stat-icon { font-size: 2rem; opacity: 0.85; }
        .stat-card .stat-num { font-size: 1.75rem; font-weight: 700; }
        .stat-card .stat-label { font-size: 0.8rem; opacity: 0.85; }
        .bg-grad-primary { background: linear-gradient(135deg, #6366f1, #818cf8); }
        .bg-grad-success { background: linear-gradient(135deg, #10b981, #34d399); }
        .bg-grad-warning { background: linear-gradient(135deg, #f59e0b, #fbbf24); }

        /* ===== BOOK CATALOG GRID ===== */
        .book-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 1.5rem;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .book-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 24px rgba(99,102,241,0.15);
            transform: translateY(-3px);
        }
        .book-card .book-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: #fff;
            margin-bottom: 1rem;
        }
        .book-card .book-title {
            font-weight: 600; font-size: 1rem; color: #1e293b;
            margin-bottom: 0.3rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .book-card .book-author {
            font-size: 0.82rem; color: #64748b; margin-bottom: 0.85rem;
        }
        .book-meta {
            display: flex; gap: 0.75rem; font-size: 0.78rem; color: #94a3b8; margin-bottom: 1rem;
        }
        .book-meta i { color: var(--primary); }
        .btn-pinjam {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.55rem 1rem;
            transition: all 0.25s;
            margin-top: auto;
        }
        .btn-pinjam:hover {
            background: linear-gradient(135deg, var(--primary-dark), #4338ca);
            color: #fff;
            transform: scale(1.03);
            box-shadow: 0 4px 16px rgba(99,102,241,0.4);
        }
        .btn-pinjam:disabled {
            background: #cbd5e1;
            box-shadow: none;
            transform: none;
            cursor: not-allowed;
        }

        /* ===== HISTORY TABLE ===== */
        .history-table {
            border-collapse: separate;
            border-spacing: 0;
        }
        .history-table thead th {
            background: #f1f5f9;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            font-weight: 600;
            border: none;
            padding: 0.85rem 1rem;
        }
        .history-table thead th:first-child { border-radius: 12px 0 0 12px; }
        .history-table thead th:last-child { border-radius: 0 12px 12px 0; }
        .history-table tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }
        .badge-status {
            padding: 0.35rem 0.85rem;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
        }
        .badge-dipinjam { background: rgba(245,158,11,0.12); color: #d97706; }
        .badge-dikembalikan { background: rgba(16,185,129,0.12); color: #059669; }

        .btn-kembalikan {
            background: linear-gradient(135deg, var(--success), #059669);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.4rem 0.9rem;
            transition: all 0.25s;
        }
        .btn-kembalikan:hover {
            color: #fff;
            box-shadow: 0 3px 12px rgba(16,185,129,0.4);
            transform: scale(1.04);
        }

        /* ===== SEARCH ===== */
        .search-input {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.65rem 1rem 0.65rem 2.8rem;
            font-size: 0.9rem;
            transition: border-color 0.2s;
            width: 100%;
            max-width: 320px;
        }
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }
        .search-wrapper {
            position: relative;
        }
        .search-wrapper i {
            position: absolute;
            left: 1rem; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        /* ===== ALERTS ===== */
        .alert-float {
            position: fixed;
            top: 90px; right: 20px;
            z-index: 9999;
            min-width: 320px;
            border-radius: 14px;
            border: none;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            animation: slideInRight 0.5s ease;
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(60px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* ===== SECTION HEADER ===== */
        .section-header {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.5rem;
        }
        .section-header .icon-box {
            width: 40px; height: 40px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: #fff;
        }
        .section-header h5 {
            font-weight: 700; margin: 0; font-size: 1.1rem; color: #1e293b;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #94a3b8;
        }
        .empty-state i { font-size: 3rem; margin-bottom: 0.75rem; display: block; }
        .empty-state p { font-size: 0.95rem; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .book-card { padding: 1rem; }
            .search-input { max-width: 100%; }
        }
    </style>
</head>
<body>

{{-- ===== FLOATING ALERTS ===== --}}
@if(session('success'))
<div class="alert alert-success alert-float d-flex align-items-center" id="alertSuccess">
    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
    <span>{{ session('success') }}</span>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif
@if($errors->any())
<div class="alert alert-danger alert-float d-flex align-items-center" id="alertError">
    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
    <span>{{ $errors->first() }}</span>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- ===== NAVBAR ===== --}}
<nav class="top-nav">
    <div class="container d-flex align-items-center justify-content-between">
        <a class="brand" href="#">
            <i class="bi bi-book-half"></i>
            Perpusku
        </a>
        <ul class="nav nav-pills-custom d-none d-md-flex gap-1">
            <li class="nav-item"><a class="nav-link active" href="#beranda" data-bs-toggle="tab"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="#katalog" data-bs-toggle="tab"><i class="bi bi-grid me-1"></i>Katalog Buku</a></li>
            <li class="nav-item"><a class="nav-link" href="#riwayat" data-bs-toggle="tab"><i class="bi bi-clock-history me-1"></i>Riwayat</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white d-none d-sm-inline" style="font-size:0.9rem;">
                <i class="bi bi-person-circle me-1"></i>{{ $anggota->nama ?? $user->username }}
            </span>
            <form action="{{ url('/logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
            </form>
        </div>
    </div>
</nav>

{{-- ===== MOBILE TAB BAR ===== --}}
<div class="d-md-none" style="background:rgba(15,12,41,0.9);backdrop-filter:blur(10px);border-bottom:1px solid rgba(99,102,241,0.2);">
    <div class="container">
        <ul class="nav nav-pills-custom justify-content-center gap-1 py-2">
            <li class="nav-item"><a class="nav-link active" href="#beranda" data-bs-toggle="tab"><i class="bi bi-house-door"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="#katalog" data-bs-toggle="tab"><i class="bi bi-grid"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="#riwayat" data-bs-toggle="tab"><i class="bi bi-clock-history"></i></a></li>
        </ul>
    </div>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<div class="container mt-4">
    <div class="tab-content">

        {{-- ===== TAB: BERANDA ===== --}}
        <div class="tab-pane fade show active" id="beranda">
            {{-- Stats Row --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card bg-grad-primary">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-num">{{ collect($riwayatPeminjaman)->count() }}</div>
                                <div class="stat-label">Total Peminjaman</div>
                            </div>
                            <i class="bi bi-journal-bookmark stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-grad-warning">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-num">{{ collect($riwayatPeminjaman)->where('status', 'dipinjam')->count() }}</div>
                                <div class="stat-label">Sedang Dipinjam</div>
                            </div>
                            <i class="bi bi-hourglass-split stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-grad-success">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-num">{{ collect($riwayatPeminjaman)->where('status', 'dikembalikan')->count() }}</div>
                                <div class="stat-label">Sudah Dikembalikan</div>
                            </div>
                            <i class="bi bi-check2-all stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                {{-- Profile Card --}}
                <div class="col-lg-4">
                    <div class="glass-card p-4 h-100">
                        <div class="text-center mb-3">
                            <div class="profile-avatar mx-auto mb-3">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <h5 class="fw-bold mb-1">{{ $anggota->nama ?? 'Nama Belum Diatur' }}</h5>
                            <span class="badge" style="background:rgba(99,102,241,0.12);color:var(--primary);font-weight:600;border-radius:50px;padding:0.3rem 1rem;">
                                {{ $anggota->kelas ?? 'Kelas -' }}
                            </span>
                        </div>
                        <hr style="border-color:#e2e8f0;">
                        <div class="mt-3">
                            <div class="mb-3">
                                <div class="info-label">Alamat</div>
                                <div class="info-value"><i class="bi bi-geo-alt me-1 text-muted"></i>{{ $anggota->alamat ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="info-label">No. Telepon</div>
                                <div class="info-value"><i class="bi bi-telephone me-1 text-muted"></i>{{ $anggota->no_telp ?? '-' }}</div>
                            </div>
                            <div>
                                <div class="info-label">ID Anggota</div>
                                <div class="info-value"><i class="bi bi-fingerprint me-1 text-muted"></i>#{{ $anggota->id ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Active Loans --}}
                <div class="col-lg-8">
                    <div class="glass-card p-4 h-100">
                        <div class="section-header">
                            <div class="icon-box" style="background:linear-gradient(135deg,#f59e0b,#fbbf24);">
                                <i class="bi bi-bookmark-star"></i>
                            </div>
                            <h5>Buku yang Sedang Dipinjam</h5>
                        </div>

                        @php $aktif = collect($riwayatPeminjaman)->where('status', 'dipinjam'); @endphp

                        @if($aktif->count() > 0)
                        <div class="table-responsive">
                            <table class="table history-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Lama</th>
                                        <th style="text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aktif as $pj)
                                    <tr>
                                        <td class="fw-medium">{{ $pj->buku->judul ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pj->tanggal_pinjam)->format('d M Y') }}</td>
                                        <td>
                                            <span class="text-muted">{{ \Carbon\Carbon::parse($pj->tanggal_pinjam)->diffInDays(now()) }} hari</span>
                                        </td>
                                        <td style="text-align:center;">
                                            <form action="{{ route('siswa.kembalikan', $pj->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                                @csrf
                                                <button type="submit" class="btn-kembalikan">
                                                    <i class="bi bi-arrow-return-left me-1"></i>Kembalikan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Tidak ada buku yang sedang dipinjam.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== TAB: KATALOG BUKU ===== --}}
        <div class="tab-pane fade" id="katalog">
            <div class="glass-card p-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div class="section-header mb-0">
                        <div class="icon-box" style="background:linear-gradient(135deg,var(--primary),var(--accent));">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </div>
                        <h5>Katalog Buku Tersedia</h5>
                    </div>
                    <div class="search-wrapper">
                        <i class="bi bi-search"></i>
                        <input type="text" class="search-input" id="searchBuku" placeholder="Cari judul atau pengarang..." autocomplete="off">
                    </div>
                </div>

                @if($bukuTersedia->count() > 0)
                <div class="row g-3" id="bookGrid">
                    @php
                        $colors = [
                            'linear-gradient(135deg,#6366f1,#818cf8)',
                            'linear-gradient(135deg,#06b6d4,#22d3ee)',
                            'linear-gradient(135deg,#10b981,#34d399)',
                            'linear-gradient(135deg,#f59e0b,#fbbf24)',
                            'linear-gradient(135deg,#ec4899,#f472b6)',
                            'linear-gradient(135deg,#8b5cf6,#a78bfa)',
                        ];
                        $icons = ['bi-book','bi-journal-text','bi-bookmarks','bi-book-half','bi-journal-bookmark','bi-book-fill'];
                    @endphp
                    @foreach($bukuTersedia as $index => $bk)
                    <div class="col-sm-6 col-lg-4 col-xl-3 book-item">
                        <div class="book-card">
                            <div class="book-icon" style="background:{{ $colors[$index % count($colors)] }}">
                                <i class="bi {{ $icons[$index % count($icons)] }}"></i>
                            </div>
                            <div class="book-title">{{ $bk->judul }}</div>
                            <div class="book-author"><i class="bi bi-pen me-1"></i>{{ $bk->pengarang ?? 'Tidak diketahui' }}</div>
                            <div class="book-meta">
                                @if($bk->penerbit)
                                <span><i class="bi bi-building me-1"></i>{{ $bk->penerbit }}</span>
                                @endif
                                @if($bk->tahun_terbit)
                                <span><i class="bi bi-calendar3 me-1"></i>{{ $bk->tahun_terbit }}</span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2" style="font-size:0.82rem;">
                                <span class="text-muted">Stok tersedia</span>
                                <span class="fw-bold" style="color:var(--success);">{{ $bk->stok }}</span>
                            </div>
                            <form action="{{ route('siswa.pinjam') }}" method="POST" onsubmit="return confirm('Pinjam buku &quot;{{ addslashes($bk->judul) }}&quot;?')">
                                @csrf
                                <input type="hidden" name="buku_id" value="{{ $bk->id }}">
                                <button type="submit" class="btn-pinjam w-100">
                                    <i class="bi bi-plus-circle me-1"></i>Pinjam Buku
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-emoji-frown"></i>
                    <p>Belum ada buku yang tersedia saat ini.</p>
                </div>
                @endif
            </div>
        </div>

        {{-- ===== TAB: RIWAYAT ===== --}}
        <div class="tab-pane fade" id="riwayat">
            <div class="glass-card p-4">
                <div class="section-header">
                    <div class="icon-box" style="background:linear-gradient(135deg,#8b5cf6,#a78bfa);">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h5>Seluruh Riwayat Peminjaman</h5>
                </div>

                @if(count($riwayatPeminjaman) > 0)
                <div class="table-responsive">
                    <table class="table history-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatPeminjaman as $i => $rp)
                            <tr>
                                <td class="text-muted">{{ $i + 1 }}</td>
                                <td class="fw-medium">{{ $rp->buku->judul ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($rp->tanggal_pinjam)->format('d M Y') }}</td>
                                <td>{{ $rp->tanggal_kembali ? \Carbon\Carbon::parse($rp->tanggal_kembali)->format('d M Y') : '-' }}</td>
                                <td>
                                    @if($rp->status == 'dikembalikan')
                                        <span class="badge-status badge-dikembalikan"><i class="bi bi-check-circle me-1"></i>Dikembalikan</span>
                                    @else
                                        <span class="badge-status badge-dipinjam"><i class="bi bi-hourglass-split me-1"></i>Dipinjam</span>
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    @if($rp->status == 'dipinjam')
                                    <form action="{{ route('siswa.kembalikan', $rp->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                        @csrf
                                        <button type="submit" class="btn-kembalikan">
                                            <i class="bi bi-arrow-return-left me-1"></i>Kembalikan
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-muted" style="font-size:0.82rem;">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-journal-x"></i>
                    <p>Belum ada riwayat peminjaman saat ini.</p>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-dismiss alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert-float').forEach(el => {
            bootstrap.Alert.getOrCreateInstance(el).close();
        });
    }, 5000);

    // Sync desktop & mobile tabs
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(e) {
            const target = e.target.getAttribute('href');
            document.querySelectorAll('[data-bs-toggle="tab"]').forEach(t => {
                t.classList.toggle('active', t.getAttribute('href') === target);
            });
        });
    });

    // Book search filter
    const searchInput = document.getElementById('searchBuku');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.book-item').forEach(item => {
                const title = item.querySelector('.book-title')?.textContent.toLowerCase() || '';
                const author = item.querySelector('.book-author')?.textContent.toLowerCase() || '';
                item.style.display = (title.includes(query) || author.includes(query)) ? '' : 'none';
            });
        });
    }
</script>
</body>
</html>
