<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="flex justify-center items-center h-full  bg-slate-50">
    <main class="border rounded-lg px-5 py-8 flex justify-center flex-col gap-10 bg-white text-center w-[25rem]">
        <section class="z-10">
            <h1 class="text-lg">Simple Invoicing System</h1>
            <article>
                <p class="opacity-60 text-sm">Effortlessly manage invoices, boost professionalism, and enhance client
                    satisfaction instantly.</p>
            </article>
        </section>
        <form action={{ route('login') }} method="POST"
            class="flex flex-col gap-3 justify-center [&>*]:border [&>*]:px-2 [&>*]:py-2 z-10">
            @method('POST')
            @csrf
            <input type="text" name="email" placeholder="Enter your username">
            <input type="password" name="password" placeholder="Enter your password">
            <button type="submit" class="bg-slate-50 hover:bg-slate-100">Login</button>
        </form>
        <section class="text-sm opacity-60">
            <h1>Account</h1>
            <article>
                <p>Username: example_user@example.com</p>
                <p>Password: password</p>
            </article>
        </section>
        <small>All rights reserved</small>
        <figure class="absolute bottom-0 left-0 w-[25%]">
            <img src="{{ asset('assets/icons/undraw_knowledge_re_5v9l.svg') }}" alt="woman looking on a instructions">
        </figure>
        <figure class="absolute top-0 right-0 z-0 w-[25%]">
            <img src="{{ asset('assets/icons/undraw_tree_swing_re_pqee.svg') }}" alt="woman looking on a instructions"
                class="flip-horizontal">
        </figure>
    </main>
</body>

</html>
