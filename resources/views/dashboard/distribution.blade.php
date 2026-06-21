<x-app-layout>
    <div class="p-6 max-w-[1600px] mx-auto space-y-6">
        
        <!-- Top KPI Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Issued Today -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Issued Today</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $issuedToday }}</div>
                    <div class="text-sm font-bold text-emerald-500">+9%</div>
                </div>
            </div>

            <!-- Pending Requests -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Pending Requests</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $pendingRequests }}</div>
                    <div class="text-sm font-bold text-red-500">-5%</div>
                </div>
            </div>

            <!-- Total This Month -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Total This Month</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $totalThisMonth }}</div>
                    <div class="text-sm font-bold text-emerald-500">+11%</div>
                </div>
            </div>
        </div>

        <!-- Distribution Requests Table -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col mt-8">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-800">Distribution Requests</h3>
            </div>
            <div class="p-0 overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-[11px] text-slate-400 uppercase tracking-wider border-b border-slate-100 bg-white">
                            <th class="px-6 py-4 font-semibold">Request ID</th>
                            <th class="px-6 py-4 font-semibold">Hospital</th>
                            <th class="px-6 py-4 font-semibold text-center">Blood Type</th>
                            <th class="px-6 py-4 font-semibold text-center">Units</th>
                            <th class="px-6 py-4 font-semibold text-center">Urgency</th>
                            <th class="px-6 py-4 font-semibold">Time</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-slate-600">
                        @foreach([
                            ['id' => 'REQ001', 'hospital' => 'Bagmo Hospital', 'type' => 'O+', 'units' => 3, 'urgency' => 'High', 'urgency_color' => 'text-orange-500 bg-orange-50', 'time' => '09:45 AM', 'status' => 'Processing', 'status_color' => 'bg-yellow-100 text-yellow-700'],
                            ['id' => 'REQ002', 'hospital' => 'Rajagiri Hospital', 'type' => 'B-', 'units' => 2, 'urgency' => 'Critical', 'urgency_color' => 'text-red-600 bg-red-50', 'time' => '10:20 AM', 'status' => 'Approved', 'status_color' => 'bg-blue-100 text-blue-700'],
                            ['id' => 'REQ003', 'hospital' => 'MVR Hospital', 'type' => 'A+', 'units' => 4, 'urgency' => 'Normal', 'urgency_color' => 'text-blue-500 bg-blue-50', 'time' => '11:00 AM', 'status' => 'Dispatched', 'status_color' => 'bg-emerald-100 text-emerald-700']
                        ] as $req)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-5 font-bold text-slate-800">{{ $req['id'] }}</td>
                            <td class="px-6 py-5 font-medium text-slate-600">{{ $req['hospital'] }}</td>
                            <td class="px-6 py-5 text-center font-bold text-red-500">{{ $req['type'] }}</td>
                            <td class="px-6 py-5 text-center font-semibold text-slate-700">{{ $req['units'] }}</td>
                            <td class="px-6 py-5 text-center">
                                <span class="px-2.5 py-1 text-xs font-bold rounded {{ $req['urgency_color'] }}">{{ $req['urgency'] }}</span>
                            </td>
                            <td class="px-6 py-5 text-slate-500">{{ $req['time'] }}</td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1.5 text-[11px] font-bold uppercase tracking-wide rounded-full {{ $req['status_color'] }}">{{ $req['status'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
