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
            <label for="customer">
                <span class="font-bold">Customer:</span>
                <input type="customer" class="border py-1 px-2 rounded customer-input" placeholder="Enter customer name"
                    id="customer-input" name="customer">
            </label>
        </div>
        <div>
            <label for="" class="block">
                <span class="font-bold">Email:</span>
                <input type="text" class="border py-1 px-2 rounded customer-input-email" id="customer-input-email"
                    value="{{ isset($invoice->customer->name) ? $invoice->customer->email : '' }}"
                    class="pointer-events-none" placeholder="Customer email">
            </label>
        </div>
        <x-customer-list :customers="$customers" />
        <div>
            <button type="submit" class="border bg-slate-50 px-2 py-1 rounded">Create</button>
            <a href="{{ route('dashboard.index') }}">
                <button type="button" class="border  px-2 py-1 rounded">Cancel</button>
            </a>
        </div>
    </form>
@endsection

@push('scripts')
    @vite('resources/js/invoice/invoice-create.js')
@endpush
