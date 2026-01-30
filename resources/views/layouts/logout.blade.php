<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
     <title>@yield('title', 'Default Title')</title>

    <style>
        :root {
            --accent: #1f8efa;
            --bg: #f7f7f9;
            --card: #fff;
            --muted: #6b7280;
        }

        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: #111;
        }

        nav {
            background: var(--card);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        nav .container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
        }

        nav a.brand {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--accent);
            text-decoration: none;
        }

        .btn {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn.outline {
            background: transparent;
            border: 1px solid #ccc;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        footer {
            background: #f0f0f0;
            padding: 0.5rem;
            text-align: center;
            color: #363535;

            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <nav>
        <div class="container">
            <a href="#" class="brand">🔗 URL Shortener</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn">Logout</button>
            </form>

        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        © 2026 URL Shortener — Static Template
    </footer>
</body>

</html>
