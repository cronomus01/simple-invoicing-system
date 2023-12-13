<div class="{{ $hidden ? 'absolute inset-0 bg-white screen:p-5 print:flex flex-col justify-between screen:hidden' : 'bg-white border p-5 relative' }}"
    id="print-design">
    <div>
        <section class="flex justify-between text-right items-start border-b pb-5">
            <figure class="">
                <img src="{{ asset('assets/icons/irefrans-cosme.png') }}" alt="irefrans cosme logo"
                    class="print:w-[13em] screen:w-[9em] rounded-full">
            </figure>
            <div>
                <h1 class="uppercase print:text-7xl screen:text-4xl mb-3 font-serif">Invoice</h1>
                <h1 class="uppercase print:text-3xl screen:text-lg mb-2">Yuniko Inc.</h1>
                <article class="leading-5 print:text-lg">
                    <p>460-1086, Kitazukamachi</p>
                    <p>+81 71-562-7817</p>
                    <p>hamada.mitsuru@tanabe.biz</p>
                </article>
            </div>
        </section>
        <section>
            <div class="mt-5 flex justify-between">
                <div>
                    <h1 class="uppercase print:text-3xl screen:text-xl mb-2">Customer</h1>
                    <article class="leading-5 print:text-lg">
                        <p class="">Name:
                            {{ isset($invoice->customer->name) ? $invoice->customer->name : 'N/A' }}
                        </p>
                        <p class="">Email:
                            {{ isset($invoice->customer->name) ? $invoice->customer->email : 'N/A' }}
                        </p>
                    </article>
                </div>
                <div class="text-right">
                    <h1 class="uppercase print:text-3xl screen:text-xl mb-2">Invoice</h1>
                    <article class="leading-5 print:text-lg">
                        <p class="">
                            <span>
                                No:
                            </span>
                            <span class="uppercase">
                                #{{ isset($invoice) ? Str::limit($invoice->invoice_number, '8', '') : '' }}

                            </span>
                        </p>
                        <p class="">Date:
                            {{ isset($invoice) ? date('F d, Y', strtotime($invoice->invoice_date)) : '' }}
                        </p>
                    </article>
                </div>
            </div>
            <div class="mt-10 pb-10 border-b">
                <table class="w-full text-left rtl:text-right">
                    <thead class="uppercase bg-slate-100 text-sm">
                        <tr>
                            <th scope="col" class="py-2 px-3 print:py-2">
                                Type
                            </th>
                            <th scope="col" class="py-2 px-3 print:py-2">
                                Product / Service
                            </th>
                            <th scope="col" class="py-2 px-3 print:py-2">
                                Quantity
                            </th>
                            <th scope="col" class="py-2 px-3 print:py-2">
                                Base Price
                            </th>
                            <th scope="col" class="py-2 px-3 print:py-2">
                                Subtotal
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="[&>*:not(:last-child)]:border-b">
                        @isset($invoice->items)
                            @foreach ($invoice->items as $item)
                                <tr class="bg-white">
                                    <td class="pl-4 py-2">
                                        {{ $item->type }}
                                    </td>
                                    <td class="pl-4 py-2">
                                        {{ $item->product_service }}
                                    </td>
                                    <td class="pl-4 py-2">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="pl-4 py-2">
                                        {{ number_format($item->base_price) }}
                                    </td>
                                    <td class="pl-4 py-2">
                                        {{ number_format($item->subtotal) }}
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-5">
                <table class="text-sm text-left rtl:text-right">
                    <tbody class="leading-6 uppercase text-sm">
                        <tr>
                            <td class="text-right font-bold pr-10">
                                Total:
                            </td>
                            <td class="text-right">
                                P{{ number_format($invoice->items->sum('subtotal')) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right font-bold pr-10">
                                Discount:
                            </td>
                            <td class="flex items-center justify-end">
                                {{ $invoice->items->sum('subtotal') == $discountedPrice ? 'N/A' : 'P' . number_format($discountedPrice, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right font-bold pr-10">
                                Vat:
                            </td>
                            <td class="text-right">
                                P{{ isset($invoice->total) ? number_format($invoice->total->vat, 2) : 0 }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right font-bold pr-10">
                                Grand Price:
                            </td>
                            <td class="text-right">
                                P{{ isset($invoice->total) ? number_format($invoice->total->grand_price, 2) : 0 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <section class="mt-5 text-center">
        <h1>All Rights Reserved</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi quod voluptates rem hic qui. Totam,
            architecto sit voluptatem sapiente nostrum ipsam beatae nam neque doloribus dicta eius amet maiores
            placeat.
        </p>
    </section>
    <div class="absolute inset-0 flex justify-center items-center text-9xl {{ !$payment ? 'print:hidden' : '' }}">
        <h1 class="uppercase font-extrabold text-slate-500 rotate-[-30deg] opacity-20">Paid</h1>
    </div>
</div>
