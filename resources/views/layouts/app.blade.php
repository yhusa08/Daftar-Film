<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Film Showlist')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top, #f8f2ff 0%, #efe1ff 35%, #e8eeff 100%);
            min-height: 100vh;
            margin: 0;
            color: #3f2d6f;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 14px 34px rgba(109, 76, 255, 0.12);
            border-radius: 0 0 18px 18px;
            border-bottom: 1px solid rgba(136, 85, 255, 0.18);
        }
        .navbar-brand {
            color: #6236d0 !important;
            font-weight: bold;
            font-size: 1.6rem;
        }
        .nav-link {
            color: #7b5cf6 !important;
            font-weight: 600;
            margin-right: 16px;
        }
        .nav-link:hover {
            color: #5325b8 !important;
        }
        .user-info {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .username {
            color: #5f3dc4;
            font-weight: 700;
        }
        .btn-logout {
            background: linear-gradient(135deg, #c09bff 0%, #8d6bff 100%);
            border: none;
            color: white;
            font-weight: 700;
            padding: 10px 22px;
            border-radius: 999px;
        }
        .btn-logout:hover {
            background: linear-gradient(135deg, #8d6bff 0%, #b88cff 100%);
            color: white;
            transform: translateY(-1px);
        }
        .container {
            max-width: 1100px;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 20px;
            padding: 34px;
            box-shadow: 0 20px 60px rgba(93, 49, 255, 0.13);
            margin: 30px auto;
            border: 1px solid rgba(156, 116, 255, 0.15);
        }
        .form-card,
        .detail-card {
            max-width: 760px;
            margin: 0 auto;
        }
        .btn-tambah,
        .btn-submit {
            background: linear-gradient(135deg, #c9a7ff 0%, #8a5eff 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 700;
            color: white;
        }
        .btn-tambah:hover,
        .btn-submit:hover {
            background: linear-gradient(135deg, #8a5eff 0%, #d0b4ff 100%);
            color: white;
            transform: translateY(-2px);
        }
        .btn-kembali {
            background: #a29cff;
            border: none;
            padding: 12px 30px;
            font-weight: bold;
            margin-top: 10px;
            width: 100%;
            color: white;
        }
        .btn-kembali:hover {
            background: #7d67f7;
            color: white;
        }
        .form-label {
            color: #3f2d6f;
            font-weight: 700;
            margin-top: 15px;
        }
        .form-control {
            border: 1px solid #d8d0ff;
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
        }
        .form-control:focus {
            border-color: #9c7bff;
            box-shadow: 0 0 0 0.2rem rgba(156, 116, 255, 0.18);
        }
        .alert {
            margin-bottom: 20px;
        }
        .detail-title {
            color: #2d1d5c;
            font-weight: 800;
            margin-bottom: 10px;
        }
        .detail-text {
            color: #52477d;
            margin-bottom: 20px;
        }
        .table thead {
            background: linear-gradient(135deg, #c9a7ff 0%, #8f63ff 100%);
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f5f0ff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navbar-brand">Film Showlist</span>
            <div class="d-flex align-items-center gap-3">
                <a class="nav-link" href="{{ route('films.index') }}">Film</a>
                <a class="nav-link" href="{{ route('genres.index') }}">Genre</a>
                <a class="nav-link" href="{{ route('series.index') }}">Series</a>
            </div>
            <div class="user-info">
                <span class="username">Halo, {{ Auth::user()->name }}</span>
                <form action="{{ route('auth.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
