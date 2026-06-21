<x-app-layout>
    <div class="p-6 max-w-[1600px] mx-auto space-y-6">
        
        <!-- Top KPI Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Active Camps -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Active Collection Camps</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $activeCamps }}</div>
                </div>
            </div>

            <!-- Donors Today -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Total Donors Today</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $donorsToday }}</div>
                    <div class="text-sm font-bold text-emerald-500">+12%</div>
                </div>
            </div>

            <!-- Bags Collected -->
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Bags Collected</div>
                <div class="flex justify-between items-end">
                    <div class="text-4xl font-black text-slate-800">{{ $bagsCollected }}</div>
                    <div class="text-sm font-bold text-emerald-500">+14%</div>
                </div>
            </div>
        </div>

        <!-- Ongoing Collections Table -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col mt-8">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="text-base font-bold text-slate-800">Ongoing Blood Collections</h3>
                <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold text-xs rounded-lg shadow-sm transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Start New Collection
                </button>
            </div>
            <div class="p-0 overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-[11px] text-slate-400 uppercase tracking-wider border-b border-slate-100 bg-white">
                            <th class="px-6 py-4 font-semibold">Donor Name</th>
                            <th class="px-6 py-4 font-semibold text-center">Blood Type</th>
                            <th class="px-6 py-4 font-semibold text-center">RFID Tag Assigned</th>
                            <th class="px-6 py-4 font-semibold">Start Time</th>
                            <th class="px-6 py-4 font-semibold">Location</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-slate-600">
                        @foreach([
                            ['name' => 'Rahul Sharma', 'type' => 'O+', 'rfid' => 'BB2026101', 'time' => '10:15 AM', 'location' => 'In-House Center', 'status' => 'In Progress', 'status_color' => 'bg-blue-100 text-blue-700'],
                            ['name' => 'Anita Desai', 'type' => 'A-', 'rfid' => 'BB2026102', 'time' => '10:30 AM', 'location' => 'In-House Center', 'status' => 'Completed', 'status_color' => 'bg-emerald-100 text-emerald-700'],
                            ['name' => 'Karan Patel', 'type' => 'B+', 'rfid' => 'BB2026103', 'time' => '11:00 AM', 'location' => 'City Mall Camp', 'status' => 'Drawing', 'status_color' => 'bg-yellow-100 text-yellow-700']
                        ] as $col)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-5 font-bold text-slate-800">{{ $col['name'] }}</td>
                            <td class="px-6 py-5 text-center font-bold text-red-500">{{ $col['type'] }}</td>
                            <td class="px-6 py-5 text-center font-mono text-xs font-semibold text-slate-500">{{ $col['rfid'] }}</td>
                            <td class="px-6 py-5 text-slate-500">{{ $col['time'] }}</td>
                            <td class="px-6 py-5 text-slate-600">{{ $col['location'] }}</td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1.5 text-[11px] font-bold uppercase tracking-wide rounded-full {{ $col['status_color'] }}">{{ $col['status'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
