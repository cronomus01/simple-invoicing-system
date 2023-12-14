<div class="print:hidden mt-3">
    <ul class="space-y-2">
        @isset($invoices)
            @foreach ($invoices as $invoice)
                <li>
                    <a href="{{ route('invoice.edit', ['invoice' => $invoice->id]) }}"
                        class="flex justify-between {{ Str::replace('/', ' / ', Str::replaceFirst('/', '', Str::replace(Request::root(), '', Request::url()))) ==
                        'invoice / ' . $invoice->id . ' / edit'
                            ? 'border block px-2 py-1  bg-slate-200 border-slate-600'
                            : 'border block px-2 py-1 bg-white hover:bg-slate-200' }}">
                        <section>
                            <h2>Invoice: <span class="uppercase">#{{ Str::limit($invoice->invoice_number, '8', '') }}</span>
                            </h2>
                            <article>
                                <p>Customer: {{ isset($invoice->customer->name) ? $invoice->customer->name : 'N/A' }}</p>
                                <p>Date: {{ isset($invoice) ? date('F d, Y', strtotime($invoice->invoice_date)) : '' }}</p>
                            </article>
                        </section>
                        @isset($latest)
                            @if ($latest->id === $invoice->id)
                                <div>New</div>
                            @endif
                        @endisset
                    </a>
                </li>
            @endforeach
        @endisset
    </ul>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
</div>
