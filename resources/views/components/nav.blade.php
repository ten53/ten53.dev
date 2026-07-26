@php
    $links = [
        [
            'label' => 'Home',
            'route' => 'home',
            'active' => request()->routeIs('home'),
        ],
        [
            'label' => 'Travel',
            'route' => 'travel.index',
            'active' => request()->routeIs('travel.*'),
        ],
        [
            'label' => 'Projects',
            'route' => 'projects.index',
            'active' => request()->routeIs('projects.*'),
        ],
        [
            'label' => 'Notes',
            'route' => 'notes.index',
            'active' => request()->routeIs('notes.*'),
        ],
    ];
@endphp

<header
    class="relative z-20 border-b border-base-300/70
           bg-base-100/70 backdrop-blur-md"
>
    <nav
        class="navbar mx-auto min-h-16 max-w-6xl px-6"
        aria-label="Main navigation"
    >
        {{-- Logo --}}
        <div class="navbar-start">
            <a
                href="{{ route('home') }}"
                class="text-xl font-bold tracking-tight transition-opacity
                       hover:opacity-75"
            >
                ten<span class="text-primary">53</span>
            </a>
        </div>

        {{-- Desktop navigation --}}
        <div class="navbar-center hidden md:flex">
            <ul class="menu menu-horizontal gap-1 px-1">
                @foreach ($links as $link)
                    <li>
                        <a
                            href="{{ route($link['route']) }}"
                            @class([
                                'font-medium',
                                'bg-base-300 text-base-content' => $link['active'],
                            ])
                            @if ($link['active'])
                                aria-current="page"
                            @endif
                        >
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Status and mobile menu --}}
        <div class="navbar-end gap-2">
            <div class="hidden items-center gap-2 sm:flex">
                <span class="status status-success"></span>

                <span class="text-sm text-base-content/60">
                    Work in progress
                </span>
            </div>

            {{-- Mobile dropdown --}}
            <div class="dropdown dropdown-end md:hidden">
                <button
                    type="button"
                    tabindex="0"
                    class="btn btn-ghost btn-square"
                    aria-label="Open navigation menu"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <ul
                    tabindex="0"
                    class="menu dropdown-content z-50 mt-3 w-52 rounded-box
                           border border-base-300 bg-base-100 p-2 shadow-lg"
                >
                    @foreach ($links as $link)
                        <li>
                            <a
                                href="{{ route($link['route']) }}"
                                @class([
                                    'font-medium',
                                    'active' => $link['active'],
                                ])
                                @if ($link['active'])
                                    aria-current="page"
                                @endif
                            >
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>
