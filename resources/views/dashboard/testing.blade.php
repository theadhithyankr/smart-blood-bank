<x-app-layout>
<div class="max-w-[1400px] mx-auto space-y-6">
    <div>
        <h1 class="text-xl font-bold text-ink">Screening Lab</h1>
        <p class="text-xs text-ink-faint mt-0.5">Pathogen testing and serological results</p>
    </div>

    <!-- KPIs -->
    <div class="grid grid-cols-3 gap-4">
        <div class="stat-card">
            <div class="stat-card__label">Completed Today</div>
            <div class="flex items-end gap-3">
                <div class="stat-card__value">{{ $testsCompleted }}</div>
                <span class="stat-card__badge bg-ok/10 text-ok mb-1">+6%</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label text-warn">Pending</div>
            <div class="stat-card__value text-warn">{{ $pendingTests }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__label text-ok">Safe Cleared</div>
            <div class="stat-card__value">{{ $safeUnits }}</div>
        </div>
    </div>

    <!-- Results Table -->
    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Test Results — Today's Batches</span>
            <div class="flex items-center gap-2">
                <span class="badge badge-ok">{{ $safeUnits }} Safe</span>
                <span class="badge badge-warn">{{ $pendingTests }} Pending</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Bag ID</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">HIV</th>
                        <th class="text-center">HBsAg</th>
                        <th class="text-center">HCV</th>
                        <th class="text-center">Syphilis</th>
                        <th class="text-center">Malaria</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                        ['id' => 'BB2026001', 'type' => 'O+',  'results' => ['N','N','N','N','N'], 'status' => 'Cleared',  'badge' => 'badge-ok'],
                        ['id' => 'BB2026004', 'type' => 'B-',  'results' => ['N','N','N','N','N'], 'status' => 'Cleared',  'badge' => 'badge-ok'],
                        ['id' => 'BB2026005', 'type' => 'A+',  'results' => ['P','N','N','N','N'], 'status' => 'Testing',  'badge' => 'badge-warn'],
                        ['id' => 'BB2026008', 'type' => 'AB-', 'results' => ['N','N','N','N','N'], 'status' => 'Cleared',  'badge' => 'badge-ok'],
                        ['id' => 'BB2026011', 'type' => 'O-',  'results' => ['N','P','N','N','N'], 'status' => 'Rejected', 'badge' => 'badge-danger'],
                    ] as $t)
                    <tr>
                        <td><span class="font-mono text-xs font-semibold text-ink">{{ $t['id'] }}</span></td>
                        <td class="text-center"><span class="font-mono font-bold text-brand">{{ $t['type'] }}</span></td>
                        @foreach($t['results'] as $r)
                        <td class="text-center">
                            @if($r === 'N')
                                <svg class="w-4 h-4 text-ok mx-auto" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            @elseif($r === 'P')
                                <svg class="w-4 h-4 text-danger mx-auto" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            @else
                                <span class="text-ink-faint text-xs">—</span>
                            @endif
                        </td>
                        @endforeach
                        <td><span class="badge {{ $t['badge'] }}">{{ $t['status'] }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
