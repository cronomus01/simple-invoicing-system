@extends('layout.base')

@section('content')
    <form action="/invoices/store" method="POST">
        @method('POST')
        @csrf
        <div>
            <label for="">Type</label>
            <select name="type">
                <option value="proforma">Proforma</option>
                <option value="sales">Sales</option>
            </select>
        </div>
        <div>
            <label for="">Product Service</label>
            <input type="text" placeholder="Enter product or service" name="product_service">
        </div>
        <div>
            <label for="">Quantity</label>
            <input type="number" name="quantity">
        </div>
        <div>
            <label for="">Base Price</label>
            <input type="number" name="base_price">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
