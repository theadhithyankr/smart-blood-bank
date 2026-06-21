<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto space-y-6">
        
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-800">Donor Registration Form</h3>
                <p class="text-xs text-slate-500 mt-1">Register a new blood donor into the system.</p>
            </div>
            <div class="p-6">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition" placeholder="e.g. John Doe">
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Date of Birth</label>
                            <input type="date" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
                        </div>

                        <!-- Blood Group -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Blood Group</label>
                            <select class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
                                <option value="">Select Blood Group</option>
                                <option value="O+">O Positive (O+)</option>
                                <option value="O-">O Negative (O-)</option>
                                <option value="A+">A Positive (A+)</option>
                                <option value="A-">A Negative (A-)</option>
                                <option value="B+">B Positive (B+)</option>
                                <option value="B-">B Negative (B-)</option>
                                <option value="AB+">AB Positive (AB+)</option>
                                <option value="AB-">AB Negative (AB-)</option>
                            </select>
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Gender</label>
                            <select class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Contact Number</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition" placeholder="+91 9876543210">
                        </div>

                        <!-- National ID / Aadhar -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">National ID / Aadhar Number</label>
                            <input type="text" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition" placeholder="XXXX XXXX XXXX">
                        </div>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Residential Address</label>
                        <textarea rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition" placeholder="Full address..."></textarea>
                    </div>

                    <!-- Medical Eligibility Checks -->
                    <div class="border-t border-slate-100 pt-6">
                        <h4 class="text-sm font-bold text-slate-800 mb-4">Medical Eligibility Checklist</h4>
                        <div class="space-y-3">
                            <label class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-600 rounded border-slate-300 focus:ring-red-500">
                                <span class="ml-3 text-sm text-slate-600">Donor weight is above 50 kg</span>
                            </label>
                            <label class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-600 rounded border-slate-300 focus:ring-red-500">
                                <span class="ml-3 text-sm text-slate-600">Donor has not donated blood in the last 3 months</span>
                            </label>
                            <label class="flex items-start">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-red-600 rounded border-slate-300 focus:ring-red-500">
                                <span class="ml-3 text-sm text-slate-600">Donor is free from chronic diseases (Diabetes, Hypertension, etc.)</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="button" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-600 font-bold text-sm rounded-lg hover:bg-slate-50 transition mr-3">Cancel</button>
                        <button type="submit" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-lg shadow-sm transition">Register Donor</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
