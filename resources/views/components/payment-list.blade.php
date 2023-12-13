<div class="print:hidden">
    <ul class="space-y-2">
        @isset($payments)
            @foreach ($payments as $payment)
                <li>
                    <a href="{{ route('payment.show', ['payment' => $payment->id]) }}"
                        class="{{ Str::replace('/', ' / ', Str::replaceFirst('/', '', Str::replace(Request::root(), '', Request::url()))) ==
                        'payment / ' . $payment->id
                            ? 'border block px-2 py-1  bg-slate-100 '
                            : 'border block px-2 py-1 bg-white hover:bg-slate-100' }}">
                        <h2>Record No: <span
                                class="uppercase">#{{ Str::limit($payment->payment_record_number, '8', '') }}</span></h2>
                        <p>OR No: <span class="uppercase">
                                #{{ Str::limit($payment->or_number, '8', '') }}</span></p>
                        <p>Date: {{ date('F d, Y', strtotime($payment->payment_date)) }}</p>
                    </a>
                </li>
            @endforeach
        @endisset
    </ul>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
</div>
