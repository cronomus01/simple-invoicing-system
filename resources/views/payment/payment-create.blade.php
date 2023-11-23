@extends('layout.base')

@section('content')
    @isset($invoice)
        <form action="/payment/store/{{ $invoice->id }}" method="POST">
            @method('POST')
            @csrf
            <input type="hidden" value="{{ $invoice->id }}" name="invoice_id">
            <div class="flex justify-between">
                <label for="">Type:</label>
                <select name="type" disabled>
                    <option value="proforma">Proforma</option>
                    <option value="sales">Sales</option>
                </select>
            </div>
            <div class="flex justify-between">
                <label for="">Product Service:</label>
                <input type="text" placeholder="Enter product or service" name="product_service"
                    value={{ $invoice->product_service }} disabled>
            </div>
            <div class="flex justify-between">
                <label for="">Quantity:</label>
                <input type="number" name="quantity" value={{ $invoice->quantity }} disabled>
            </div>
            <div class="flex justify-between">
                <label for="">Base Price:</label>
                <input type="number" name="base_price" value={{ $invoice->base_price }} disabled>
            </div>
            <div class="flex justify-between flex-col">
                <h2>Type of Payment</h2>
                <div>
                    <label for="">Credit Card:</label>
                    <input type="radio" name="payment" value="credit-card">
                </div>
                <div>
                    <label for="">Cash:</label>
                    <input type="radio" name="payment" value="cash">
                </div>
                <div>
                    <label for="">Check:</label>
                    <input type="radio" name="payment" value="check">
                </div>
                <div>
                    <label for="">Direct Debit:</label>
                    <input type="radio" name="payment" value="direct-debit">
                </div>
                <div>
                    <label for="">Bank Transfer:</label>
                    <input type="radio" name="payment" value="bank-transfer">
                </div>
            </div>
            <div>
                <label for="">Total: {{ $invoice->subtotal }}</label>
            </div>
            <button type="submit" class="px-2 py-1 border rounded mt-2 bg-violet-600 text-white">Pay Invoice</button>
        </form>
    @endisset
@endsection
