<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Floating particles */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(2px 2px at 20px 30px, #fff, transparent),
                radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.8), transparent),
                radial-gradient(1px 1px at 90px 40px, #fff, transparent),
                radial-gradient(1px 1px at 130px 80px, rgba(255,255,255,0.6), transparent);
            background-repeat: repeat;
            background-size: 200px 100px;
            animation: float 20s linear infinite;
            opacity: 0.1;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            100% { transform: translateY(-100px) rotate(360deg); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 300% 300%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 36px;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            font-size: 2rem;
            color: white;
        }

        .logo-title {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #1e293b, #334155);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .logo-subtitle {
            color: #64748b;
            font-size: 16px;
            font-weight: 400;
        }

        .form-floating {
            position: relative;
            margin-bottom: 24px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 20px;
            font-size: 16px;
            font-weight: 500;
            background: #f8fafc;
            transition: all 0.3s ease;
            height: 60px;
        }

        .form-control:focus {
            background: white;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-floating > label {
            color: #64748b;
            font-weight: 500;
            padding-left: 20px;
            transform: translateY(0);
        }

        .input-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 20px;
            z-index: 10;
            transition: color 0.3s ease;
        }

        .form-control:focus + .input-icon {
            color: #667eea;
        }

        .login-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 16px;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            width: 100%;
            height: 60px;
            margin-top: 12px;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
        }

        .login-btn:active {
            transform: translateY(-1px);
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 500;
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 36px 24px;
                margin: 10px;
            }
            .logo-title {
                font-size: 24px;
            }
        }

        /* Loading animation */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo-icon">
                <i class="bi bi-book-half"></i>
            </div>
            <h1 class="logo-title">Perpustakaan Digital</h1>
            <p class="logo-subtitle">Masuk ke akun Anda (Admin / Siswa)</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-success text-white shadow-sm">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger bg-danger text-white shadow-sm">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{route('login') }}" method="POST">
            @csrf
            <div class="form-floating">
                <input type="text"
                       name="username"
                       class="form-control"
                       id="username"
                       placeholder="Username"
                       required
                       autofocus>
                <label for="username">Username</label>
                <i class="bi bi-person input-icon"></i>
            </div>

            <div class="form-floating">
                <input type="password"
                       name="password"
                       class="form-control"
                       id="password"
                       placeholder="Password"
                       required>
                <label for="password">Password</label>
                <i class="bi bi-lock-fill input-icon"></i>
            </div>

            <button type="submit" class="login-btn">
                <span class="btn-text">Masuk Sekarang</span>
            </button>
        </form>
    </div>

    <script>
        // Smooth focus effect
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Button loading state
        document.querySelector('form').addEventListener('submit', function() {
            const btn = this.querySelector('.login-btn');
            btn.classList.add('btn-loading');
            const btnText = btn.querySelector('.btn-text');
            if (btnText) {
                btnText.textContent = 'Memproses...';
            }
        });
    </script>
</body>
</html>
