<x-app-layout>
<div class="max-w-[1400px] mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-ink">Distribution</h1>
            <p class="text-xs text-ink-faint mt-0.5">Dispatch and fulfilment tracking</p>
        </div>
        <button class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            New Dispatch
        </button>
    </div>

    <!-- KPIs -->
    <div class="grid grid-cols-3 gap-4">
        <div class="stat-card">
            <div class="stat-card__label">Issued Today</div>
            <div class="flex items-end gap-3">
                <div class="stat-card__value">{{ $issuedToday }}</div>
                <span class="stat-card__badge bg-ok/10 text-ok mb-1">+9%</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label text-warn">Pending</div>
            <div class="stat-card__value text-warn">{{ $pendingRequests }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label">This Month</div>
            <div class="stat-card__value">{{ $totalThisMonth }}</div>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Dispatch Requests</span>
            <div class="flex gap-2">
                <button class="text-[10px] font-bold text-brand border-b border-brand pb-0.5">Active</button>
                <button class="text-[10px] font-bold text-ink-faint hover:text-ink-muted transition">History</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Hospital</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Units</th>
                        <th>Urgency</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                        ['id'=>'REQ-001','hospital'=>'Bagmo Hospital',   'type'=>'O+','units'=>3,'urgency'=>'High',    'ub'=>'badge-warn',  'time'=>'09:45 AM','status'=>'Processing','sb'=>'badge-info'],
                        ['id'=>'REQ-002','hospital'=>'Rajagiri Medical', 'type'=>'B-','units'=>2,'urgency'=>'Critical','ub'=>'badge-danger','time'=>'10:20 AM','status'=>'Approved',  'sb'=>'badge-ok'],
                        ['id'=>'REQ-003','hospital'=>'MVR Hospital',     'type'=>'A+','units'=>4,'urgency'=>'Normal',  'ub'=>'badge-muted', 'time'=>'11:00 AM','status'=>'Dispatched','sb'=>'badge-ok'],
                        ['id'=>'REQ-004','hospital'=>'PVS Hospital',     'type'=>'AB+','units'=>1,'urgency'=>'High',   'ub'=>'badge-warn',  'time'=>'11:45 AM','status'=>'Pending',   'sb'=>'badge-warn'],
                    ] as $req)
                    <tr>
                        <td><span class="font-mono text-xs font-semibold text-ink">{{ $req['id'] }}</span></td>
                        <td class="text-ink font-medium text-sm">{{ $req['hospital'] }}</td>
                        <td class="text-center"><span class="font-mono font-bold text-brand">{{ $req['type'] }}</span></td>
                        <td class="text-center text-ink font-semibold tabular-nums">{{ $req['units'] }}</td>
                        <td><span class="badge {{ $req['ub'] }}">{{ $req['urgency'] }}</span></td>
                        <td class="text-ink-faint text-xs font-mono">{{ $req['time'] }}</td>
                        <td><span class="badge {{ $req['sb'] }}">{{ $req['status'] }}</span></td>
                        <td class="text-right">
                            <button class="btn-ghost text-xs py-1 px-3">View</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
