<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Film Showlist App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top, #f7ecff 0%, #eedbff 40%, #f4f2ff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #3d2c6e;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            padding: 44px;
            box-shadow: 0 24px 55px rgba(102, 68, 255, 0.14);
            width: 100%;
            max-width: 460px;
            border: 1px solid rgba(156, 105, 255, 0.16);
        }
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .login-header h1 {
            color: #7c52ff;
            font-weight: 900;
            font-size: 2.6rem;
            margin: 0;
        }
        .login-header p {
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
        .btn-login {
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
        .btn-login:hover {
            background: linear-gradient(135deg, #8b5cf6 0%, #caa4ff 100%);
            color: white;
            transform: translateY(-1px);
        }
        .divider {
            text-align: center;
            margin: 30px 0 20px;
            color: #8b84b9;
        }
        .register-link {
            text-align: center;
            color: #6d5d95;
        }
        .register-link a {
            color: #7c52ff;
            text-decoration: none;
            font-weight: 700;
        }
        .register-link a:hover {
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
        .icon-film {
            font-size: 3rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="icon-film"></div>
            <h1>Film Showlist</h1>
            <p>Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('auth.login.process') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" 
                       placeholder="Masukkan email Anda" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" 
                       placeholder="Masukkan password Anda" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                {{-- <div style="text-align: right; margin-top: 8px;">
                    <a href="{{ route('password.request') }}" style="color: #8b5cf6; text-decoration: none; font-size: 0.9rem;">
                        Lupa password?
                    </a>
                </div> --}}
            </div>

            <button type="submit" class="btn btn-login">Login</button>
        </form>

        <div class="divider">atau</div>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('auth.register') }}">Daftar sekarang</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
