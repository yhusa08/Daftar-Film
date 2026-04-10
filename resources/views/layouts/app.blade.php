<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Film Showlist')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; margin: 0; }
        .navbar { background: white !important; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); border-radius: 0 0 10px 10px; }
        .navbar-brand { color: #667eea !important; font-weight: bold; font-size: 1.5rem; }
        .nav-link { color: #667eea !important; font-weight: 500; margin-right: 16px; }
        .nav-link:hover { color: #764ba2 !important; }
        .user-info { margin-left: auto; display: flex; align-items: center; gap: 15px; }
        .username { color: #667eea; font-weight: bold; }
        .btn-logout { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; font-weight: bold; padding: 8px 20px; }
        .btn-logout:hover { background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); color: white; transform: translateY(-2px); }
        .container { max-width: 1100px; background: white; border-radius: 10px; padding: 30px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); margin: 30px auto; }
        .form-card { max-width: 700px; margin: 0 auto; }
        .detail-card { max-width: 760px; margin: 0 auto; }
        .btn-tambah { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 10px 25px; font-weight: bold; }
        .btn-tambah:hover { background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); color: white; transform: translateY(-2px); }
        .btn-submit { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 12px 30px; font-weight: bold; margin-top: 20px; width: 100%; }
        .btn-submit:hover { background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); color: white; transform: translateY(-2px); }
        .btn-kembali { background: #6c757d; border: none; padding: 12px 30px; font-weight: bold; margin-top: 10px; width: 100%; }
        .btn-kembali:hover { background: #5a6268; color: white; }
        .form-label { color: #333; font-weight: 600; margin-top: 15px; }
        .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25); }
        .alert { margin-bottom: 20px; }
        .detail-title { color: #1f2937; font-weight: 700; margin-bottom: 10px; }
        .detail-text { color: #4b5563; margin-bottom: 20px; }
        .table thead { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .table tbody tr:hover { background-color: #f5f5f5; }
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
