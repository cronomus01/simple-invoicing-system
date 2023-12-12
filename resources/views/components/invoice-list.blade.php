<div>
    <ul class="space-y-2">
        @isset($invoices)
            @foreach ($invoices as $invoice)
                <li class="border px-2 py-1 cursor-pointer hover:bg-slate-100 bg-white">
                    <a href={{ route('invoice.edit', ['invoice' => $invoice->id]) }}>
                        <h2>Invoice: <span class="uppercase">{{ Str::limit($invoice->invoice_number, '8', '') }}</span></h2>
                        <p>Customer: {{ isset($invoice->customer->name) ? $invoice->customer->name : 'N/A' }}</p>
                        <p>Date: {{ isset($invoice) ? date('F d, Y', strtotime($invoice->invoice_date)) : '' }}</p>
                    </a>
                </li>
            @endforeach
        @endisset
    </ul>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
</div>
