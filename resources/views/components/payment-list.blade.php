<div class="print:hidden">
    <ul class="space-y-2">
        @isset($payments)
            @foreach ($payments as $payment)
                <li>
                    <a href="{{ route('payment.show', ['payment' => $payment->id]) }}"
                        class="flex justify-between items-start{{ Str::replace('/', ' / ', Str::replaceFirst('/', '', Str::replace(Request::root(), '', Request::url()))) ==
                        'payment / ' . $payment->id
                            ? 'block px-2 py-1  bg-slate-200 border border-slate-900'
                            : 'border block px-2 py-1 bg-white hover:bg-slate-200' }}">
                        <div>
                            <h2>Record No: <span
                                    class="uppercase">#{{ Str::limit($payment->payment_record_number, '8', '') }}</span></h2>
                            <p>OR No: <span class="uppercase">
                                    #{{ Str::limit($payment->or_number, '8', '') }}</span></p>
                            <p>Type: {{ ucwords(Str::replace('-', ' ', $payment->type_of_payment)) }}</p>
                            <p>Date: {{ date('F d, Y', strtotime($payment->payment_date)) }}</p>
                        </div>
                        @isset($latest)
                            @if ($latest->id === $payment->id)
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
