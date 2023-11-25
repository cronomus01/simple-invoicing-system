@extends('layout.base')

@section('content')
    <section class="container mx-auto">
        <div class="flex justify-between">
            <h1>Invoices</h1>
            <form action={{ route('invoices.store') }} method="post">
                @csrf
                <button
                    class="p-2 border border-slate-300 rounded bg-slate-200 hover:border-slate-200  hover:bg-slate- shadow-sm">Create
                    Invoice</button>
            </form>
        </div>
        <div class="mt-2">
            <ul>
                @isset($invoices)
                    @if (count($invoices) > 0)
                        @foreach ($invoices as $invoice)
                            <li class="border rounded-lg hover:bg-slate-200 cursor-pointer mt-2 p-2">
                                <a href={{ route('invoices.edit', ['invoice' => $invoice->id]) }}>
                                    <div>
                                        <h2>{{ $invoice->invoice_number }}</h2>
                                        <p>Date: {{ $invoice->invoice_date }}</p>
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
