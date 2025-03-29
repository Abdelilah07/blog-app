<nav x-data="{ open: false }" class="navbar bg-base-100 shadow-lg">
    <div class="navbar-start">
        <!-- Logo -->
        <div class="px-2 mx-2">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="h-9 w-auto" />
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden lg:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="btn btn-ghost normal-case">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('publications.index')" :active="request()->routeIs('publications.*')" class="btn btn-ghost normal-case">
                {{ __('Publications') }}
            </x-nav-link>
        </div>
    </div>

    <div class="navbar-end">
        <!-- Settings Dropdown -->
        <div class="hidden lg:flex">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost normal-case">
                    @auth
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    @endauth
                </label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <div class="lg:hidden">
            <button @click="open = !open" class="btn btn-square btn-ghost">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden lg:hidden absolute top-16 left-0 right-0 bg-base-100 shadow-lg">
        <ul class="menu menu-compact">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    {{ __('Dashboard') }}
                </a>
            </li>
            <li>
                <a href="{{ route('publications.index') }}" class="{{ request()->routeIs('publications.*') ? 'active' : '' }}">
                    {{ __('Publications') }}
                </a>
            </li>
            @auth
            <div class="divider"></div>
            <div class="px-4 py-2">
                <div class="font-medium">{{ Auth::user()->name }}</div>
                <div class="text-sm opacity-60">{{ Auth::user()->email }}</div>
            </div>
            <li><a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </li>
            @endauth
        </ul>
    </div>
</nav>
