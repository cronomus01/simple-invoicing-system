<div class="overflow-y-auto h-96 pr-2">
    @isset($customers)
        <ul id="customer-list">
            @foreach ($customers as $customer)
                <li class="border mt-1 px-2 py-1 rounded bg-white hover:bg-slate-50 cursor-pointer"
                    data-id="{{ $customer->id }}" data-email="{{ $customer->email }}">
                    {{ $customer->name }}
                </li>
            @endforeach
        </ul>
    @endisset
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
</div>
