<x-app-layout>
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <h1 class="text-xl font-bold text-ink">Donor Registry</h1>
        <p class="text-xs text-ink-faint mt-0.5">Register a new eligible blood donor</p>
    </div>

    <!-- Flash -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="flex items-center gap-3 px-5 py-3 rounded-xl bg-ok/10 border border-ok/30 text-ok text-sm font-medium">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="px-5 py-4 rounded-xl bg-danger/10 border border-danger/30 text-danger text-sm space-y-1">
        @foreach($errors->all() as $error)
        <div class="flex items-center gap-2"><svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Personal Details</span>
            <span class="badge badge-muted">Step 1 of 2</span>
        </div>
        <div class="p-6 space-y-5">
            <form method="POST" action="{{ route('admin.donors.store') }}" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="e.g. John Doe" required>
                    </div>
                    <div>
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" value="{{ old('dob') }}" class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label">Blood Group</label>
                        <select name="blood_group" class="form-input" required>
                            <option value="">Select type…</option>
                            @foreach(['O+','O-','A+','A-','B+','B-','AB+','AB-'] as $g)
                            <option value="{{ $g }}" {{ old('blood_group') === $g ? 'selected' : '' }}>{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-input" required>
                            @foreach(['Male','Female','Other'] as $g)
                            <option value="{{ $g }}" {{ old('gender') === $g ? 'selected' : '' }}>{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Contact Number</label>
                        <input type="tel" name="contact" value="{{ old('contact') }}" class="form-input" placeholder="+91 98765 43210" required>
                    </div>
                    <div>
                        <label class="form-label">National ID</label>
                        <input type="text" name="national_id" value="{{ old('national_id') }}" class="form-input font-mono" placeholder="XXXX XXXX XXXX" required>
                    </div>
                </div>
                <div>
                    <label class="form-label">Residential Address</label>
                    <textarea name="address" rows="3" class="form-input resize-none" placeholder="Full address…">{{ old('address') }}</textarea>
                </div>

                <!-- Eligibility -->
                <div style="border-top: 1px solid #252a3a;" class="pt-5">
                    <div class="text-xs font-bold uppercase tracking-widest text-ink-faint mb-4">Medical Eligibility</div>
                    <div class="space-y-3">
                        @foreach([
                            ['key' => 'eligibility[]', 'val' => 'weight', 'label' => 'Weight above 50 kg'],
                            ['key' => 'eligibility[]', 'val' => 'interval', 'label' => 'No donation in last 3 months'],
                            ['key' => 'eligibility[]', 'val' => 'chronic', 'label' => 'Free from chronic illness (Diabetes, Hypertension, etc.)'],
                            ['key' => 'eligibility[]', 'val' => 'haemoglobin', 'label' => 'Haemoglobin ≥ 12.5 g/dL'],
                        ] as $check)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="{{ $check['key'] }}" value="{{ $check['val'] }}"
                                   class="w-4 h-4 rounded border-surface-border bg-surface-raised text-brand focus:ring-brand/30 focus:ring-2"
                                   {{ in_array($check['val'], old('eligibility', [])) ? 'checked' : '' }}>
                            <span class="text-sm text-ink-muted group-hover:text-ink transition">{{ $check['label'] }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('dashboard') }}" class="btn-ghost">Cancel</a>
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Register Donor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
