<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="../css/app.css"> --}}
    @vite('resources/css/app.css')
</head>

<body>
    <header class="p-2">
        <nav>
            <h1>Logo</h1>
        </nav>
    </header>
    <aside class="p-2">
        <ul>
            <li>
                <a href="/invoices" class="text-blue-600">Invoices</a>
            </li>
            <li>
                <a href="/customers" class="text-blue-600">Customer</a>
            </li>
        </ul>
    </aside>
    <main class="container flex justify-center">
        @yield('content')
    </main>
</body>

</html>
