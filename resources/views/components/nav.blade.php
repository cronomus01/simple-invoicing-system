<div>
    @switch($type)
        @case('content-nav')
            <nav class="flex justify-between">
                <ul>
                    <li>
                        <a href="Home"></a>
                    </li>
                </ul>
                <form method="POST" action={{ route('logout') }}>
                    @method('POST')
                    @csrf
                    <button type="submit" class="underline text-blue-400">Logout</button>
                </form>
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
