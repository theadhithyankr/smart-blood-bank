<x-app-layout>
    <div class="p-6 max-w-[1600px] mx-auto space-y-6">
        
        <!-- Top KPI Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Units -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Total Units</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $totalUnits }}</div>
                    <div class="text-sm font-bold text-emerald-500">+4%</div>
                </div>
            </div>

            <!-- Critical Level -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Critical Level</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">12</div>
                    <div class="text-sm font-bold text-red-500">-8%</div>
                </div>
            </div>

            <!-- Expiring Soon -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Expiring Soon</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $expiringSoonTotal }}</div>
                    <div class="text-sm font-bold text-emerald-500">+2%</div>
                </div>
            </div>
        </div>

        <!-- Blood Stock Levels -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col mt-8">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-800">Blood Stock Levels</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'] as $group)
                        @php 
                            $count = $stockByGroup->get($group, rand(10, 90)); 
                            $expiring = rand(1, 6);
                            $isCritical = $count < 20;
                        @endphp
                        
                        <div class="rounded-xl border {{ $isCritical ? 'border-red-200 bg-red-50/30 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300' }} p-6 flex flex-col justify-between relative overflow-hidden transition">
                            
                            @if($isCritical)
                                <div class="absolute top-4 right-4 text-red-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            @endif

                            <div class="text-3xl font-black {{ $isCritical ? 'text-red-600' : 'text-slate-800' }} mb-6">{{ $group }}</div>
                            
                            <div class="flex justify-between items-end mb-4 border-b {{ $isCritical ? 'border-red-100' : 'border-slate-100' }} pb-4">
                                <span class="text-sm font-medium {{ $isCritical ? 'text-red-500' : 'text-slate-500' }}">Units Available</span>
                                <span class="text-2xl font-bold {{ $isCritical ? 'text-red-600' : 'text-slate-800' }}">{{ $count }}</span>
                            </div>

                            <div class="flex items-center text-xs font-semibold {{ $isCritical ? 'text-red-500' : 'text-orange-500' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $expiring }} expiring soon
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
