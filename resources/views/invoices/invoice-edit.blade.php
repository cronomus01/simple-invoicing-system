@extends('layout.base')

@section('content')
    <section class="mx-5">
        <form action={{ route('invoices.store') }} method="POST" class="border bg-slate-50 px-10 py-5 rounded-lg"
            id="invoice-item">
            @method('PUT')
            @csrf
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
                <section class="basis-full">
                    <h2>Invoice: {{ isset($invoice) ? $invoice->invoice_number : '' }}</h2>
                    <p>Date: {{ isset($invoice) ? $invoice->invoice_date : '' }}</p>
                </section>
            </fieldset>
            {{-- Items --}}
            <fieldset class="mt-2 gap-5">
                <h1 class="text-lg font-bold">Invoices</h1>
                <div class="relative overflow-x-auto border-2 border-slate-500">
                    <table class="w-full text-sm text-left rtl:text-right">
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
                                <th scope="row" class="font-medium whitespace-nowrap p-2">
                                    <input type="text" class="w-full h-full px-2 py-4" name="type">
                                </th>
                                <td class="px-6 py-4">
                                    <input type="text" class="w-full h-full px-2 py-4" name="product-service">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="number" class="w-full h-full px-2 py-4" value="0" name="quantity">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" class="w-full h-full px-2 py-4" name="base-price">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" class="w-full h-full px-2 py-4" value="0" disabled>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-white">
                                <td>
                                    <button type="button"
                                        class="p-2 border border-slate-300 rounded bg-slate-200 hover:border-slate-200  hover:bg-slate- shadow-sm"
                                        id="add-item-btn">
                                        Add new item
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </fieldset>
        </form>
        <button type="submit" class="border px-3 py-1 rounded-sm bg-green-100 mt-2" form="invoice-item">Save</button>
        <button type="submit" class="border px-3 py-1 rounded-sm mt-2" form="invoice-item">Cancel</button>
    </section>
@endsection


@push('scripts')
    @vite('resources/js/edit-invoice.js')
@endpush
