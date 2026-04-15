<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - Admin Perpustakaan</title>
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

        /* Catalog specific styling */
        .book-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #f3f4f6;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            border-color: #e0e7ff;
        }

        .book-cover {
            height: 200px;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 3rem;
            position: relative;
        }

        .book-cover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        }

        .book-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .book-category {
            font-size: 0.75rem;
            font-weight: 600;
            color: #4f46e5;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .book-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 5px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .book-author {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 15px;
        }

        .book-footer {
            margin-top: auto;
            border-top: 1px solid #f3f4f6;
            padding-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .book-stock {
            background-color: #def7ec;
            color: #03543f;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .book-actions button {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: white;
            color: #6b7280;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .book-actions button:hover {
            background: #f3f4f6;
            color: #1f2937;
        }

        .book-actions .btn-edit:hover {
            color: #4f46e5;
            border-color: #c7d2fe;
            background: #e0e7ff;
        }

        .filter-section {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
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
            <a href="/anggota" class="menu-item">
                <i class="fa-solid fa-users"></i> Anggota
            </a>
            <a href="/buku" class="menu-item active">
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
                    <input type="text" placeholder="Pencarian pustaka...">
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
                    <h3 class="mb-1 fw-bold" style="color: #1f2937;">Katalog Buku Terpadu</h3>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">Kelola seluruh inventori buku dan data pustaka Anda</p>
                </div>
                <div>
                    <button class="btn btn-primary-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#bukuModal">
                        <i class="fa-solid fa-plus me-2"></i>Tambah Buku Baru
                    </button>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="form-group mb-0 me-2">
                    <select class="form-select border-0 bg-light">
                        <option>Semua Kategori</option>
                        <option>Fiksi</option>
                        <option>Pendidikan</option>
                        <option>Sains & Teknologi</option>
                    </select>
                </div>
                <div class="form-group mb-0 me-2">
                    <select class="form-select border-0 bg-light">
                        <option>Urutkan: Terbaru</option>
                        <option>Judul A-Z</option>
                        <option>Stok Terbanyak</option>
                    </select>
                </div>
                <div class="flex-grow-1"></div>
                <div class="text-muted fw-medium" style="font-size: 0.9rem;">
                    Menampilkan <span class="text-dark fw-bold">{{ count($data ?? []) }}</span> buku dalam katalog
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm bg-white mb-4" style="border-left: 4px solid #10b981 !important;" role="alert">
                    <i class="fa-solid fa-check-circle text-success me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm bg-white mb-4" style="border-left: 4px solid #ef4444 !important;" role="alert">
                    <ul class="mb-0 ps-3 text-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Catalog Grid -->
            <div class="row">
                @forelse($data as $buku)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="book-card">
                            <!-- Placeholder Cover -->
                            <div class="book-cover">
                                @php
                                    $colors = ['#fca5a5', '#93c5fd', '#86efac', '#fde047', '#c4b5fd', '#fbcfe8'];
                                    $bg = $colors[($buku->id ?? 0) % count($colors)];
                                @endphp
                                <div style="position: absolute; inset:0; background-color: {{ $bg }}; opacity: 0.4;"></div>
                                <i class="fa-solid fa-book-journal-whills text-dark" style="opacity: 0.5;"></i>
                                <span class="badge bg-dark position-absolute top-0 end-0 m-3 shadow-sm rounded-pill" style="font-size: 0.7rem; font-weight: 500;">
                                    ID: B-{{ str_pad($buku->id ?? rtrim('x'), 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>

                            <!-- Book Details -->
                            <div class="book-info">
                                <div class="book-category"><i class="fa-solid fa-bookmark me-1 border-0"></i> Pustaka Umum</div>
                                <h4 class="book-title">{{ $buku->judul ?? 'Judul Buku' }}</h4>
                                <div class="book-author"><i class="fa-solid fa-pen-nib me-2"></i>{{ $buku->pengarang ?? 'Penulis Tidak Diketahui' }}</div>

                                <div class="book-footer">
                                    <div class="book-stock">
                                        <i class="fa-solid fa-layer-group me-1"></i> Stok: {{ $buku->stok ?? 0 }}
                                    </div>
                                    <div class="book-actions">
                                        <button class="btn-edit" title="Edit Buku"> <i class="fa-solid fa-pen-to-square"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-12 py-5 text-center">
                        <div class="mb-4">
                            <i class="fa-solid fa-box-open" style="font-size: 5rem; color: #d1d5db;"></i>
                        </div>
                        <h4 class="fw-bold" style="color: #4b5563;">Belum Ada Buku</h4>
                        <p class="text-muted">Katalog perpustakaan saat ini masih kosong. Silakan tambah data buku baru.</p>
                        <button class="btn btn-primary-custom mt-2" data-bs-toggle="modal" data-bs-target="#bukuModal">
                            Tambah Buku Pertama
                        </button>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="bukuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header border-bottom-0 pb-0 mt-2">
                    <h5 class="modal-title fw-bold">
                        <i class="fa-solid fa-book-medical text-primary me-2"></i>Tambah Buku Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ url('/buku') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Judul Buku</label>
                            <input type="text" name="judul" class="form-control border-light-subtle shadow-sm bg-light" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Nama Pengarang</label>
                            <input type="text" name="pengarang" class="form-control border-light-subtle shadow-sm bg-light" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Nama Penerbit</label>
                            <input type="text" name="penerbit" class="form-control border-light-subtle shadow-sm bg-light" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted" style="font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px;">Jumlah Stok</label>
                            <input type="number" name="stok" class="form-control border-light-subtle shadow-sm bg-light" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                            <button type="button" class="btn btn-light shadow-sm" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary-custom shadow-sm px-4">
                                Simpan Buku <i class="fa-solid fa-check ms-1"></i>
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
