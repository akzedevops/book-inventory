<!DOCTYPE html>
<html>
<head>
    <title>Book Inventory</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('books.index') }}">Home</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
