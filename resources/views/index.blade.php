<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Perpustakaan</title>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: #ffffff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 20px 25px;
            font-size: 1.25rem;
            font-weight: 700;
            color: #4f46e5;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #f3f4f6;
        }

        .sidebar-menu {
            padding: 15px 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-item {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .menu-item i {
            margin-right: 15px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .menu-item:hover, .menu-item.active {
            color: #4f46e5;
            background-color: #f5f3ff;
            border-right: 3px solid #4f46e5;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #f3f4f6;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Topbar Styling */
        .topbar {
            background: #ffffff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            z-index: 999;
        }

        .search-bar {
            background: #f3f4f6;
            border-radius: 8px;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            width: 300px;
        }

        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            margin-left: 10px;
            width: 100%;
            font-size: 0.9rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Dashboard Content */
        .content-area {
            padding: 30px;
            flex-grow: 1;
        }

        /* Stats Cards */
        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .stat-info h5 {
            margin: 0;
            color: #6b7280;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stat-info h3 {
            margin: 5px 0 0;
            color: #1f2937;
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Content Cards */
        .custom-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: none;
            margin-bottom: 25px;
        }

        .card-header-styled {
            padding: 20px 25px;
            border-bottom: 1px solid #f3f4f6;
            background: transparent;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-header-styled h5 {
            margin: 0;
            font-weight: 600;
            color: #1f2937;
            font-size: 1.1rem;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #d1d5db;
            font-size: 0.95rem;
            box-shadow: none;
        }

        .form-control:focus, .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn-primary-custom {
            background-color: #4f46e5;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            color: white;
            transition: all 0.2s;
        }

        .btn-primary-custom:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
            color: white;
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table > :not(caption) > * > * {
            padding: 15px 25px;
            border-bottom-color: #f3f4f6;
        }

        .table th {
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: 600;
            color: #6b7280;
            background-color: #f9fafb;
            border-bottom: none;
        }

        .table td {
            font-size: 0.95rem;
            color: #374151;
            vertical-align: middle;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .badge-active {
            background-color: #def7ec;
            color: #03543f;
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-book-open text-primary me-2"></i> PerpusAdmin
        </div>
        <div class="sidebar-menu">
            <a href="/peminjaman" class="menu-item active">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="/peminjaman" class="menu-item">
                <i class="fa-solid fa-hand-holding-hand"></i> Peminjaman
            </a>
            <a href="/anggota" class="menu-item">
                <i class="fa-solid fa-users"></i> Anggota
            </a>
            <a href="/buku" class="menu-item">
                <i class="fa-solid fa-book"></i> Katalog Buku
            </a>
        </div>
        <div class="sidebar-footer">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-light w-100 text-start text-danger border-0" style="font-weight: 500;">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-light d-lg-none me-3 border-0" id="sidebarToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="search-bar d-none d-md-flex">
                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                    <input type="text" placeholder="Cari data sirkulasi...">
                </div>
            </div>
            <div class="user-profile">
                <button class="btn btn-light position-relative rounded-circle p-2 d-none d-sm-block border-0">
                    <i class="fa-regular fa-bell text-muted"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </button>
                <div class="d-none d-md-block text-end">
                    <div style="font-size: 0.9rem; font-weight: 600; color: #1f2937;">{{ Auth::user()->name ?? 'Administrator' }}</div>
                    <div style="font-size: 0.8rem; color: #6b7280;">Admin Perpus</div>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=4f46e5&color=fff" alt="User Avatar">
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="content-area">
            
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h3 class="mb-1 fw-bold" style="color: #1f2937;">Dashboard Admin</h3>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">Overview sirkulasi peminjaman dan data perpustakaan</p>
                </div>
                <div>
                    <button class="btn btn-light border bg-white d-none d-sm-inline-block me-2 shadow-sm"><i class="fa-solid fa-download me-2"></i>Laporan</button>
                    <button class="btn btn-primary-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="fa-solid fa-plus me-2"></i>Peminjaman Baru
                    </button>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #e0e7ff; color: #4f46e5;">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <div class="stat-info">
                            <h5>Total Transaksi</h5>
                            <h3>{{ count($data ?? []) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #dcfce7; color: #16a34a;">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h5>Jumlah Anggota</h5>
                            <h3>{{ count($anggotas ?? []) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #fef3c7; color: #d97706;">
                            <i class="fa-solid fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h5>Katalog Buku</h5>
                            <h3>{{ count($bukus ?? []) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #fee2e2; color: #dc2626;">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <div class="stat-info">
                            <h5>Menunggu Kembali</h5>
                            <h3>{{ $dipinjam ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm bg-white" style="border-left: 4px solid #10b981 !important;" role="alert">
                    <i class="fa-solid fa-check-circle text-success me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm bg-white" style="border-left: 4px solid #ef4444 !important;" role="alert">
                    <ul class="mb-0 ps-3 text-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Data Table Card -->
            <div class="custom-card">
                <div class="card-header-styled">
                    <h5><i class="fa-solid fa-list-check me-2 text-primary"></i> Data Peminjaman Aktif</h5>
                    <div class="d-flex">
                        <select class="form-select form-select-sm" style="width: auto; box-shadow:none;">
                            <option>Semua Status</option>
                            <option>Dipinjam</option>
                            <option>Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">No</th>
                                <th>Peminjam</th>
                                <th>Buku / Item</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-bold" style="color: #1f2937;">{{ $item->anggota ? $item->anggota->nama : 'Anggota Dihapus' }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-primary"><i class="fa-solid fa-book me-2 d-none d-sm-inline-block"></i>{{ $item->buku ? $item->buku->judul : 'Buku Dihapus' }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fa-regular fa-calendar text-muted me-2"></i>
                                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->tanggal_kembali)
                                            <div class="d-flex align-items-center">
                                                <i class="fa-regular fa-calendar-check text-muted me-2"></i>
                                                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                                            </div>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status === 'dikembalikan')
                                            <span class="badge-status" style="background-color:#dcfce7;color:#15803d;">Dikembalikan</span>
                                        @else
                                            <span class="badge-status badge-active">Dipinjam</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status === 'dipinjam')
                                        <form action="/peminjaman/{{ $item->id }}/kembali" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm rounded-pill shadow-sm px-3 text-white" style="background: linear-gradient(135deg, #10b981, #34d399); font-size: 0.75rem; font-weight: 600; border: none;" onclick="return confirm('Apakah Anda yakin buku ini sudah dikembalikan dan ingin menyelesaikannya?')">
                                                <i class="fa-solid fa-check-double me-1"></i> Selesai
                                            </button>
                                        </form>
                                        @else
                                            <span class="text-muted" style="font-size:0.82rem;"><i class="fa-solid fa-check text-success me-1"></i>Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted mb-3 mt-2">
                                            <i class="fa-solid fa-folder-open" style="font-size: 3rem; color: #e5e7eb;"></i>
                                        </div>
                                        <div class="fw-medium text-muted">Belum ada data peminjaman sirkulasi</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Form Peminjaman Baru -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header border-bottom-0 pb-0 mt-2">
                    <h5 class="modal-title fw-bold" id="tambahModalLabel">
                        <i class="fa-solid fa-plus-circle text-primary me-2"></i>Formulir Peminjaman Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="/pinjam" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Nama Anggota Peminjam</label>
                            <div class="input-group shadow-sm border-light-subtle rounded-3" style="overflow: hidden;">
                                <span class="input-group-text bg-white border-0 text-primary"><i class="fa-solid fa-user-tag"></i></span>
                                <select class="form-select border-0 bg-light" id="anggota_id" name="anggota_id" required>
                                    <option value="" disabled selected>-- Pilih Anggota --</option>
                                    @if(isset($anggotas) && count($anggotas) > 0)
                                        @foreach($anggotas as $anggota)
                                            <option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>
                                        @endforeach
                                    @else
                                        <!-- Jika data $anggotas belum di-pass ke view oleh controller secara lengkap (opsional test) -->
                                        <option value="1">Data Anggota (Default 1 jika kosong)</option>
                                        <option value="2">Data Anggota (Default 2 jika kosong)</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Pilih Buku</label>
                            <div class="input-group shadow-sm border-light-subtle rounded-3" style="overflow: hidden;">
                                <span class="input-group-text bg-white border-0 text-primary"><i class="fa-solid fa-book"></i></span>
                                <select class="form-select border-0 bg-light" id="buku_id" name="buku_id" required>
                                    <option value="" disabled selected>-- Pilih Buku Tersedia --</option>
                                    @if(isset($bukus) && count($bukus) > 0)
                                        @foreach($bukus as $buku)
                                            <option value="{{ $buku->id }}">{{ $buku->judul }} ({{ $buku->pengarang }}) - Stok: {{ $buku->stok }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Tanggal Transaksi</label>
                            <div class="input-group shadow-sm border-light-subtle rounded-3" style="overflow: hidden;">
                                <span class="input-group-text bg-white border-0 text-primary"><i class="fa-regular fa-calendar-check"></i></span>
                                <input type="date" class="form-control border-0 bg-light" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                            <button type="button" class="btn btn-light shadow-sm" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary-custom shadow-sm px-4">
                                Proses Peminjaman <i class="fa-solid fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle Script
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
</body>
</html>
