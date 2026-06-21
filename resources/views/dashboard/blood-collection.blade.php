<x-app-layout>
<div class="max-w-[1400px] mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-ink">Collection</h1>
            <p class="text-xs text-ink-faint mt-0.5">Ongoing collection sessions &amp; drives</p>
        </div>
        <button class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Start Collection
        </button>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="stat-card">
            <div class="stat-card__label">Active Camps</div>
            <div class="stat-card__value">{{ $activeCamps }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label">Donors Today</div>
            <div class="flex items-end gap-3">
                <div class="stat-card__value">{{ $donorsToday }}</div>
                <span class="stat-card__badge bg-ok/10 text-ok mb-1">+12%</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label">Bags Collected</div>
            <div class="stat-card__value">{{ $bagsCollected }}</div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Active Sessions</span>
            <span class="badge badge-ok"><span class="pulse-dot bg-ok"></span>Live</span>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Donor</th>
                        <th class="text-center">Type</th>
                        <th class="font-mono text-center">RFID</th>
                        <th>Started</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                        ['name'=>'Rahul Sharma','type'=>'O+', 'rfid'=>'BB2026101','time'=>'10:15 AM','loc'=>'In-House Center','status'=>'In Progress','badge'=>'badge-info'],
                        ['name'=>'Anita Desai', 'type'=>'A-', 'rfid'=>'BB2026102','time'=>'10:30 AM','loc'=>'In-House Center','status'=>'Completed',  'badge'=>'badge-ok'],
                        ['name'=>'Karan Patel', 'type'=>'B+', 'rfid'=>'BB2026103','time'=>'11:00 AM','loc'=>'City Mall Camp', 'status'=>'Drawing',    'badge'=>'badge-warn'],
                    ] as $c)
                    <tr>
                        <td class="font-semibold text-ink text-sm">{{ $c['name'] }}</td>
                        <td class="text-center"><span class="font-mono font-bold text-brand">{{ $c['type'] }}</span></td>
                        <td class="text-center"><span class="font-mono text-xs text-ink-faint">{{ $c['rfid'] }}</span></td>
                        <td class="text-ink-faint text-xs font-mono">{{ $c['time'] }}</td>
                        <td class="text-ink-muted text-sm">{{ $c['loc'] }}</td>
                        <td><span class="badge {{ $c['badge'] }}">{{ $c['status'] }}</span></td>
                        <td class="text-right">
                            <button class="btn-ghost text-xs py-1 px-3">Details</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
