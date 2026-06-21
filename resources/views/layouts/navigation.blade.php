<header class="h-14 flex items-center justify-between px-5 sticky top-0 z-20 bg-surface-card/80 backdrop-blur-md" style="border-bottom: 1px solid #252a3a;">
    <!-- Mobile logo -->
    <div class="flex items-center gap-3 lg:hidden">
        <div class="w-6 h-6 rounded-md bg-brand flex items-center justify-center">
            <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>
        <span class="text-sm font-bold text-ink">Bagmo</span>
    </div>

    <!-- Search -->
    <div class="hidden lg:flex flex-1 max-w-sm">
        <div class="relative w-full">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-faint" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" placeholder="Search bags, donors…" class="w-full bg-surface-raised border border-surface-border text-ink text-sm rounded-xl pl-9 pr-4 py-2 placeholder-ink-faint focus:outline-none focus:ring-2 focus:ring-brand/30 focus:border-brand/40 transition">
        </div>
    </div>

    <!-- Right -->
    <div class="flex items-center gap-2">
        <!-- Notification -->
        <button class="relative p-2 rounded-xl text-ink-faint hover:bg-surface-raised hover:text-ink-muted transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            <span class="absolute top-2 right-2 w-1.5 h-1.5 rounded-full bg-brand"></span>
        </button>

        <!-- Divider -->
        <div class="w-px h-6 bg-surface-border mx-1"></div>

        <!-- Profile -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center gap-2.5 px-2.5 py-1.5 rounded-xl hover:bg-surface-raised transition">
                    <div class="w-7 h-7 rounded-lg bg-brand/20 border border-brand/30 flex items-center justify-center text-brand font-bold text-xs">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-medium text-ink-muted hidden sm:block">{{ Auth::user()->name }}</span>
                    <svg class="w-3.5 h-3.5 text-ink-faint" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Sign Out</x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
