<div class="print:hidden">
    @switch($type)
        @case('content-nav')
            <nav>
                <ul class="flex justify-between">
                    <li>
                        {{-- {{  }} --}}
                        {{ ucwords(Str::replace('/', ' / ', Str::replaceFirst('/', '', Str::replace(Request::root(), '', Request::url())))) }}
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
            <nav>
                <h1>Logo</h1>
            </nav>
        @break

        @default
    @endswitch
</div>
