<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Film Showlist</title>
    <style>
        body { margin: 0; font-family: Inter, system-ui, sans-serif; background: #f3f4f6; color: #111827; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { width: min(100%, 520px); padding: 28px; background: #ffffff; border-radius: 24px; box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12); text-align: center; }
        h1 { margin: 0 0 0.75rem; font-size: 2rem; color: #1f2937; }
        p { margin: 0 0 1.5rem; color: #4b5563; line-height: 1.6; }
        .buttons { display: inline-flex; flex-wrap: wrap; gap: 0.75rem; justify-content: center; }
        .buttons a { padding: 0.85rem 1.6rem; border-radius: 999px; text-decoration: none; font-weight: 600; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .buttons a:hover { transform: translateY(-1px); box-shadow: 0 12px 24px rgba(15, 23, 42, 0.15); }
        .primary { background: #2563eb; color: #fff; }
        .secondary { background: #e2e8f0; color: #111827; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Film Showlist</h1>
        <p>Masuk atau daftar untuk mulai mengelola daftar film Anda. Halaman ini ringan agar terbuka cepat.</p>
        <div class="buttons">
            <a class="primary" href="{{ route('auth.login') }}">Login</a>
            <a class="secondary" href="{{ route('auth.register') }}">Register</a>
        </div>
    </div>
</body>
</html>
