<x-app-layout>
<div class="max-w-[1400px] mx-auto space-y-6"
     x-data="{
        showStart: false,
        detailBag: null,
        showDetail: false,
        openDetail(bag) { this.detailBag = bag; this.showDetail = true; }
     }">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-ink">Collection</h1>
            <p class="text-xs text-ink-faint mt-0.5">Ongoing collection sessions &amp; drives</p>
        </div>
        <button @click="showStart = true" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Start Collection
        </button>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="stat-card"><div class="stat-card__label">Active Camps</div><div class="stat-card__value">{{ $activeCamps }}</div></div>
        <div class="stat-card"><div class="stat-card__label">Donors Today</div><div class="flex items-end gap-3"><div class="stat-card__value">{{ $donorsToday }}</div><span class="stat-card__badge bg-ok/10 text-ok mb-1">+12%</span></div></div>
        <div class="stat-card"><div class="stat-card__label">Bags Collected</div><div class="stat-card__value">{{ $bagsCollected }}</div></div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Active Sessions</span>
            <span class="badge badge-ok"><span class="pulse-dot bg-ok"></span>Live</span>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Donor</th><th class="text-center">Type</th><th class="text-center font-mono">RFID</th><th>Started</th><th>Location</th><th>Status</th><th class="text-right">Action</th></tr></thead>
                <tbody>
                    @php $sessions = [
                        ['name'=>'Rahul Sharma','type'=>'O+','rfid'=>'BB2026101','time'=>'10:15 AM','loc'=>'In-House Center','status'=>'In Progress','badge'=>'badge-info','vol'=>'450ml','pulse'=>72,'bp'=>'120/80'],
                        ['name'=>'Anita Desai', 'type'=>'A-','rfid'=>'BB2026102','time'=>'10:30 AM','loc'=>'In-House Center','status'=>'Completed',  'badge'=>'badge-ok',  'vol'=>'450ml','pulse'=>68,'bp'=>'118/76'],
                        ['name'=>'Karan Patel', 'type'=>'B+','rfid'=>'BB2026103','time'=>'11:00 AM','loc'=>'City Mall Camp', 'status'=>'Drawing',    'badge'=>'badge-warn','vol'=>'350ml','pulse'=>75,'bp'=>'122/82'],
                    ]; @endphp
                    @foreach($sessions as $c)
                    <tr>
                        <td class="font-semibold text-ink text-sm">{{ $c['name'] }}</td>
                        <td class="text-center"><span class="font-mono font-bold text-brand">{{ $c['type'] }}</span></td>
                        <td class="text-center"><span class="font-mono text-xs text-ink-faint">{{ $c['rfid'] }}</span></td>
                        <td class="text-ink-faint text-xs font-mono">{{ $c['time'] }}</td>
                        <td class="text-ink-muted text-sm">{{ $c['loc'] }}</td>
                        <td><span class="badge {{ $c['badge'] }}">{{ $c['status'] }}</span></td>
                        <td class="text-right">
                            <button @click="openDetail({{ json_encode($c) }})" class="btn-ghost text-xs py-1 px-3">Details</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Start Collection Modal -->
    <div x-show="showStart" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div @click="showStart = false" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
        <div class="relative bg-surface-card border border-surface-border rounded-2xl p-6 w-full max-w-md shadow-2xl"
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-base font-bold text-ink">Start New Collection</h3>
                <button @click="showStart = false" class="text-ink-faint hover:text-ink transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="form-label">Donor Name</label>
                    <input type="text" class="form-input" placeholder="Registered donor name">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Blood Type</label>
                        <select class="form-input">@foreach(['O+','O-','A+','A-','B+','B-','AB+','AB-'] as $g)<option>{{ $g }}</option>@endforeach</select>
                    </div>
                    <div>
                        <label class="form-label">Collection Site</label>
                        <select class="form-input"><option>In-House Center</option><option>City Mall Camp</option><option>Medical College</option></select>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button @click="showStart = false" class="btn-ghost">Cancel</button>
                    <button @click="showStart = false" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Begin Session
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div x-show="showDetail" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div @click="showDetail = false" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
        <div class="relative bg-surface-card border border-surface-border rounded-2xl p-6 w-full max-w-sm shadow-2xl"
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-bold text-ink" x-text="detailBag?.name"></h3>
                <button @click="showDetail = false" class="text-ink-faint hover:text-ink transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <div class="space-y-3" x-show="detailBag">
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-surface-raised rounded-xl p-4 text-center">
                        <div class="text-[10px] text-ink-faint font-bold uppercase tracking-wider mb-1">Blood Type</div>
                        <div class="font-mono font-black text-2xl text-brand" x-text="detailBag?.type"></div>
                    </div>
                    <div class="bg-surface-raised rounded-xl p-4 text-center">
                        <div class="text-[10px] text-ink-faint font-bold uppercase tracking-wider mb-1">Volume</div>
                        <div class="font-black text-2xl text-ink" x-text="detailBag?.vol"></div>
                    </div>
                    <div class="bg-surface-raised rounded-xl p-4 text-center">
                        <div class="text-[10px] text-ink-faint font-bold uppercase tracking-wider mb-1">Pulse</div>
                        <div class="font-black text-2xl text-ink" x-text="detailBag?.pulse + ' bpm'"></div>
                    </div>
                    <div class="bg-surface-raised rounded-xl p-4 text-center">
                        <div class="text-[10px] text-ink-faint font-bold uppercase tracking-wider mb-1">Blood Pressure</div>
                        <div class="font-black text-lg text-ink" x-text="detailBag?.bp"></div>
                    </div>
                </div>
                <div class="bg-surface-raised rounded-xl p-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-ink-faint">RFID Tag</span>
                        <span class="font-mono font-semibold text-ink" x-text="detailBag?.rfid"></span>
                    </div>
                    <div class="flex justify-between text-sm mt-2">
                        <span class="text-ink-faint">Location</span>
                        <span class="text-ink" x-text="detailBag?.loc"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</x-app-layout>
