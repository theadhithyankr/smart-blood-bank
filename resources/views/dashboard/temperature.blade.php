<x-app-layout>
<div class="max-w-[1400px] mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-ink">IoT Sensors</h1>
            <p class="text-xs text-ink-faint mt-0.5">Live refrigerator temperature monitoring</p>
        </div>
        <span class="flex items-center gap-2 text-xs font-semibold text-ok bg-ok/10 px-3 py-1.5 rounded-full">
            <span class="pulse-dot bg-ok"></span>
            {{ $activeSensors }} sensors online
        </span>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="stat-card">
            <div class="stat-card__label">Active Sensors</div>
            <div class="stat-card__value">{{ $activeSensors }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label {{ $breachesToday > 0 ? 'text-danger' : '' }}">Breaches Today</div>
            <div class="stat-card__value {{ $breachesToday > 0 ? 'text-danger' : '' }}">{{ $breachesToday }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label">Avg Temperature</div>
            <div class="stat-card__value">{{ $averageTemp }}<span class="text-xl text-ink-faint">°C</span></div>
        </div>
    </div>

    <!-- Refrigerator Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @foreach([
            ['id'=>'REF-01','temp'=>4.2,'status'=>'ok',      'units'=>45],
            ['id'=>'REF-02','temp'=>3.8,'status'=>'ok',      'units'=>32],
            ['id'=>'REF-03','temp'=>5.9,'status'=>'warn',    'units'=>50],
            ['id'=>'REF-04','temp'=>4.5,'status'=>'ok',      'units'=>28],
            ['id'=>'REF-05','temp'=>4.1,'status'=>'ok',      'units'=>40],
            ['id'=>'REF-06','temp'=>7.2,'status'=>'breach',  'units'=>12],
            ['id'=>'REF-07','temp'=>2.1,'status'=>'warn',    'units'=>18],
            ['id'=>'REF-08','temp'=>4.4,'status'=>'ok',      'units'=>35],
        ] as $ref)
        @php
            $borderClass = match($ref['status']) {
                'breach' => 'border-danger/50',
                'warn'   => 'border-warn/40',
                default  => 'border-surface-border',
            };
            $tempColor = match($ref['status']) {
                'breach' => '#ef4444',
                'warn'   => '#f59e0b',
                default  => '#22c55e',
            };
            $badge = match($ref['status']) {
                'breach' => ['label' => 'Breached', 'cls' => 'badge-danger'],
                'warn'   => ['label' => 'Warning',  'cls' => 'badge-warn'],
                default  => ['label' => 'Optimal',  'cls' => 'badge-ok'],
            };
        @endphp
        <div class="panel p-5 flex flex-col gap-5 {{ $borderClass }}">
            <div class="flex items-center justify-between">
                <span class="font-mono text-xs font-bold text-ink-faint tracking-wider">{{ $ref['id'] }}</span>
                <span class="badge {{ $badge['cls'] }}">
                    @if($ref['status'] === 'ok')
                        <span class="pulse-dot bg-ok"></span>
                    @endif
                    {{ $badge['label'] }}
                </span>
            </div>

            <div class="flex flex-col items-center py-2">
                <div class="text-5xl font-black tabular-nums leading-none" style="color: {{ $tempColor }};">{{ $ref['temp'] }}</div>
                <div class="text-sm font-semibold mt-1" style="color: {{ $tempColor }};">°C</div>
                <div class="text-[10px] text-ink-faint font-semibold uppercase tracking-widest mt-2">Target 2°C – 6°C</div>
            </div>

            <div class="flex items-center justify-between pt-3" style="border-top: 1px solid #252a3a;">
                <div class="flex items-center gap-1.5 text-[11px] text-ink-faint">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    {{ $ref['units'] }} bags
                </div>
                <button class="text-[10px] text-ink-faint hover:text-brand font-semibold transition">Log →</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-app-layout>
