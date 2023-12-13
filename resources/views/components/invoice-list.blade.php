<div class="print:hidden">
    <ul class="space-y-2">
        @isset($invoices)
            @foreach ($invoices as $invoice)
                <li>
                    <a href="{{ route('invoice.edit', ['invoice' => $invoice->id]) }}"
                        class="{{ Str::replace('/', ' / ', Str::replaceFirst('/', '', Str::replace(Request::root(), '', Request::url()))) ==
                        'invoice / ' . $invoice->id . ' / edit'
                            ? 'border block px-2 py-1  bg-slate-100 '
                            : 'border block px-2 py-1 bg-white hover:bg-slate-100' }}">
                        <h2>Invoice: <span class="uppercase">#{{ Str::limit($invoice->invoice_number, '8', '') }}</span></h2>
                        <p>Customer: {{ isset($invoice->customer->name) ? $invoice->customer->name : 'N/A' }}</p>
                        <p>Date: {{ isset($invoice) ? date('F d, Y', strtotime($invoice->invoice_date)) : '' }}</p>
                    </a>
                    {{-- <a href={{ route('invoice.edit', ['invoice' => $invoice->id]) }}>

                    </a> --}}
                </li>
            @endforeach
        @endisset
    </ul>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
</div>
