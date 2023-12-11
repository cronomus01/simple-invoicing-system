<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="flex justify-center items-center h-full  bg-slate-50">
    <div class="border px-5 py-8 flex justify-center flex-col gap-10 bg-white text-center w-[25rem]">
        <header>
            <h1 class="text-lg">Simple Invoicing System</h1>
        </header>
        <main>
            <form action={{ route('login') }} method="POST"
                class="flex flex-col gap-2 justify-center [&>*]:border [&>*]:px-2 [&>*]:py-2">
                @method('POST')
                @csrf
                <input type="text" name="email" placeholder="Enter your username">
                <input type="password" name="password" placeholder="Enter your password">
                <button type="submit">Login</button>
            </form>
        </main>
        <footer>
            <h2>All rights reserved</h2>
        </footer>
    </div>
</body>

</html>
