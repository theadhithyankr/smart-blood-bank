<x-app-layout>
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <h1 class="text-xl font-bold text-ink">Donor Registry</h1>
        <p class="text-xs text-ink-faint mt-0.5">Register a new eligible blood donor</p>
    </div>

    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Personal Details</span>
            <span class="badge badge-muted">Step 1 of 2</span>
        </div>
        <div class="p-6 space-y-5">
            <form class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-input" placeholder="e.g. John Doe">
                    </div>
                    <div>
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Blood Group</label>
                        <select class="form-input">
                            <option value="">Select type…</option>
                            @foreach(['O+','O-','A+','A-','B+','B-','AB+','AB-'] as $g)
                            <option>{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Gender</label>
                        <select class="form-input">
                            <option>Male</option><option>Female</option><option>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Contact Number</label>
                        <input type="tel" class="form-input" placeholder="+91 98765 43210">
                    </div>
                    <div>
                        <label class="form-label">National ID</label>
                        <input type="text" class="form-input font-mono" placeholder="XXXX XXXX XXXX">
                    </div>
                </div>
                <div>
                    <label class="form-label">Residential Address</label>
                    <textarea rows="3" class="form-input resize-none" placeholder="Full address…"></textarea>
                </div>

                <!-- Eligibility -->
                <div style="border-top: 1px solid #252a3a;" class="pt-5">
                    <div class="text-xs font-bold uppercase tracking-widest text-ink-faint mb-4">Medical Eligibility</div>
                    <div class="space-y-3">
                        @foreach([
                            'Weight above 50 kg',
                            'No donation in last 3 months',
                            'Free from chronic illness (Diabetes, Hypertension, etc.)',
                            'Haemoglobin ≥ 12.5 g/dL',
                        ] as $check)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="w-4 h-4 rounded border border-surface-border bg-surface-raised flex-shrink-0 group-hover:border-brand/50 transition flex items-center justify-center">
                                <input type="checkbox" class="sr-only peer">
                            </div>
                            <span class="text-sm text-ink-muted group-hover:text-ink transition">{{ $check }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="btn-ghost">Cancel</button>
                    <button type="submit" class="btn-primary">Register Donor</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
