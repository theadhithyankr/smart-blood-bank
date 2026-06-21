<x-app-layout>
    <div class="p-6 max-w-[1600px] mx-auto space-y-6">
        
        <!-- Top KPI Row -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <!-- Refrigerators -->
            <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="flex items-center text-slate-500 mb-2">
                    <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span class="text-xs font-semibold uppercase tracking-wider">Refrigerators</span>
                </div>
                <div class="text-3xl font-black text-slate-800">{{ $refrigerators }}</div>
            </div>

            <!-- Units in Stock -->
            <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="flex items-center text-slate-500 mb-2">
                    <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span class="text-xs font-semibold uppercase tracking-wider">Units in Stock</span>
                </div>
                <div class="text-3xl font-black text-slate-800">{{ $totalStock }}</div>
            </div>

            <!-- PRBC Expiring Soon -->
            <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="flex items-center text-slate-500 mb-2">
                    <svg class="w-5 h-5 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-xs font-semibold uppercase tracking-wider">PRBC Expiring Soon</span>
                </div>
                <div class="text-3xl font-black text-slate-800">{{ $expiringSoonCount }}</div>
            </div>

            <!-- Active Requests -->
            <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="flex items-center text-slate-500 mb-2">
                    <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-xs font-semibold uppercase tracking-wider">Active Requests</span>
                </div>
                <div class="text-3xl font-black text-slate-800">{{ $activeRequestsCount }}</div>
            </div>

            <!-- Pending Requests -->
            <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="flex items-center text-slate-500 mb-2">
                    <svg class="w-5 h-5 mr-2 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-xs font-semibold uppercase tracking-wider">Pending Requests</span>
                </div>
                <div class="text-3xl font-black text-slate-800">{{ $pendingRequestsCount }}</div>
            </div>
        </div>

        <!-- Middle Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Blood Inventory Overview -->
            <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Blood Inventory Overview</h3>
                </div>
                <div class="p-0 overflow-x-auto flex-1">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="text-xs text-slate-400 uppercase tracking-wider border-b border-slate-100 bg-white">
                                <th class="px-6 py-3 font-semibold">Blood Group</th>
                                <th class="px-6 py-3 font-semibold text-center">Units</th>
                                <th class="px-6 py-3 font-semibold">Recent Donors</th>
                                <th class="px-6 py-3 font-semibold text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-slate-600">
                            @foreach(['O Positive' => 'O+', 'A Positive' => 'A+', 'B Positive' => 'B+', 'AB Positive' => 'AB+', 'O Negative' => 'O-'] as $label => $group)
                            <tr class="hover:bg-slate-50 transition group">
                                <td class="px-6 py-4 font-semibold flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-red-500 mr-3"></span>
                                    {{ $label }}
                                </td>
                                <td class="px-6 py-4 text-center font-bold text-slate-800">{{ $stockByGroup->get($group, 0) }}</td>
                                <td class="px-6 py-4 flex items-center">
                                    <!-- Dummy Avatar -->
                                    <div class="h-6 w-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mr-3">M</div>
                                    <span>Michael Smith</span>
                                </td>
                                <td class="px-6 py-4 text-right text-xs text-slate-400">03-01-26</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Blood Group Distribution -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Blood Group Distribution</h3>
                    <a href="#" class="text-xs font-semibold text-slate-400 hover:text-red-500 flex items-center transition">View All <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>
                <div class="p-6 flex-1 space-y-5">
                    @foreach([
                        ['label' => 'O Positive', 'color' => 'bg-red-500', 'percent' => '32%'],
                        ['label' => 'A Positive', 'color' => 'bg-orange-400', 'percent' => '27.7%'],
                        ['label' => 'B Positive', 'color' => 'bg-purple-500', 'percent' => '26.2%']
                    ] as $dist)
                    <div>
                        <div class="flex justify-between items-center mb-1 text-sm font-semibold">
                            <div class="flex items-center text-slate-700">
                                <span class="w-3 h-3 rounded-sm {{ $dist['color'] }} mr-2"></span>
                                {{ $dist['label'] }}
                            </div>
                            <span class="text-slate-800 font-bold">{{ $dist['percent'] }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5">
                            <div class="{{ $dist['color'] }} h-1.5 rounded-full" style="width: {{ $dist['percent'] }}"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- PRBC Bags Expiring Soon -->
            <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">PRBC Bags Expiring Soon</h3>
                </div>
                <div class="p-0 overflow-x-auto flex-1">
                    @if($expiringSoon->isEmpty())
                        <div class="p-8 text-center text-slate-500">No PRBC bags expiring within 14 days.</div>
                    @else
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="text-xs text-slate-400 uppercase tracking-wider border-b border-slate-100 bg-white">
                                    <th class="px-6 py-3 font-semibold">Bag No. (RFID)</th>
                                    <th class="px-6 py-3 font-semibold">Blood Group</th>
                                    <th class="px-6 py-3 font-semibold">Expiry Date</th>
                                    <th class="px-6 py-3 font-semibold text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-slate-600">
                                @foreach($expiringSoon as $bag)
                                <tr class="hover:bg-slate-50 transition group">
                                    <td class="px-6 py-4 font-semibold text-slate-800 flex items-center">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400 mr-2"></span>
                                        {{ $bag->bag_rfid }}
                                    </td>
                                    <td class="px-6 py-4">{{ str_replace(['+', '-'], [' Positive', ' Negative'], $bag->blood_group) }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($bag->expiry_date)->format('d-m-y') }}</td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <button class="px-3 py-1 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded text-xs font-semibold transition">Reserve</button>
                                        <button class="px-3 py-1 bg-red-50 hover:bg-red-100 text-red-600 rounded text-xs font-semibold transition">Discard</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <!-- Recent Blood Requests -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Recent Blood Requests</h3>
                    <a href="#" class="text-xs font-semibold text-slate-400 hover:text-red-500 flex items-center transition">View All <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>
                <div class="px-6 pt-3 pb-0 border-b border-slate-100">
                    <div class="flex space-x-6 text-sm font-semibold">
                        <button class="text-red-600 border-b-2 border-red-600 pb-2">Active</button>
                        <button class="text-slate-400 hover:text-slate-600 pb-2 transition">Pending</button>
                    </div>
                </div>
                <div class="p-0 flex-1">
                    <ul class="divide-y divide-slate-50">
                        @foreach([
                            ['name' => 'Emily Johnson', 'hospital' => 'City Hospital', 'date' => '03-01-26', 'status' => 'Urgent', 'color' => 'bg-red-100 text-red-700', 'initial' => 'E', 'bg' => 'bg-yellow-400'],
                            ['name' => 'Michael Smith', 'hospital' => 'Central deepius', 'date' => '03-01-26', 'status' => 'Active', 'color' => 'text-slate-500', 'initial' => 'M', 'bg' => 'bg-blue-400'],
                            ['name' => 'Sarah Brown', 'hospital' => 'Srhodly Hospital', 'date' => '02-01-26', 'status' => 'Active', 'color' => 'text-slate-500', 'initial' => 'S', 'bg' => 'bg-emerald-400']
                        ] as $req)
                        <li class="p-5 flex justify-between items-start hover:bg-slate-50 transition">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full {{ $req['bg'] }} text-white flex items-center justify-center font-bold text-xs mr-4">
                                    {{ $req['initial'] }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">{{ $req['name'] }}</p>
                                    <p class="text-xs text-slate-500">{{ $req['hospital'] }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-400 mb-1">{{ $req['date'] }}</p>
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded {{ $req['color'] }}">{{ $req['status'] }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
