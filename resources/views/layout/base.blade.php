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

<body class="grid grid-cols-desktop bg-slate-50 relative h-full">
    <aside class="print:hidden border-r px-3 py-2 bg-slate-100">
        <div>
            <x-nav type="aside-nav" />
            <x-search-invoice />
            <nav class="mt-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard.index') }}"
                            class="{{ Str::replace('/', ' / ', Str::replaceFirst('/', '', Str::replace(Request::root(), '', Request::url()))) ==
                            'dashboard'
                                ? 'border block px-2 py-1  bg-slate-200 shadow-sm'
                                : 'border block px-2 py-1 bg-white hover:bg-slate-200 hover:text-black text-gray-500' }}">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        @isset($invoice->id)
                            @if ($invoice->id)
                                <a href="{{ route('invoice.edit', ['invoice' => $invoice->id]) }}"
                                    class="{{ Str::replace('/', ' / ', Str::replaceFirst('/', '', Str::replace(Request::root(), '', Request::url()))) ==
                                    'invoice / ' . $invoice->id . ' / edit'
                                        ? 'border block px-2 py-1  bg-slate-200 shadow-sm'
                                        : 'border block px-2 py-1 bg-white hover:bg-slate-200 hover:text-black text-gray-500' }}">
                                    <span>Invoices</span>
                                </a>
                            @endif
                        @endisset
                    </li>
                    <li>
                        @isset($payment->id)
                            @if ($payment->id)
                                <a href="{{ route('payment.show', ['payment' => $payment->id]) }}"
                                    class="{{ Str::replace('/', ' / ', Str::replaceFirst('/', '', Str::replace(Request::root(), '', Request::url()))) ==
                                    'payment / ' . $payment->id
                                        ? 'border block px-2 py-1  bg-slate-200 shadow-sm'
                                        : 'border block px-2 py-1 bg-white hover:bg-slate-200 hover:text-black text-gray-500' }}">
                                    <span>Payments</span>
                                </a>
                            @endif
                        @endisset
                    </li>
                </ul>
            </nav>
            {{-- <x-invoice-list :invoices="$invoices" /> --}}
        </div>
    </aside>
    <main class="h-full">
        <x-nav type="content-nav" />
        @yield('content')
    </main>
</body>

</html>
