@extends('layout.base', ['payment' => $payment, 'invoice' => $invoice])

@section('content')
    {{-- <section class="mx-5">
        <form action={{ route('payments.store') }} method="POST" class="border px-5 py-5" id="invoice-item">
            @method('POST')
            @csrf
            <input type="hidden" name="invoice_id" value={{ isset($invoice) ? $invoice->id : 0 }}>
            <fieldset class="flex gap-5 justify-between">
                <section class="">
                    <h1 class="text-lg font-bold uppercase">Company Name</h1>
                    <p>Address: 23 Road Made Up Street Pers</p>
                    <p>City: Nauru</p>
                    <p>Phone: 123-123-1110</p>
                </section>
                <section class=" float-right">
                    <h1 class="text-lg font-bold uppercase
                    text-right">Invoice</h1>
                    <table>
                        <tbody>
                            <tr>
                                <td class="px-2">Date:</td>
                                <td class="border text-center">{{ isset($invoice) ? $invoice->invoice_date : '' }}</td>
                            </tr>
                            <tr>
                                <td class="px-2">Invoice: </td>
                                <td class="border text-center">
                                    {{ isset($invoice) ? $invoice->invoice_number : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </fieldset>
            <fieldset class="mt-5 w-[28%] space-y-2">
                <h1 class="uppercase font-bold mb-3 text-lg">Customer</h1>
                <div class="flex justify-between">
                    <label for="">Name:</label>
                    <input type="text" class="border">
                </div>
                <div class="flex justify-between">
                    <label for="">Company:</label>
                    <input type="text" class="border">
                </div>
            </fieldset>
            <fieldset class="mt-5 gap-5">
                <div class="relative overflow-x-auto text-slate-50">
                    <table class="w-full text-sm text-left rtl:text-right border">
                        <thead class="text-xs uppercase bg-slate-500">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product / Service
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Base Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody id="invoice-item-body" class="[&>*:nth-child(even)]:bg-slate-200 text-slate-900">
                            @if (count($invoice->items()) > 0)
                                @foreach ($invoice->items() as $item)
                                    <tr class="bg-white">
                                        <td>
                                            <input type="text" class="px-4 py-2 bg-transparent" value={{ $item->type }}
                                                disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="px-4 py-2 bg-transparent"
                                                value={{ $item->product_service }} disabled>
                                        </td>
                                        <td>
                                            <input type="number" class="px-4 py-2 bg-transparent"
                                                value={{ $item->quantity }} disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="px-4 py-2 bg-transparent"
                                                value={{ $item->base_price }} disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="px-4 py-2 bg-transparent"
                                                value={{ $item->subtotal }} disabled>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </fieldset>
            <fieldset class="mt-5">
                <h2 class="uppercase font-bold">Amount</h2>
                <table>
                    <tbody>
                        <tr>
                            <td class="pr-2">Grand Total:</td>
                            <td class="border text-center px-2 font-bold">
                                <input type="text" name="amount_paid" value={{ isset($grandtotal) ? $grandtotal : 0 }}
                                    class="pointer-events-none">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
            <fieldset class="mt-5 w-[15%] space-y-2">
                <h2 class="uppercase font-bold">Type of Payment</h2>
                <div class="flex justify-between">
                    <label for="credit-card" class="cursor-pointer">Credit Card:</label>
                    <input type="radio" name="payment_type" value="credit-card" id="credit-card">
                </div>
                <div class="flex justify-between">
                    <label for="cash" class="cursor-pointer">Cash:</label>
                    <input type="radio" name="payment_type" value="cash" id="cash">
                </div>
                <div class="flex justify-between">
                    <label for="check" class="cursor-pointer">Check:</label>
                    <input type="radio" name="payment_type" value="check" id="check">
                </div>
                <div class="flex justify-between">
                    <label for="direct-debit" class="cursor-pointer">Direct Debit:</label>
                    <input type="radio" name="payment_type" value="direct-debit" id="direct-debit">
                </div>
                <div class="flex justify-between">
                    <label for="bank-transfer" class="cursor-pointer">Bank Transfer:</label>
                    <input type="radio" name="payment_type" value="bank-transfer" id="bank-transfer">
                </div>
            </fieldset>
        </form>
        <div class="mt-5">
            <button type="submit" class="border px-3 py-1 rounded-md bg-slate-200 mt-2" form="invoice-item">Update</button>
            <button type="submit" class="border px-3 py-1 rounded-md mt-2" form="invoice-item">Cancel</button>
        </div>
    </section> --}}
    <section class="grid grid-cols-desktop gap-2 pt-5 print:p-0">
        <aside class="overflow-y-auto h-[90vh] pr-2">
            <x-payment-list :payments="$payments" />
        </aside>
    </section>
@endsection
