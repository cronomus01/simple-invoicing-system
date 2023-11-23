@extends('layout.base')

@section('content')
    <div>
        <div class="flex justify-between">
            <h1 class="text-lg">Invoices</h1>
            <a href="/invoices/create" class="text-blue-600">Create Invoice</a>
        </div>
        <table class="table-auto mt-5">
            <thead>
                <th>Type</th>
                <th>Product / Service</th>
                <th>Quantity</th>
                <th>Base Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </thead>
            <tbody>
                {{-- @isset($invoices) --}}
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->type }}</td>
                        <td>{{ $invoice->produce_service }}</td>
                        <td>{{ $invoice->quantity }}</td>
                        <td>{{ $invoice->base_price }}</td>
                        <td>{{ $invoice->subtotal }}</td>
                        <td class="flex items-center space-x-4">
                            <a href="/invoices/edit/{{ $invoice->id }}" class="text-green-500">Edit</a>
                            <form action="/invoices/delete/{{ $invoice->id }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="text-rose-500">Delete</button>
                            </form>
                            <a href="/payment/show/{{ $invoice->id }}" class="text-violet-500">Payment</a>
                        </td>
                    </tr>
                @endforeach
                {{-- @endisset --}}
            </tbody>
        </table>
    </div>
@endsection
