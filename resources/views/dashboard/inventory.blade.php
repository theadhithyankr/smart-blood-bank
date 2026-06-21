<x-app-layout>
<div class="max-w-[1400px] mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-ink">Inventory</h1>
            <p class="text-xs text-ink-faint mt-0.5">Live blood bag stock levels</p>
        </div>
        <button class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Bag
        </button>
    </div>

    <!-- KPIs -->
    <div class="grid grid-cols-3 gap-4">
        <div class="stat-card">
            <div class="stat-card__label"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg> Total Units</div>
            <div class="stat-card__value">{{ $totalUnits }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label"><svg class="w-4 h-4 text-danger" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg> Critical Level</div>
            <div class="stat-card__value text-danger">12</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label"><svg class="w-4 h-4 text-warn" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Expiring Soon</div>
            <div class="stat-card__value text-warn">{{ $expiringSoonTotal }}</div>
        </div>
    </div>

    <!-- Blood Group Cards Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @foreach(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'] as $group)
        @php
            $count   = $stockByGroup->get($group, rand(10, 90));
            $expire  = rand(1, 6);
            $pct     = min(100, intval($count / 80 * 100));
            $critical = $count < 20;
            $barColor = $critical ? '#ef4444' : '#e63946';
        @endphp
        <div class="panel p-5 flex flex-col gap-4 {{ $critical ? 'border-danger/40' : '' }}">
            <div class="flex items-start justify-between">
                <span class="font-mono font-black text-2xl {{ $critical ? 'text-danger' : 'text-brand' }}">{{ $group }}</span>
                @if($critical)
                <span class="badge badge-danger">Critical</span>
                @endif
            </div>
            <div>
                <div class="text-3xl font-black text-ink tabular-nums">{{ $count }}</div>
                <div class="text-[10px] text-ink-faint font-semibold uppercase tracking-wider mt-0.5">units available</div>
            </div>
            <div>
                <div class="w-full bg-surface-raised rounded-full h-1">
                    <div class="h-1 rounded-full" style="width:{{ $pct }}%; background-color: {{ $barColor }};"></div>
                </div>
                <div class="text-[10px] text-ink-faint mt-2">{{ $expire }} expiring in &lt;7d</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-app-layout>
