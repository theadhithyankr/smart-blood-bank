<aside class="fixed inset-y-0 left-0 w-60 bg-surface-card border-r border-surface-border z-30 flex flex-col hidden lg:flex select-none">
    <!-- Brand -->
    <div class="h-16 flex items-center px-5" style="border-bottom: 1px solid #252a3a;">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
            <div class="w-7 h-7 rounded-lg bg-brand flex items-center justify-center flex-shrink-0" style="box-shadow: 0 0 16px rgba(230,57,70,0.4);">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </div>
            <div>
                <div class="text-[13px] font-bold text-ink leading-none">Bagmo</div>
                <div class="text-[10px] text-ink-faint font-medium tracking-wider leading-none mt-0.5">BLOOD TRACKER</div>
            </div>
        </a>
    </div>

    <!-- Nav -->
    <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-0.5">
        <!-- Section Label -->
        <div class="px-3 mb-3 text-[9px] font-bold uppercase tracking-[0.15em] text-ink-faint/60">Operations</div>

        @php
            $isDashboard  = request()->routeIs('dashboard');
            $isDonor      = request()->routeIs('admin.donor-registration');
            $isCollection = request()->routeIs('admin.blood-collection');
            $isTesting    = request()->routeIs('admin.testing');
            $isInventory  = request()->routeIs('admin.inventory');
            $isDistrib    = request()->routeIs('admin.distribution');
            $isTemp       = request()->routeIs('admin.temperature');
        @endphp

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="nav-item {{ $isDashboard ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            Overview
        </a>

        <!-- Donor Registration -->
        <a href="{{ route('admin.donor-registration') }}" class="nav-item {{ $isDonor ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Donor Registry
        </a>

        <!-- Blood Collection -->
        <a href="{{ route('admin.blood-collection') }}" class="nav-item {{ $isCollection ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.686 2 6 5.686 6 9.5 6 14.09 9.5 18.5 12 22c2.5-3.5 6-7.91 6-12.5C18 5.686 15.314 2 12 2z"/></svg>
            Collection
        </a>

        <!-- Testing & Screening -->
        <a href="{{ route('admin.testing') }}" class="nav-item {{ $isTesting ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6l1 7H8L9 3zM8 10l-3 11h14L16 10H8z"/></svg>
            Screening Lab
        </a>

        <div class="px-3 pt-4 mb-3 text-[9px] font-bold uppercase tracking-[0.15em] text-ink-faint/60">Logistics</div>

        <!-- Inventory -->
        <a href="{{ route('admin.inventory') }}" class="nav-item {{ $isInventory ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
            Inventory
        </a>

        <!-- Distribution -->
        <a href="{{ route('admin.distribution') }}" class="nav-item {{ $isDistrib ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l4 1m6-1l4-1m0 0V9a1 1 0 00-1-1h-2.5"/></svg>
            Distribution
        </a>

        <!-- Temperature -->
        <a href="{{ route('admin.temperature') }}" class="nav-item {{ $isTemp ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 9a3 3 0 114.146 2.77A1 1 0 0012 12.8V15m0 0v1m0-1a3 3 0 000 0"/><circle cx="12" cy="19" r="3"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v10"/></svg>
            IoT Sensors
        </a>
    </nav>

    <!-- User footer -->
    <div class="p-4" style="border-top: 1px solid #252a3a;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-ink-faint hover:bg-surface-raised hover:text-ink-muted transition group">
                <svg class="w-4 h-4 text-ink-faint/60 group-hover:text-ink-faint transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Sign Out
            </button>
        </form>
    </div>
</aside>
