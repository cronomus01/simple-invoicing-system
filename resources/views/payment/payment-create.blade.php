@extends('layout.base')

@section('content')
    <div class="flex gap-5 items-start pr-2">
        @isset($invoice)
            <form action="{{ route('payment.store', ['payment' => $invoice->id]) }}" method="POST"
                class="mt-5 border p-5 bg-white w-[40%]">
                @method('POST')
                @csrf
                <input type="hidden" value="{{ $invoice->id }}" name="invoice_id">
                <input type="hidden" value="{{ $paymentNumber }}" name="payment_number">
                <div class="flex justify-between flex-col uppercase mb-3">
                    <h2 class="text-lg">Payment</h2>
                    <p>No. #{{ Str::limit($paymentNumber, 8, '') }}
                    </p>
                </div>
                <div>
                    <table class="text-sm  rtl:text-right w-full">
                        <tbody class="leading-6 uppercase text-sm">
                            <tr>
                                <td class=" pr-10">
                                    <label for="credit-card" class="cursor-pointer">
                                        Credit Card:
                                    </label>
                                </td>
                                <td class="text-right">
                                    <input type="radio" name="payment_type" value="credit-card" id="credit-card">
                                </td>
                            </tr>
                            <tr>
                                <td class=" pr-10">
                                    <label for="cash" class="cursor-pointer">
                                        Cash:
                                    </label>

                                </td>
                                <td class="text-right">
                                    <input type="radio" name="payment_type" value="cash" id="cash">
                                </td>
                            </tr>
                            <tr>
                                <td class="pr-10">
                                    <label for="check" class="cursor-pointer">
                                        Check:
                                    </label>
                                </td>
                                <td class="text-right">
                                    <input type="radio" name="payment_type" value="check" id="check">
                                </td>
                            </tr>
                            <tr>
                                <td class="pr-10">
                                    <label for="direct-debit" class="cursor-pointer">
                                        Direct Debit:
                                    </label>

                                </td>
                                <td class="text-right">
                                    <input type="radio" name="payment_type" value="direct-debit" id="direct-debit">
                                </td>
                            </tr>
                            <tr>
                                <td class="pr-10">
                                    <label for="bank-transfer" class="cursor-pointer">
                                        Bank Transfer:
                                    </label>

                                </td>
                                <td class="text-right">
                                    <input type="radio" name="payment_type" value="bank-transfer" id="bank-transfer">
                                </td>
                            </tr>
                            <tr>
                                <td class="pr-10">
                                    Paid:
                                </td>
                                <td class="text-right">
                                    P{{ isset($invoice->total) ? number_format($invoice->total->grand_price, 2) : 0 }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <label for="">Total: {{ $invoice->subtotal }}</label> --}}
                </div>
                <menu>
                    <li>
                        <button type="submit"
                            class="px-4 py-1 rounded mt-2 bg-slate-200 hover:shadow hover:text-white hover:bg-slate-400"
                            id="print">Pay Invoice</button>
                        <a href="{{ route('dashboard.index') }}">
                            <button type="submit"
                                class="px-4 py-1 rounded mt-2 bg-slate-300 hover:shadow hover:text-white hover:bg-slate-400">
                                Cancel
                            </button>
                        </a>
                    </li>
                </menu>
            </form>
        @endisset
        <section class="mt-5">
            <x-invoice-preview :invoice="$invoice" discountedPrice="{{ $discountedPrice }}" :hidden="false"
                :payment="true" />
        </section>
    </div>
@endsection
