@extends('layout.base')

@section('content')
    @isset($invoice)
        <form action="/invoices/update/{{ $invoice->id }}" method="POST">
            @method('PUT')
            @csrf
            {{-- <h1>{{ $invoice }}</h1> --}}
            <div class="flex justify-between">
                <label for="">Type:</label>
                <select name="type">
                    <option value="proforma">Proforma</option>
                    <option value="sales">Sales</option>
                </select>
            </div>
            <div class="flex justify-between">
                <label for="">Product Service:</label>
                <input type="text" placeholder="Enter product or service" name="product_service"
                    value={{ $invoice->product_service }}>
            </div>
            <div class="flex justify-between">
                <label for="">Quantity:</label>
                <input type="number" name="quantity" value={{ $invoice->quantity }}>
            </div>
            <div class="flex justify-between">
                <label for="">Base Price:</label>
                <input type="number" name="base_price" value={{ $invoice->base_price }}>
            </div>
            <button type="submit" class="px-2 py-1 border rounded mt-2 bg-violet-600 text-white">Update</button>
        </form>
    @endisset
@endsection
