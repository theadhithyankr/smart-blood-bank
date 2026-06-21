<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-slate-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Top KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Stock -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-4 transform transition hover:-translate-y-1 hover:shadow-md">
                    <div class="p-4 bg-red-50 text-red-600 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Total Units in Storage</p>
                        <h3 class="text-3xl font-bold text-slate-800">{{ $totalStock }}</h3>
                    </div>
                </div>

                <!-- Critical Alerts -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-4 transform transition hover:-translate-y-1 hover:shadow-md">
                    <div class="p-4 bg-orange-50 text-orange-600 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Temp Breaches</p>
                        <h3 class="text-3xl font-bold {{ $alerts->count() > 0 ? 'text-red-600' : 'text-slate-800' }}">{{ $alerts->count() }}</h3>
                    </div>
                </div>

                <!-- Expiring Soon -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-4 transform transition hover:-translate-y-1 hover:shadow-md">
                    <div class="p-4 bg-yellow-50 text-yellow-600 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Expiring ≤ 7 Days</p>
                        <h3 class="text-3xl font-bold {{ $expiringSoon->count() > 0 ? 'text-yellow-600' : 'text-slate-800' }}">{{ $expiringSoon->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Stock Overview by Blood Group -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100">
                        <h3 class="text-lg font-semibold text-slate-800">Inventory by Blood Group</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @php
                                $groups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
                            @endphp
                            @foreach($groups as $group)
                                @php $count = $stockByGroup->get($group, 0); @endphp
                                <div class="p-4 rounded-xl border {{ $count > 0 ? 'bg-red-50/50 border-red-100' : 'bg-slate-50 border-slate-100' }} flex flex-col items-center justify-center relative overflow-hidden group transition hover:border-red-300">
                                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-red-100/20 opacity-0 group-hover:opacity-100 transition"></div>
                                    <span class="text-2xl font-black {{ $count > 0 ? 'text-red-600' : 'text-slate-400' }} z-10">{{ $group }}</span>
                                    <span class="text-sm font-medium {{ $count > 0 ? 'text-slate-700' : 'text-slate-400' }} mt-1 z-10">{{ $count }} units</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Temperature Breaches (Alerts) -->
                <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
                    <div class="px-6 py-5 bg-red-50 border-b border-red-100 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-red-800 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Critical Alerts
                        </h3>
                    </div>
                    <div class="p-0">
                        @if($alerts->isEmpty())
                            <div class="p-6 text-center text-slate-500">
                                <p>No temperature breaches detected.</p>
                                <p class="text-sm mt-1 text-emerald-600 font-medium">All units are strictly compliant.</p>
                            </div>
                        @else
                            <ul class="divide-y divide-slate-100 max-h-96 overflow-y-auto">
                                @foreach($alerts as $alert)
                                    <li class="p-4 hover:bg-slate-50 transition">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-bold text-red-600 text-sm">{{ $alert->bag_rfid }}</p>
                                                <p class="text-xs text-slate-500 mt-1">{{ $alert->component_type }} • <span class="font-semibold">{{ $alert->blood_group }}</span></p>
                                                <p class="text-xs text-orange-600 font-medium mt-1">Temp: {{ $alert->current_temperature_celsius }}°C</p>
                                            </div>
                                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-md font-bold uppercase tracking-wider">Breached</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Expiring Soon Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-800">FIFO Queue: Expiring within 7 Days</h3>
                </div>
                <div class="overflow-x-auto">
                    @if($expiringSoon->isEmpty())
                        <div class="p-8 text-center text-slate-500">
                            No blood bags are expiring in the next 7 days.
                        </div>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-100">
                                    <th class="p-4 font-semibold">RFID Tag</th>
                                    <th class="p-4 font-semibold">Blood Group</th>
                                    <th class="p-4 font-semibold">Component</th>
                                    <th class="p-4 font-semibold">Screening</th>
                                    <th class="p-4 font-semibold text-right">Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @foreach($expiringSoon as $bag)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="p-4 font-medium text-slate-800">{{ $bag->bag_rfid }}</td>
                                        <td class="p-4 font-bold text-red-600">{{ $bag->blood_group }}</td>
                                        <td class="p-4 text-slate-600">{{ $bag->component_type }}</td>
                                        <td class="p-4">
                                            @if($bag->screening_status === 'Passed')
                                                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs rounded-md font-medium">Passed</span>
                                            @elseif($bag->screening_status === 'Failed')
                                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-md font-medium">Failed</span>
                                            @else
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-md font-medium">Pending</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-right">
                                            <span class="font-medium text-orange-600">{{ \Carbon\Carbon::parse($bag->expiry_date)->format('M d, Y') }}</span>
                                            <span class="text-xs text-slate-500 block">({{ \Carbon\Carbon::parse($bag->expiry_date)->diffForHumans() }})</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
