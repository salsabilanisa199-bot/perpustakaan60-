<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Anggota - Admin Perpustakaan</title>
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

        /* Avatar Table */
        .avatar-initial {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e7ff;
            color: #4f46e5;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            flex-shrink: 0;
            font-size: 0.95rem;
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
            <a href="/peminjaman" class="menu-item">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="/peminjaman" class="menu-item">
                <i class="fa-solid fa-hand-holding-hand"></i> Peminjaman
            </a>
            <a href="/anggota" class="menu-item active">
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
                    <input type="text" placeholder="Cari nama anggota atau NIS...">
                </div>
            </div>
            <div class="user-profile">
                <button class="btn btn-light position-relative rounded-circle p-2 d-none d-sm-block border-0">
                    <i class="fa-regular fa-bell text-muted"></i>
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
                    <h3 class="mb-1 fw-bold" style="color: #1f2937;">Sistem Registrasi Anggota</h3>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">Kelola data pendaftaran nomor induk bagi peminjam.</p>
                </div>
                <div>
                    <button class="btn btn-primary-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#anggotaModal">
                        <i class="fa-solid fa-user-plus me-2"></i>Registrasi Anggota Baru
                    </button>
                </div>
            </div>

            <!-- Data Table Card -->
            <div class="custom-card">
                <div class="card-header-styled">
                    <h5><i class="fa-solid fa-id-card-clip me-2 text-primary"></i> Daftar Anggota Aktif</h5>
                    <div class="d-flex">
                        <span class="badge bg-light text-dark shadow-sm border px-3 py-2">
                            Total: {{ count($data ?? []) }} Terdaftar
                        </span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 80px;">No</th>
                                <th>Profil Nama Lengkap</th>
                                <th>Nomer Induk Siswa (NIS)</th>
                                <th>Kelas</th>
                                <th class="text-center">Aksi Manajemen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-initial shadow-sm border border-white">
                                                {{ substr($item->nama ?? 'A', 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold" style="color: #1f2937;">{{ $item->nama }}</div>
                                                <div class="text-muted" style="font-size: 0.8rem;">Status: Terverifikasi</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold font-monospace bg-light rounded px-2 py-1 d-inline-block">{{ $item->nis }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-white text-dark border">{{ $item->kelas }}</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-light btn-icon border shadow-sm rounded-circle px-2 text-muted" title="Cetak ID Card"><i class="fa-solid fa-print"></i></button>
                                        <button class="btn btn-sm btn-light btn-icon border shadow-sm rounded-circle px-2 text-primary ms-1" title="Edit Data"><i class="fa-solid fa-pen"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted mb-3 mt-2">
                                            <i class="fa-regular fa-id-badge" style="font-size: 4rem; color: #e5e7eb;"></i>
                                        </div>
                                        <div class="fw-medium text-muted">Belum ada anggota perpustakaan yang terdaftar.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Form Tambah Anggota -->
    <div class="modal fade" id="anggotaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header border-bottom-0 pb-0 mt-2">
                    <h5 class="modal-title fw-bold">
                        <i class="fa-solid fa-user-plus text-primary me-2"></i>Registrasi Anggota
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="/anggota">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control border-light-subtle shadow-sm bg-light" placeholder="Masukkan nama lengkap siswa" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Nomor Induk Siswa (NIS)</label>
                            <input type="text" name="nis" class="form-control border-light-subtle shadow-sm bg-light" placeholder="Contoh: 12345678" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Kelas</label>
                            <input type="text" name="kelas" class="form-control border-light-subtle shadow-sm bg-light" placeholder="Contoh: X IPA 1" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                            <button type="button" class="btn btn-light shadow-sm" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary-custom shadow-sm px-4">
                                Daftar dan Simpan <i class="fa-solid fa-user-check ms-1"></i>
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
