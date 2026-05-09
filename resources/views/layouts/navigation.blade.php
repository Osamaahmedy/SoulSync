<nav x-data="{ open: false }" style="background: rgba(17, 24, 39, 0.6); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.06);">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" style="text-decoration: none; font-weight: 900; font-size: 1.5rem; background: linear-gradient(135deg, #38bdf8, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        SoulSync
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-8 sm:flex">
                    <a href="{{ route('home') }}" style="color: #64748b; text-decoration: none; padding: 0.5rem 0.75rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; transition: all 0.2s;" onmouseover="this.style.color='white';this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">
                        🌍 Community
                    </a>
                    <a href="{{ route('dashboard') }}" style="color: {{ request()->routeIs('dashboard') ? 'white' : '#64748b' }}; text-decoration: none; padding: 0.5rem 0.75rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; transition: all 0.2s; {{ request()->routeIs('dashboard') ? 'background: rgba(255,255,255,0.06);' : '' }}" onmouseover="this.style.color='white';this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.color='{{ request()->routeIs('dashboard') ? 'white' : '#64748b' }}'">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}" style="color: {{ request()->routeIs('profile.edit') ? 'white' : '#64748b' }}; text-decoration: none; padding: 0.5rem 0.75rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; transition: all 0.2s; {{ request()->routeIs('profile.edit') ? 'background: rgba(255,255,255,0.06);' : '' }}" onmouseover="this.style.color='white';this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.color='{{ request()->routeIs('profile.edit') ? 'white' : '#64748b' }}'">
                        ⚙️ Profile
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button style="display: inline-flex; align-items: center; padding: 0.5rem 0.75rem; border: 1px solid rgba(255,255,255,0.06); border-radius: 0.75rem; color: #94a3b8; background: rgba(255,255,255,0.04); font-size: 0.875rem; font-weight: 500; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#94a3b8'">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg style="width: 1rem; height: 1rem; fill: currentColor;" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            ⚙️ {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" style="padding: 0.5rem; border-radius: 0.5rem; color: #94a3b8; background: none; border: none; cursor: pointer;">
                    <svg style="width: 1.5rem; height: 1.5rem;" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="border-top: 1px solid rgba(255,255,255,0.06);">
        <div class="pt-2 pb-3 space-y-1" style="padding: 0.75rem;">
            <a href="{{ route('home') }}" style="display: block; padding: 0.5rem 0.75rem; color: #94a3b8; text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem;">🌍 Community</a>
            <a href="{{ route('dashboard') }}" style="display: block; padding: 0.5rem 0.75rem; color: #94a3b8; text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem;">📊 Dashboard</a>
            <a href="{{ route('profile.edit') }}" style="display: block; padding: 0.5rem 0.75rem; color: #94a3b8; text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem;">⚙️ Profile</a>
        </div>

        <div style="padding: 0.75rem; border-top: 1px solid rgba(255,255,255,0.06);">
            <div style="padding: 0.5rem 0.75rem;">
                <div style="font-weight: 600; color: #f1f5f9;">{{ Auth::user()->name }}</div>
                <div style="font-size: 0.75rem; color: #64748b;">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="display: block; padding: 0.5rem 0.75rem; color: #f87171; text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem;">
                        🚪 Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
