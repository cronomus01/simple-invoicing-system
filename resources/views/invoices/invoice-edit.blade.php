@extends('layout.base')

@section('content')
    <section class="mt-3">
        <form action={{ route('invoice.update', ['invoice' => isset($invoice->id) ? $invoice->id : 0]) }} method="POST"
            class="border bg-white px-4 py-6" id="invoice-item">
            @method('PUT')
            @csrf
            <input type="hidden" name="customer_id" id="customer-input-id"
                value="{{ isset($invoice->id) ? $invoice->customer->id : 0 }}">
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
            <fieldset class="mt-2 gap-5 relative max-w-fit space-y-2">
                <h1 class="text-lg font-bold">Customer</h1>
                <label for="" class="block">Name:
                    <input type="text" id="customer-input"
                        value="{{ isset($invoice->customer->name) ? $invoice->customer->name : 'N/A' }}"
                        class="border px-2 py-1 rounded pointer-events-none customer-input">
                </label>
                <label for="" class="block">Email:
                    <input type="text" id="customer-input-email"
                        value="{{ isset($invoice->customer->name) ? $invoice->customer->email : 'N/A' }}"
                        class="border px-2 py-1 rounded pointer-events-none customer-input-email">
                </label>
                <menu class="absolute top-0 right-[-2em]">
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
                        <thead class="text-xs uppercase bg-slate-200">
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
                        <tbody id="table-body">
                            @isset($invoice->items)
                                @foreach ($invoice->items as $item)
                                    <input type="hidden" class="w-full h-full" name="invoice_item[]"
                                        value="{{ $item->id }}">
                                    <tr class="bg-white">
                                        <td class="p-3">
                                            <input type="text" class="w-full h-full" name="type[]"
                                                value="{{ $item->type }}">
                                        </td>
                                        <td class="p-3">
                                            <input type="text" class="w-full h-full" name="product_service[]"
                                                value="{{ $item->product_service }}">
                                        </td>
                                        <td class="p-3">
                                            <input type="number" class="w-full h-full quantity" value={{ $item->quantity }}
                                                name="quantity[]">
                                        </td>
                                        <td class="p-3">
                                            <input type="text" class="w-full h-full base-price" name="base_price[]"
                                                value="{{ $item->base_price }}">
                                        </td>
                                        <td class="p-3">
                                            <input type="text" class="w-full h-full" value="{{ $item->subtotal }}" disabled>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                    <button type="button"
                        class="p-2 border mt-2 border-slate-300 rounded bg-slate-200 hover:border-slate-200  hover:bg-slate- shadow-sm text-sm"
                        id="add-item-btn">
                        Add new item
                    </button>
                </div>
            </fieldset>
            <fieldset class="mt-2">
                <h1 class="font-bold text-lg">Total</h1>
                <table class="w-[20rem] text-sm text-left rtl:text-right border">
                    <thead class="text-xs uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-3 border">
                                Discount
                            </th>
                            <th class="border">
                                <input type="text" class="w-full h-full" name="discount">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3 border">
                                Vat
                            </th>
                            <th class="border">
                                <input type="text" class="w-full h-full" name="var">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3 border">
                                Grand Price
                            </th>
                            <th class="border px-2">
                                P{{ $invoice->total->grand_price }}
                            </th>
                        </tr>
                    </thead>

                </table>
            </fieldset>
        </form>
        <button type="submit" class="border px-3 py-1 rounded mt-2 bg-white" form="invoice-item">Save</button>
        <a href="{{ route('dashboard.index') }}">
            <button type="button" class="border px-3 py-1 rounded-sm mt-2 bg-slate-100"
                form="invoice-item">Cancel</button>
        </a>
    </section>
    <section>
        <x-modal id="modal">
            <h2 class="text-lg font-bold">Customer</h2>
            <label for="" class="block">Name:
                <input type="text" id="customer-input"
                    value="{{ isset($invoice->customer->name) ? $invoice->customer->name : 'N/A' }}"
                    class="border px-2 py-1 rounded pointer-events-none customer-input">
            </label>
            <label for="" class="block">Email:
                <input type="text" id="customer-input-email"
                    value="{{ isset($invoice->customer->name) ? $invoice->customer->email : 'N/A' }}"
                    class="border px-2 py-1 rounded pointer-events-none customer-input-email">
            </label>
            <x-customer-list :customers="$customers" />
        </x-modal>
    </section>
@endsection


@push('scripts')
    @vite('resources/js/invoice/invoice-create.js')
    @vite('resources/js/invoice/invoice-edit.js')
@endpush
