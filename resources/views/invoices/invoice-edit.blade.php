@extends('layout.base')

@section('content')
    <h1 class="font-bold text-lg">Invoice Items</h1>
    <section class="mt-3">
        <form action={{ route('invoice.store') }} method="POST" class="border bg-white px-4 py-6" id="invoice-item">
            @method('PUT')
            @csrf
            <input type="hidden" value="" name="customer_id" id="customer-input-id">
            <fieldset class="flex gap-5">
                <section class="basis-full">
                    <h1 class="text-lg font-bold">Logo</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, qui? Quisquam
                        expedita
                        neque fugiat
                        magni
                        consequatur obcaecati, ipsum similique, dolores dolore quidem debitis. Quod perspiciatis error harum
                        repudiandae cumque voluptates.</p>
                </section>
                <section class="basis-full text-end">
                    <h1>
                        <span class="font-bold">Invoice: </span>
                        <span class="uppercase">{{ isset($invoice) ? Str::limit($invoice->invoice_number, 8, '') : '' }}
                        </span>
                    </h1>
                    <p>
                        <span class="font-bold">Date: </span>
                        <span class="uppercase">{{ isset($invoice) ? $invoice->invoice_date : '' }}
                        </span>
                    </p>
                </section>
            </fieldset>
            {{-- Customer --}}
            <fieldset class="mt-2 gap-5 relative max-w-fit">
                <h1 class="text-lg font-bold">Customer</h1>
                <label for="" class="block">Name:
                    <input type="text" id="customer-input"
                        value="{{ isset($invoice->customer->name) ? $invoice->customer->name : 'N/A' }}"
                        class="pointer-events-none customer-input">
                </label>
                <label for="" class="block">Email:
                    <input type="text" id="customer-input-email"
                        value="{{ isset($invoice->customer->name) ? $invoice->customer->email : 'N/A' }}"
                        class="pointer-events-none customer-input-email">
                </label>
                <menu class="absolute top-[0.2em] right-[-2em]">
                    <li>
                        <button type="button" id="edit-button">
                            <figure><img src="{{ asset('assets/icons/icons8-edit-96.png') }}" alt="edit icon"
                                    class="w-6"></figure>
                        </button>
                    </li>
                </menu>
            </fieldset>
            {{-- Items --}}
            <fieldset class="mt-2 gap-5">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right border">
                        <thead class="text-xs uppercase   ">
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
                        <tbody id="invoice-item-body">
                            <tr class="bg-white">
                                <td class="p-3">
                                    <input type="text" class="w-full h-full" name="type">
                                </td>
                                <td class="p-3">
                                    <input type="text" class="w-full h-full" name="product-service">
                                </td>
                                <td class="p-3">
                                    <input type="number" class="w-full h-full" value="0" name="quantity">
                                </td>
                                <td class="p-3">
                                    <input type="text" class="w-full h-full" name="base-price">
                                </td>
                                <td class="p-3">
                                    <input type="text" class="w-full h-full" value="0" disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button"
                        class="p-2 border mt-2 border-slate-300 rounded bg-slate-200 hover:border-slate-200  hover:bg-slate- shadow-sm text-sm"
                        id="add-item-btn">
                        Add new item
                    </button>
                </div>
            </fieldset>
        </form>
        <button type="submit" class="border px-3 py-1 rounded mt-2 bg-white" form="invoice-item">Save</button>
        <a href="{{ route('dashboard.index') }}">
            <button type="button" class="border px-3 py-1 rounded-sm mt-2 bg-slate-100" form="invoice-item">Cancel</button>
        </a>
    </section>
    <section>
        <x-modal id="modal">
            <label for="" class="block">Name:
                <input type="text" id="customer-input"
                    value="{{ isset($invoice->customer->name) ? $invoice->customer->name : 'N/A' }}"
                    class="pointer-events-none customer-input">
            </label>
            <label for="" class="block">Email:
                <input type="text" id="customer-input-email"
                    value="{{ isset($invoice->customer->name) ? $invoice->customer->email : 'N/A' }}"
                    class="pointer-events-none customer-input-email">
            </label>
            <x-customer-list :customers="$customers" />
        </x-modal>
    </section>
@endsection


@push('scripts')
    @vite('resources/js/invoice/invoice-create.js')
    @vite('resources/js/invoice/invoice-edit.js')
@endpush
