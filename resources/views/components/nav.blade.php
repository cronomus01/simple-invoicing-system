<div class="print:hidden">
    @switch($type)
        @case('content-nav')
            <nav class="py-3 px-3  border-b">
                <ul class="flex justify-between">
                    <li>
                        <p class="text-gray-500 font-semibold">
                            {{ ucwords(Str::replace('/', ' / ', Str::replaceFirst('/', '', Str::replace(Request::root(), '', Request::url())))) }}
                        </p>
                    </li>
                    <li>
                        <form method="POST" action={{ route('logout') }}>
                            @method('POST')
                            @csrf
                            <button type="submit" class="text-blue-400">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        @break

        @case('aside-nav')
            <figure class="p-1 flex justify-center">
                <div class="p-2 bg-white rounded-full">
                    <img src="{{ asset('assets/icons/irefrans-cosme.png') }}"
                        alt="irefrans-cosme.png"aria-details="Capital I and C that intersects the bottom I and side of the C with Irefrans Cosme in the middle"
                        class="w-8 rounded-full bg-white">
                </div>
            </figure>
        @break

        @default
    @endswitch
</div>
