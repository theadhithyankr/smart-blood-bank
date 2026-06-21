<x-app-layout>
<div class="max-w-[1400px] mx-auto space-y-6">

    <!-- Flash messages -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="flex items-center gap-3 px-5 py-3 rounded-xl bg-ok/10 border border-ok/30 text-ok text-sm font-medium">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="flex items-center gap-3 px-5 py-3 rounded-xl bg-danger/10 border border-danger/30 text-danger text-sm font-medium">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('error') }}
    </div>
    @endif

    <!-- Page header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-ink tracking-tight">Overview</h1>
            <p class="text-xs text-ink-faint mt-0.5">{{ now()->format('l, d F Y') }} &middot; Real-time supply chain</p>
        </div>
        <span class="flex items-center gap-2 text-xs font-semibold text-ok bg-ok/10 px-3 py-1.5 rounded-full">
            <span class="pulse-dot bg-ok"></span>
            All systems nominal
        </span>
    </div>

    <!-- KPI Strip -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
        @foreach([
            ['label' => 'Refrigerators', 'value' => $refrigerators, 'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="5" y1="10" x2="19" y2="10"/></svg>', 'color' => 'text-ink-muted', 'delta' => null],
            ['label' => 'Units in Stock', 'value' => $totalStock, 'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>', 'color' => 'text-ink-muted', 'delta' => '+4%'],
            ['label' => 'PRBC Expiring', 'value' => $expiringSoonCount, 'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'color' => $expiringSoonCount > 0 ? 'text-warn' : 'text-ink-muted', 'delta' => null],
            ['label' => 'Active Requests', 'value' => $activeRequestsCount, 'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>', 'color' => 'text-ink-muted', 'delta' => null],
            ['label' => 'Pending', 'value' => $pendingRequestsCount, 'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'color' => 'text-warn', 'delta' => null],
        ] as $kpi)
        <div class="stat-card">
            <div class="stat-card__label">
                <span class="{{ $kpi['color'] }}">{!! $kpi['icon'] !!}</span>
                {{ $kpi['label'] }}
            </div>
            <div class="flex items-end justify-between gap-2">
                <div class="stat-card__value">{{ $kpi['value'] }}</div>
                @if($kpi['delta'])
                    <span class="stat-card__badge bg-ok/10 text-ok mb-1">{{ $kpi['delta'] }}</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Main Content Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        <!-- Blood Inventory Table -->
        <div class="lg:col-span-2 panel flex flex-col">
            <div class="panel-header">
                <span class="panel-title">Blood Inventory</span>
                <span class="badge badge-ok"><span class="pulse-dot bg-ok"></span>Live</span>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="data-table">
                    <thead>
                        <tr><th>Type</th><th class="text-center">Units</th><th>Level</th><th>Last Donor</th><th class="text-right">Updated</th></tr>
                    </thead>
                    <tbody>
                        @foreach([['group'=>'O+','min'=>25],['group'=>'A+','min'=>20],['group'=>'B+','min'=>15],['group'=>'AB+','min'=>8],['group'=>'O-','min'=>10]] as $row)
                        @php $count=$stockByGroup->get($row['group'],rand(8,60)); $pct=min(100,intval($count/max($row['min']*2,1)*100)); $barColor=$count<$row['min']?'#ef4444':($count<$row['min']*1.5?'#f59e0b':'#22c55e'); @endphp
                        <tr>
                            <td><span class="font-mono font-bold text-brand text-base">{{ $row['group'] }}</span></td>
                            <td class="text-center"><span class="font-bold text-ink tabular-nums">{{ $count }}</span></td>
                            <td class="min-w-[100px]"><div class="w-full bg-surface-raised rounded-full h-1.5"><div class="h-1.5 rounded-full" style="width:{{ $pct }}%;background-color:{{ $barColor }};"></div></div></td>
                            <td class="text-ink-muted text-xs">M. Smith</td>
                            <td class="text-right text-ink-faint text-xs font-mono">03-01-26</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right column -->
        <div class="space-y-4">
            <div class="panel">
                <div class="panel-header"><span class="panel-title">Distribution</span></div>
                <div class="p-5 space-y-4">
                    @foreach([['label'=>'O Positive','pct'=>32,'color'=>'#e63946'],['label'=>'A Positive','pct'=>27,'color'=>'#f59e0b'],['label'=>'B Positive','pct'=>26,'color'=>'#a855f7'],['label'=>'AB Positive','pct'=>9,'color'=>'#3b82f6'],['label'=>'Others','pct'=>6,'color'=>'#4a5068']] as $d)
                    <div>
                        <div class="flex justify-between text-[11px] mb-1.5"><span class="text-ink-muted font-medium">{{ $d['label'] }}</span><span class="text-ink font-bold tabular-nums">{{ $d['pct'] }}%</span></div>
                        <div class="w-full bg-surface-raised rounded-full h-1"><div class="h-1 rounded-full" style="width:{{ $d['pct'] }}%;background-color:{{ $d['color'] }};"></div></div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="panel">
                <div class="panel-header">
                    <span class="panel-title">Recent Requests</span>
                    <a href="{{ route('admin.distribution') }}" class="text-[10px] text-ink-faint hover:text-brand transition font-semibold uppercase tracking-wider">All →</a>
                </div>
                <ul class="divide-y divide-surface-border">
                    @foreach([['name'=>'City Hospital','type'=>'O+','status'=>'Urgent','badge'=>'badge-danger'],['name'=>'Rajagiri Medical','type'=>'B-','status'=>'Active','badge'=>'badge-ok'],['name'=>'MVR Hospital','type'=>'A+','status'=>'Pending','badge'=>'badge-warn']] as $r)
                    <li class="flex items-center justify-between px-5 py-3.5 hover:bg-surface-raised/40 transition">
                        <div><div class="text-sm font-semibold text-ink">{{ $r['name'] }}</div><div class="text-[11px] text-ink-faint mt-0.5">Type <span class="font-mono font-bold text-brand">{{ $r['type'] }}</span></div></div>
                        <span class="badge {{ $r['badge'] }}">{{ $r['status'] }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Expiring Bags Row -->
    @if($expiringSoon->isNotEmpty())
    <div class="panel">
        <div class="panel-header">
            <div class="flex items-center gap-3">
                <span class="panel-title">PRBC Bags Expiring Soon</span>
                <span class="badge badge-warn">{{ $expiringSoon->count() }} within 14 days</span>
            </div>
            <a href="{{ route('admin.blood-bags.export') }}" class="btn-ghost text-xs py-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Export CSV
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr><th>RFID Tag</th><th>Blood Group</th><th>Expires</th><th>Days Left</th><th class="text-right">Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($expiringSoon as $bag)
                    @php $daysLeft = now()->diffInDays($bag->expiry_date, false); @endphp
                    <tr>
                        <td><span class="font-mono text-xs font-semibold text-ink">{{ $bag->bag_rfid }}</span></td>
                        <td><span class="font-mono font-bold text-brand">{{ $bag->blood_group }}</span></td>
                        <td class="text-ink-faint text-xs">{{ \Carbon\Carbon::parse($bag->expiry_date)->format('d M Y') }}</td>
                        <td><span class="badge {{ $daysLeft <= 3 ? 'badge-danger' : 'badge-warn' }}">{{ $daysLeft }}d</span></td>
                        <td class="text-right">
                            <div class="flex items-center justify-end gap-2">
                                <!-- Reserve -->
                                <form method="POST" action="{{ route('admin.blood-bags.reserve', $bag->id) }}">
                                    @csrf
                                    <button type="submit" class="btn-ghost text-xs py-1 px-3">Reserve</button>
                                </form>
                                <!-- Discard -->
                                <form method="POST" action="{{ route('admin.blood-bags.discard', $bag->id) }}"
                                      x-data onsubmit="return confirm('Discard bag {{ $bag->bag_rfid }}? This cannot be undone.')">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center text-xs font-semibold text-brand hover:text-brand-soft px-3 py-1 rounded-lg hover:bg-brand/10 transition">Discard</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>
</x-app-layout>
