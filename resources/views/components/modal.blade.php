<div id={{ $id }} class="absolute inset-0 hidden items-center justify-center h-screen">
    <!-- When there is no desire, all things are at peace. - Laozi -->
    <div class="w-2/4 z-10 bg-white p-5 shadow-lg rounded-lg space-y-2">
        {{ $slot }}
        <menu class="flex space-x-2">
            <li><button class="border px-3 py-1 rounded mt-2 bg-white" id="save">Save</button></li>
            <li><button class="border px-3 py-1 rounded-sm mt-2 bg-slate-100" id="cancel">Cancel</button></li>
        </menu>
    </div>
    <aside class="absolute bg-slate-50 opacity-90 inset-0 z-0">
    </aside>
</div>
