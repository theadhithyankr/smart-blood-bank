<x-app-layout>
    <div class="p-6 max-w-[1600px] mx-auto space-y-6">
        
        <!-- Top KPI Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tests Completed -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Tests Completed</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $testsCompleted }}</div>
                    <div class="text-sm font-bold text-emerald-500">+6%</div>
                </div>
            </div>

            <!-- Pending Tests -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Pending Tests</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $pendingTests }}</div>
                    <div class="text-sm font-bold text-red-500">-3%</div>
                </div>
            </div>

            <!-- Safe Units -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Safe Units</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $safeUnits }}</div>
                    <div class="text-sm font-bold text-emerald-500">+7%</div>
                </div>
            </div>
        </div>

        <!-- Test Results Table -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col mt-8">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-800">Test Results</h3>
            </div>
            <div class="p-0 overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-[11px] text-slate-400 uppercase tracking-wider border-b border-slate-100 bg-white">
                            <th class="px-6 py-4 font-semibold">Bag ID</th>
                            <th class="px-6 py-4 font-semibold text-center">Blood Type</th>
                            <th class="px-6 py-4 font-semibold text-center">HIV</th>
                            <th class="px-6 py-4 font-semibold text-center">HBsAg</th>
                            <th class="px-6 py-4 font-semibold text-center">HCV</th>
                            <th class="px-6 py-4 font-semibold text-center">Syphilis</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-slate-600">
                        @foreach([
                            ['id' => 'BB2026001', 'type' => 'O+', 'hiv' => 'Negative', 'hbsag' => 'Negative', 'hcv' => 'Negative', 'syphilis' => 'Negative', 'status' => 'Safe', 'status_color' => 'bg-emerald-100 text-emerald-700'],
                            ['id' => 'BB2026004', 'type' => 'B-', 'hiv' => 'Negative', 'hbsag' => 'Negative', 'hcv' => 'Negative', 'syphilis' => 'Negative', 'status' => 'Safe', 'status_color' => 'bg-emerald-100 text-emerald-700'],
                            ['id' => 'BB2026005', 'type' => 'A+', 'hiv' => 'Pending', 'hbsag' => 'Negative', 'hcv' => 'Negative', 'syphilis' => 'Negative', 'status' => 'Testing', 'status_color' => 'bg-yellow-100 text-yellow-700']
                        ] as $test)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-5 font-bold text-slate-800">{{ $test['id'] }}</td>
                            <td class="px-6 py-5 text-center font-bold text-red-500">{{ $test['type'] }}</td>
                            
                            <!-- HIV -->
                            <td class="px-6 py-5 text-center">
                                @if($test['hiv'] === 'Negative')
                                    <span class="inline-flex items-center text-emerald-600 font-semibold text-[13px]"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Negative</span>
                                @else
                                    <span class="inline-flex items-center text-slate-400 font-semibold text-[13px]">Pending</span>
                                @endif
                            </td>
                            
                            <!-- HBsAg -->
                            <td class="px-6 py-5 text-center">
                                @if($test['hbsag'] === 'Negative')
                                    <span class="inline-flex items-center text-emerald-600 font-semibold text-[13px]"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Negative</span>
                                @else
                                    <span class="inline-flex items-center text-slate-400 font-semibold text-[13px]">Pending</span>
                                @endif
                            </td>

                            <!-- HCV -->
                            <td class="px-6 py-5 text-center">
                                @if($test['hcv'] === 'Negative')
                                    <span class="inline-flex items-center text-emerald-600 font-semibold text-[13px]"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Negative</span>
                                @else
                                    <span class="inline-flex items-center text-slate-400 font-semibold text-[13px]">Pending</span>
                                @endif
                            </td>

                            <!-- Syphilis -->
                            <td class="px-6 py-5 text-center">
                                @if($test['syphilis'] === 'Negative')
                                    <span class="inline-flex items-center text-emerald-600 font-semibold text-[13px]"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Negative</span>
                                @else
                                    <span class="inline-flex items-center text-slate-400 font-semibold text-[13px]">Pending</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-5">
                                <span class="px-3 py-1.5 text-[11px] font-bold uppercase tracking-wide rounded-full {{ $test['status_color'] }}">{{ $test['status'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
