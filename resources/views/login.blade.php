<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            display: flex; 
            align-items: center; 
            justify-content: center; 
            min-height: 100vh;
            margin: 0;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .login-card { 
            max-width: 420px; 
            width: 100%; 
            padding: 40px; 
            border-radius: 20px; 
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            transform: translateY(0);
            transition: all 0.3s ease;
        }
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #23a6d5;
        }
        .btn-primary {
            background-color: #23a6d5;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: #1c8cb6;
            transform: scale(1.02);
        }
        .logo-icon {
            font-size: 3rem;
            background: -webkit-linear-gradient(#23a6d5, #e73c7e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <i class="bi bi-book logo-icon mb-2 d-inline-block"></i>
            <h3 class="fw-bold">Perpustakaan Digital</h3>
            <p class="text-muted">Masuk ke akun Anda (Admin / Siswa)</p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success p-2 text-center border-0 rounded">{{ session('success') }}</div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger p-2 text-center border-0 rounded">{{ $errors->first() }}</div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label text-muted fw-semibold">Username</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control border-start-0 ps-0" placeholder="Masukkan Username" required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label text-muted fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 shadow-sm">Masuk Sekarang</button>
        </form>
    </div>
</body>
</html>