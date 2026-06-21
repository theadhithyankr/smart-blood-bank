<x-app-layout>
    <div class="p-6 max-w-[1600px] mx-auto space-y-6">
        
        <!-- Top KPI Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Active Sensors -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Active Sensors</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $activeSensors }}</div>
                    <div class="text-sm font-bold text-emerald-500">100% Online</div>
                </div>
            </div>

            <!-- Breaches Today -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Breaches Today</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black {{ $breachesToday > 0 ? 'text-red-600' : 'text-slate-800' }}">{{ $breachesToday }}</div>
                    @if($breachesToday == 0)
                        <div class="text-sm font-bold text-emerald-500">All Safe</div>
                    @else
                        <div class="text-sm font-bold text-red-500">Action Required</div>
                    @endif
                </div>
            </div>

            <!-- Average Temp -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Average Temp</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $averageTemp }}°C</div>
                    <div class="text-sm font-bold text-slate-400">Target 2°C - 6°C</div>
                </div>
            </div>
        </div>

        <!-- Refrigerators Grid -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col mt-8">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="text-base font-bold text-slate-800">Live Refrigerator Monitoring</h3>
                <span class="flex items-center text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                    Live Updates
                </span>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach([
                        ['id' => 'REF-01', 'temp' => 4.2, 'status' => 'Optimal', 'color' => 'emerald', 'units' => 45],
                        ['id' => 'REF-02', 'temp' => 3.8, 'status' => 'Optimal', 'color' => 'emerald', 'units' => 32],
                        ['id' => 'REF-03', 'temp' => 5.9, 'status' => 'Warning', 'color' => 'orange', 'units' => 50],
                        ['id' => 'REF-04', 'temp' => 4.5, 'status' => 'Optimal', 'color' => 'emerald', 'units' => 28],
                        ['id' => 'REF-05', 'temp' => 4.1, 'status' => 'Optimal', 'color' => 'emerald', 'units' => 40],
                        ['id' => 'REF-06', 'temp' => 7.2, 'status' => 'Breached', 'color' => 'red', 'units' => 12],
                        ['id' => 'REF-07', 'temp' => 2.1, 'status' => 'Warning', 'color' => 'orange', 'units' => 18],
                        ['id' => 'REF-08', 'temp' => 4.4, 'status' => 'Optimal', 'color' => 'emerald', 'units' => 35]
                    ] as $ref)
                        <div class="rounded-xl border {{ $ref['status'] === 'Breached' ? 'border-red-300 bg-red-50/50 shadow-md ring-1 ring-red-500' : 'border-slate-200 bg-white hover:border-slate-300' }} p-5 flex flex-col justify-between transition relative">
                            
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="font-bold text-slate-800">{{ $ref['id'] }}</h4>
                                <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide rounded text-{{ $ref['color'] }}-700 bg-{{ $ref['color'] }}-100">{{ $ref['status'] }}</span>
                            </div>

                            <div class="flex flex-col items-center justify-center py-4">
                                <div class="text-4xl font-black text-{{ $ref['color'] }}-600 mb-1">{{ $ref['temp'] }}<span class="text-2xl text-{{ $ref['color'] }}-400">°C</span></div>
                                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Current Temp</p>
                            </div>

                            <div class="mt-4 pt-4 border-t {{ $ref['status'] === 'Breached' ? 'border-red-200' : 'border-slate-100' }} flex justify-between items-center">
                                <div class="flex items-center text-xs font-semibold text-slate-500">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                    {{ $ref['units'] }} Bags
                                </div>
                                <button class="text-xs font-bold text-slate-500 hover:text-slate-700 transition">Details</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
