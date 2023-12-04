@extends('layout.base')

@section('content')
    <section class="mx-5">
        <h1 class="text-lg font-bold">Payments</h1>
        <div class="mt-2">
            <ul>
                @isset($invoices)
                    @if (count($invoices) > 0)
                        @foreach ($invoices as $invoice)
                            <li class="border rounded-lg hover:bg-slate-200 cursor-pointer mt-2 p-2 bg-white">
                                <a href={{ route('invoices.show', ['invoice' => $invoice->id]) }}>
                                    <div>
                                        <h2>
                                            Invoice:
                                            <span class="uppercase">
                                                {{ \Illuminate\Support\Str::limit($invoice->invoice_number, 8, $end = '') }}
                                        </h2>
                                        <p class="break-normal line-clamp-1">Date: {{ $invoice->invoice_date }}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li>No invoices...</li>
                    @endif
                @endisset
            </ul>
        </div>
    </section>
@endsection
