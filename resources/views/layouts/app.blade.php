<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoGame')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('index') }}">Home</a>
            <a href="{{ route('inbox.index') }}">Inbox</a>
        </nav>
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer>
        <p>&copy; 2024 TokoGame. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
