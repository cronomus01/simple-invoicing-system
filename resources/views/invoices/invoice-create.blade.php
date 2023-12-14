@extends('layout.base', ['invoice' => $invoice])

@section('content')
    <section class="mt-5 flex justify-center">
        <form action={{ route('invoice.store') }} method="POST"
            class="w-[30em] flex flex-col gap-1 border px-4 py-6 bg-white">
            @method('POST')
            @csrf
            <input type="hidden" value="" name="customer_id" id="customer-input-id">

            <fieldset class="flex justify-between">
                <div>
                    <h1 class="uppercase print:text-3xl screen:text-xl mb-2">Customer</h1>
                    <table class="space-y-1">
                        <tbody>
                            <tr>

                                <td>
                                    <label for="customer">
                                        <span>Name:</span>
                                    </label>

                                </td>
                                <td>
                                    <input type="customer" class="border px-2 rounded customer-input"
                                        placeholder="Enter customer name" id="customer-input" name="customer">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="" class="block">
                                        <span>Email:</span>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" class="border px-2 rounded customer-input-email"
                                        id="customer-input-email" value="" class="pointer-events-none"
                                        placeholder="Customer email">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <h1 class="uppercase print:text-3xl screen:text-xl mb-2">Invoice</h1>
                    <article class="leading-5 print:text-lg">
                        <label for="invoice-number">
                            No:
                            <input type="hidden" value="{{ isset($invoice_number) ? $invoice_number : 'N/A' }}"
                                class="pointer-events-none uppercase" id="customer" name="invoice">
                        </label>
                        <span class="uppercase">
                            #{{ isset($invoice_number) ? Str::limit($invoice_number, '8', '') : 'N/A' }}

                        </span>
                        <p class="">Date:
                            {{ date('F d, Y', strtotime(now())) }}
                        </p>
                    </article>
                </div>
            </fieldset>
            <fieldset class="mt-3">
                <x-customer-list :customers="$customers" />
            </fieldset>
            <menu class="mt-3">
                <li>
                    <button type="submit" class="border bg-slate-100 px-4 py-1 rounded">Create</button>
                    <a href="{{ route('dashboard.index') }}">
                        <button type="button" class="border  px-4 py-1 rounded">Cancel</button>
                    </a>
                </li>
            </menu>
        </form>
    </section>
@endsection

@push('scripts')
    @vite('resources/js/invoice/invoice-create.js')
@endpush
