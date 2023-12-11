<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="../css/app.css"> --}}
    @stack('scripts')
    @vite('resources/css/app.css')
</head>

<body class="grid grid-cols-desktop gap-3 p-3 bg-slate-50">
    <aside>
        <div>
            <x-nav type="aside-nav" />
            <x-search-invoice />
            <x-invoice-list :invoices="$invoices" />
        </div>
    </aside>
    <main>
        <x-nav type="content-nav" />
        <section>
            @yield('content')
        </section>
    </main>
</body>

</html>
