@extends('layout.base', ['invoice' => $invoice])

@section('content')
    <section class="mt-5">
        <form action={{ route('invoice.store') }} method="POST" class="flex flex-col gap-1 border px-4 py-6 bg-white">
            @method('POST')
            @csrf
            <input type="hidden" value="" name="customer_id" id="customer-input-id">
            <div>
                <label for="invoice-number" class="font-bold">
                    Invoice:
                </label>
                <input type="text" value="{{ isset($invoice_number) ? Str::limit($invoice_number, '8', '') : 'N/A' }}"
                    class="pointer-events-none uppercase" id="customer" name="invoice">
            </div>
            <div>
                <label for="customer">
                    <span class="font-bold">Customer:</span>
                    <input type="customer" class="border px-2 rounded customer-input" placeholder="Enter customer name"
                        id="customer-input" name="customer">
                </label>
            </div>
            <div>
                <label for="" class="block">
                    <span class="font-bold">Email:</span>
                    <input type="text" class="border px-2 rounded customer-input-email" id="customer-input-email"
                        value="" class="pointer-events-none" placeholder="Customer email">
                </label>
            </div>
            <div class="mt-3">
                <x-customer-list :customers="$customers" />
            </div>
            <div class="mt-3">
                <button type="submit" class="border bg-slate-100 px-4 py-1 rounded">Create</button>
                <a href="{{ route('dashboard.index') }}">
                    <button type="button" class="border  px-4 py-1 rounded">Cancel</button>
                </a>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
    @vite('resources/js/invoice/invoice-create.js')
@endpush
