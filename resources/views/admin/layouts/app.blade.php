<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Админка</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('masters.index') }}">Мастера</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services.index') }}">Услуги</a>
                    </li>
                </ul>
                    @csrf
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Выйти</button>
                    </form>

                    <!-- Отображение сообщений (если нужно) -->
                    {{-- @if(session('info'))
                        <div class="alert alert-success mt-3">
                            {{ session('info') }}
                        </div>
                    @endif                 --}}
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
