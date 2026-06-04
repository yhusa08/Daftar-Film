<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Film Showlist App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top, #f7ecff 0%, #eedbff 40%, #f4f2ff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 24px;
            color: #3d2c6e;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            padding: 44px;
            box-shadow: 0 24px 55px rgba(102, 68, 255, 0.14);
            width: 100%;
            max-width: 520px;
            border: 1px solid rgba(156, 105, 255, 0.16);
        }
        .register-header {
            text-align: center;
            margin-bottom: 36px;
        }
        .register-header h1 {
            color: #7c52ff;
            font-weight: 900;
            font-size: 2.8rem;
            margin: 0;
        }
        .register-header p {
            color: #67558f;
            margin-top: 10px;
            font-size: 1rem;
        }
        .form-label {
            color: #4b367f;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .form-control {
            border: 1px solid #dfd4ff;
            padding: 14px 16px;
            border-radius: 14px;
            font-size: 1rem;
            margin-bottom: 20px;
            background: #faf7ff;
        }
        .form-control:focus {
            border-color: #a78bff;
            box-shadow: 0 0 0 0.2rem rgba(167, 139, 255, 0.2);
        }
        .btn-register {
            background: linear-gradient(135deg, #d4b2ff 0%, #8b5cf6 100%);
            border: none;
            padding: 14px 30px;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 14px;
            width: 100%;
            color: white;
            margin-top: 10px;
            box-shadow: 0 16px 24px rgba(139, 92, 246, 0.18);
        }
        .btn-register:hover {
            background: linear-gradient(135deg, #8b5cf6 0%, #caa4ff 100%);
            color: white;
            transform: translateY(-1px);
        }
        .login-link {
            text-align: center;
            margin-top: 28px;
            color: #6d5d95;
            font-size: 0.95rem;
        }
        .login-link a {
            color: #7c52ff;
            text-decoration: none;
            font-weight: 700;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .alert {
            margin-bottom: 20px;
            border: none;
            border-radius: 14px;
        }
        .error-message {
            color: #d6336c;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .password-hint {
            color: #7f73a2;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="icon-film"></div>
            <h1>Film Showlist</h1>
            <p>Buat akun baru untuk memulai</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Mohon periksa input Anda:</strong>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('auth.register.process') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">👤 Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" 
                       placeholder="Masukkan nama Anda" required autofocus>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" 
                       placeholder="Masukkan email Anda" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" 
                       placeholder="Minimal 6 karakter" required>
                <div class="password-hint">Gunakan kombinasi huruf dan angka untuk keamanan maksimal</div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                       id="password_confirmation" name="password_confirmation" 
                       placeholder="Ulangi password" required>
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-register">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('auth.login') }}">Masuk di sini</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
