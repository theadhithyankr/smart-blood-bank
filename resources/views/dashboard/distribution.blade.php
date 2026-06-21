<x-app-layout>
<div class="max-w-[1400px] mx-auto space-y-6" x-data="{ tab: 'active', showModal: false }">

    <!-- Flash -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="flex items-center gap-3 px-5 py-3 rounded-xl bg-ok/10 border border-ok/30 text-ok text-sm font-medium">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Page header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-ink">Distribution</h1>
            <p class="text-xs text-ink-faint mt-0.5">Dispatch and fulfilment tracking</p>
        </div>
        <button @click="showModal = true" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            New Dispatch
        </button>
    </div>

    <!-- KPIs -->
    <div class="grid grid-cols-3 gap-4">
        <div class="stat-card"><div class="stat-card__label">Issued Today</div><div class="flex items-end gap-3"><div class="stat-card__value">{{ $issuedToday }}</div><span class="stat-card__badge bg-ok/10 text-ok mb-1">+9%</span></div></div>
        <div class="stat-card"><div class="stat-card__label text-warn">Pending</div><div class="stat-card__value text-warn">{{ $pendingRequests }}</div></div>
        <div class="stat-card"><div class="stat-card__label">This Month</div><div class="stat-card__value">{{ $totalThisMonth }}</div></div>
    </div>

    <!-- Table with tab toggle -->
    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Dispatch Requests</span>
            <div class="flex gap-4">
                <button @click="tab = 'active'"   :class="tab === 'active'   ? 'text-brand border-b border-brand pb-0.5' : 'text-ink-faint hover:text-ink-muted'" class="text-[11px] font-bold transition">Active</button>
                <button @click="tab = 'history'"  :class="tab === 'history'  ? 'text-brand border-b border-brand pb-0.5' : 'text-ink-faint hover:text-ink-muted'" class="text-[11px] font-bold transition">History</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Request ID</th><th>Hospital</th><th class="text-center">Type</th><th class="text-center">Units</th><th>Urgency</th><th>Time</th><th>Status</th></tr></thead>
                <tbody>
                    @php
                        $active = [
                            ['id'=>'REQ-001','hospital'=>'Bagmo Hospital','type'=>'O+','units'=>3,'urgency'=>'High','ub'=>'badge-warn','time'=>'09:45 AM','status'=>'Processing','sb'=>'badge-info'],
                            ['id'=>'REQ-002','hospital'=>'Rajagiri Medical','type'=>'B-','units'=>2,'urgency'=>'Critical','ub'=>'badge-danger','time'=>'10:20 AM','status'=>'Approved','sb'=>'badge-ok'],
                            ['id'=>'REQ-004','hospital'=>'PVS Hospital','type'=>'AB+','units'=>1,'urgency'=>'High','ub'=>'badge-warn','time'=>'11:45 AM','status'=>'Pending','sb'=>'badge-warn'],
                        ];
                        $history = [
                            ['id'=>'REQ-003','hospital'=>'MVR Hospital','type'=>'A+','units'=>4,'urgency'=>'Normal','ub'=>'badge-muted','time'=>'11:00 AM','status'=>'Dispatched','sb'=>'badge-ok'],
                            ['id'=>'REQ-000','hospital'=>'KIMS Hospital','type'=>'O-','units'=>6,'urgency'=>'Critical','ub'=>'badge-danger','time'=>'Yesterday','status'=>'Delivered','sb'=>'badge-ok'],
                        ];
                    @endphp
                    <template x-if="tab === 'active'">
                        <template x-for="_ in [0]">
                            <tr><td colspan="7" class="p-0">
                                <table class="w-full">
                                    @foreach($active as $req)
                                    <tr class="border-b border-surface-border/60 hover:bg-surface-raised/40 transition">
                                        <td class="px-5 py-4"><span class="font-mono text-xs font-semibold text-ink">{{ $req['id'] }}</span></td>
                                        <td class="px-5 py-4 text-ink font-medium text-sm">{{ $req['hospital'] }}</td>
                                        <td class="px-5 py-4 text-center"><span class="font-mono font-bold text-brand">{{ $req['type'] }}</span></td>
                                        <td class="px-5 py-4 text-center text-ink font-semibold tabular-nums">{{ $req['units'] }}</td>
                                        <td class="px-5 py-4"><span class="badge {{ $req['ub'] }}">{{ $req['urgency'] }}</span></td>
                                        <td class="px-5 py-4 text-ink-faint text-xs font-mono">{{ $req['time'] }}</td>
                                        <td class="px-5 py-4"><span class="badge {{ $req['sb'] }}">{{ $req['status'] }}</span></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td></tr>
                        </template>
                    </template>
                    <template x-if="tab === 'history'">
                        <template x-for="_ in [0]">
                            <tr><td colspan="7" class="p-0">
                                <table class="w-full">
                                    @foreach($history as $req)
                                    <tr class="border-b border-surface-border/60 hover:bg-surface-raised/40 transition">
                                        <td class="px-5 py-4"><span class="font-mono text-xs font-semibold text-ink">{{ $req['id'] }}</span></td>
                                        <td class="px-5 py-4 text-ink font-medium text-sm">{{ $req['hospital'] }}</td>
                                        <td class="px-5 py-4 text-center"><span class="font-mono font-bold text-brand">{{ $req['type'] }}</span></td>
                                        <td class="px-5 py-4 text-center text-ink font-semibold tabular-nums">{{ $req['units'] }}</td>
                                        <td class="px-5 py-4"><span class="badge {{ $req['ub'] }}">{{ $req['urgency'] }}</span></td>
                                        <td class="px-5 py-4 text-ink-faint text-xs font-mono">{{ $req['time'] }}</td>
                                        <td class="px-5 py-4"><span class="badge {{ $req['sb'] }}">{{ $req['status'] }}</span></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td></tr>
                        </template>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <!-- New Dispatch Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div @click="showModal = false" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
        <div class="relative bg-surface-card border border-surface-border rounded-2xl p-6 w-full max-w-md shadow-2xl"
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-base font-bold text-ink">New Dispatch Request</h3>
                <button @click="showModal = false" class="text-ink-faint hover:text-ink transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.distribution.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="form-label">Hospital Name</label>
                    <input type="text" name="hospital" class="form-input" placeholder="e.g. Rajagiri Hospital" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Blood Type</label>
                        <select name="blood_type" class="form-input" required>
                            @foreach(['O+','O-','A+','A-','B+','B-','AB+','AB-'] as $g)
                            <option value="{{ $g }}">{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Units</label>
                        <input type="number" name="units" class="form-input" min="1" max="20" value="1" required>
                    </div>
                </div>
                <div>
                    <label class="form-label">Urgency</label>
                    <select name="urgency" class="form-input" required>
                        <option value="Normal">Normal</option>
                        <option value="High">High</option>
                        <option value="Critical">Critical</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="showModal = false" class="btn-ghost">Cancel</button>
                    <button type="submit" class="btn-primary">Submit Request</button>
                </div>
            </form>
        </div>
    </div>

</div>
</x-app-layout>
