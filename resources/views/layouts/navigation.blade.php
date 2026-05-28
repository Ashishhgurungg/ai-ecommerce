<nav x-data="{ open: false }" class="bg-[#1b2233] text-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/my-logo.svg') }}"
                             alt="My Logo"
                             class="block h-10 w-auto" />
                        <span class="ms-3 font-semibold text-lg hidden sm:inline hover:text-orange-400">AI</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-orange-400">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/all-galleries')" :active="request()->is('all-galleries')" class="text-white hover:text-orange-400">
                        {{ __('All Galleries') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/all-articles')" :active="request()->is('all-articles')" class="text-white hover:text-orange-400">
                        {{ __('All Articles') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/all-services')" :active="request()->is('all-services')" class="text-white hover:text-orange-400">
                        {{ __('All services') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/gallery-form')" :active="request()->is('gallery-form')" class="text-white hover:text-orange-400">
                        {{ __('Create galleries') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/add-services')" :active="request()->is('add-services')" class="text-white hover:text-orange-400">
                        {{ __('Create services') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/article-form')" :active="request()->is('article-form')" class="text-white hover:text-orange-400">
                        {{ __('Create Articles') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/inquiries')" :active="request()->is('inquiries')" class="text-white hover:text-orange-400">
                        {{ __('Inquiries') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/add-events')" :active="request()->is('add-events')" class="text-white hover:text-orange-400">
                        {{ __('Add Events') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/all-events')" :active="request()->is('all-events')" class="text-white hover:text-orange-400">
                        {{ __('All Events') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-white hover:opacity-90 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-2">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-800">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-800">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:opacity-90 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#1b2233]">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->is('dashboard')" class="text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->is('dashboard')" class="text-white">
                {{ __('Articles') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->is('dashboard')" class="text-white">
                {{ __('Gallery') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->is('dashboard')" class="text-white">
                {{ __('Inquiries') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-indigo-500 px-4">
            <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-indigo-100">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" class="text-white"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
