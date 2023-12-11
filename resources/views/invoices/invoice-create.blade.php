@extends('layout.base')

@section('content')
    <h1 class="text-lg font-bold mb-3">Create Invoice</h1>
    <form action={{ route('invoice.store') }} method="POST" class="flex flex-col gap-2">
        @method('POST')
        @csrf
        <input type="hidden" value="" name="customer_id" id="customer-input-id">
        <div>
            <label for="invoice-number" class="font-bold">
                Invoice:
            </label>
            <input type="text" value="{{ isset($invoice_number) ? $invoice_number : 'N/A' }}"
                class="pointer-events-none uppercase" id="customer" name="invoice">
        </div>
        <div>
            <label for="customer" class="font-bold">
                Customer:
            </label>
            <input type="customer" class="border py-1 px-2 rounded" placeholder="Enter customer name" id="customer-input"
                name="customer">
        </div>
        <div class="overflow-y-auto h-96 pr-2">
            @isset($customers)
                <ul id="customer-list">
                    @foreach ($customers as $customer)
                        <li class="border mt-1 px-2 py-1 rounded hover:bg-slate-50 cursor-pointer"
                            data-id="{{ $customer->id }}">{{ $customer->name }}
                        </li>
                    @endforeach
                </ul>
            @endisset
        </div>
        <div>
            <button type="submit" class="border bg-slate-50 px-2 py-1 rounded">Create</button>
            <a href="{{ route('dashboard.index') }}">
                <button type="submit" class="border  px-2 py-1 rounded">Cancel</button>
            </a>
        </div>
    </form>
@endsection

@push('scripts')
    @vite('resources/js/invoice/invoice-create.js')
@endpush
