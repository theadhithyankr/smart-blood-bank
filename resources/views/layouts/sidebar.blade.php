<div class="fixed inset-y-0 left-0 w-64 bg-white shadow-md z-20 flex flex-col hidden lg:flex">
    <!-- Logo Area -->
    <div class="h-16 flex items-center px-6 border-b border-slate-100">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <img src="{{ asset('images/bagmo-logo.png') }}" alt="Bagmo Logo" class="h-8">
            <span class="ml-3 font-bold text-lg text-slate-800 tracking-tight">Bagmo Tracker</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <!-- Dashboard -->
        @php $isDashboard = request()->routeIs('dashboard'); @endphp
        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 {{ $isDashboard ? 'bg-red-50 text-red-600 border-l-4 border-red-500' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg group font-medium transition">
            <!-- Icon: Grid (Dashboard) -->
            <svg class="w-5 h-5 mr-3 {{ $isDashboard ? 'text-red-500' : 'text-slate-400 group-hover:text-slate-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Dashboard
        </a>

        <!-- Donor Registration -->
        <a href="#" class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg group font-medium transition">
            <!-- Icon: User Add -->
            <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Donor Registration
        </a>

        <!-- Blood Collection -->
        <a href="#" class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg group font-medium transition">
            <!-- Icon: Blood Drop Outline -->
            <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg>
            Blood Collection
        </a>

        <!-- Testing & Screening -->
        @php $isTesting = request()->routeIs('admin.testing'); @endphp
        <a href="{{ route('admin.testing') }}" class="flex items-center px-3 py-2.5 {{ $isTesting ? 'bg-red-50 text-red-600 border-l-4 border-red-500' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg group font-medium transition">
            <!-- Icon: Beaker (Testing) -->
            <svg class="w-5 h-5 mr-3 {{ $isTesting ? 'text-red-500' : 'text-slate-400 group-hover:text-slate-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            Testing & Screening
        </a>

        <!-- Inventory Management -->
        @php $isInventory = request()->routeIs('admin.inventory'); @endphp
        <a href="{{ route('admin.inventory') }}" class="flex items-center px-3 py-2.5 {{ $isInventory ? 'bg-red-50 text-red-600 border-l-4 border-red-500' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg group font-medium transition">
            <!-- Icon: Cube (Inventory) -->
            <svg class="w-5 h-5 mr-3 {{ $isInventory ? 'text-red-500' : 'text-slate-400 group-hover:text-slate-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            Inventory Management
        </a>

        <!-- Distribution -->
        @php $isDistribution = request()->routeIs('admin.distribution'); @endphp
        <a href="{{ route('admin.distribution') }}" class="flex items-center px-3 py-2.5 {{ $isDistribution ? 'bg-red-50 text-red-600 border-l-4 border-red-500' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg group font-medium transition">
            <!-- Icon: Truck (Distribution) -->
            <svg class="w-5 h-5 mr-3 {{ $isDistribution ? 'text-red-500' : 'text-slate-400 group-hover:text-slate-600' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            Distribution
        </a>

        <!-- Temperature -->
        <a href="#" class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg group font-medium transition">
            <!-- Icon: Thermometer -->
            <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            Temperature
        </a>
    </nav>
</div>
