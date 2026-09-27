<form method="POST" action="javascript:void(0)" id="updatemaintenanceform">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <!-- Status Banner -->
        <div class="col-12">
            <div class="p-4 rounded-3 border d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 {{ $settings->maintenance_mode ? 'bg-warning bg-opacity-10 border-warning' : 'bg-success bg-opacity-10 border-success' }}">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center {{ $settings->maintenance_mode ? 'bg-warning text-dark' : 'bg-success text-white' }}" style="width: 48px; height: 48px; font-size: 22px;">
                        <i class="fa {{ $settings->maintenance_mode ? 'fa-wrench' : 'fa-check-circle' }}"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="f-w-700 mb-0 {{ $settings->maintenance_mode ? 'text-warning' : 'text-success' }}">
                                {{ $settings->maintenance_mode ? 'Maintenance Mode is ACTIVE' : 'Maintenance Mode is OFF (Site is LIVE)' }}
                            </h5>
                            <span class="badge {{ $settings->maintenance_mode ? 'bg-warning text-dark' : 'bg-success' }} px-2 py-1 rounded-pill f-11">
                                {{ $settings->maintenance_mode ? 'RESTRICTED' : 'PUBLIC' }}
                            </span>
                        </div>
                        <p class="text-muted mb-0 f-13 mt-1">
                            @if($settings->maintenance_mode)
                                Public visitors and regular users will see the Under Maintenance page (HTTP 503). You (the administrator) can still access the admin panel freely.
                            @else
                                All public landing pages, user portals, registration, and trading operations are fully accessible to the world.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.maintenance.preview') }}" target="_blank" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">
                        <i class="fa fa-eye me-1"></i> Preview Maintenance Page
                    </a>
                </div>
            </div>
        </div>

        <!-- Master Mode Toggle -->
        <div class="col-12">
            <div class="settings-card-section">
                <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom flex-wrap gap-2">
                    <div>
                        <h6 class="f-w-700 mb-0">Under Maintenance Mode Switch</h6>
                        <small class="text-muted">Instantly activate or deactivate the public maintenance screen.</small>
                    </div>
                    <div class="selectgroup">
                        <label class="selectgroup-item">
                            <input type="radio" name="maintenance_mode" value="1" class="selectgroup-input" {{ $settings->maintenance_mode ? 'checked' : '' }}>
                            <span class="selectgroup-button bg-warning text-dark f-w-600 px-4">
                                <i class="fa fa-lock me-1"></i> Maintenance ON
                            </span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="maintenance_mode" value="0" class="selectgroup-input" {{ !$settings->maintenance_mode ? 'checked' : '' }}>
                            <span class="selectgroup-button bg-success text-white f-w-600 px-4">
                                <i class="fa fa-globe me-1"></i> System LIVE
                            </span>
                        </label>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- Title -->
                    <div class="col-md-12">
                        <label class="form-label">Maintenance Headline / Title</label>
                        <input type="text" name="maintenance_title" class="form-control" value="{{ $settings->maintenance_title ?? 'System Maintenance & Infrastructure Upgrade' }}" placeholder="e.g. System Maintenance & Infrastructure Upgrade" required>
                        <small class="text-muted f-12">Displayed prominently as the main headline on the maintenance screen.</small>
                    </div>

                    <!-- Message -->
                    <div class="col-md-12">
                        <label class="form-label">Maintenance Announcement / Explanation</label>
                        <textarea name="maintenance_message" rows="4" class="form-control" placeholder="Explain the maintenance, reassurance on assets, and timeline...">{{ $settings->maintenance_message ?? 'Our quantitative trading infrastructure is currently undergoing scheduled platform optimization and core security upgrades. All client funds, segregated cold vaults, and active investment plans remain 100% secure. Full operations will resume shortly.' }}</textarea>
                        <small class="text-muted f-12">Reassures investors about the security of their assets, active arbitrage algorithms, and scheduled return.</small>
                    </div>

                    <!-- Countdown Target Date -->
                    <div class="col-md-6">
                        <label class="form-label">Estimated Resumption Time (Countdown Timer)</label>
                        <input type="datetime-local" name="maintenance_until" class="form-control" value="{{ $settings->maintenance_until ? \Carbon\Carbon::parse($settings->maintenance_until)->format('Y-m-d\TH:i') : '' }}">
                        <small class="text-muted f-12">Optional. If set in the future, a live ticking countdown timer (Days, Hours, Mins, Secs) will appear on the page.</small>
                    </div>

                    <!-- Bypass Secret Key -->
                    <div class="col-md-6">
                        <label class="form-label">Secret Bypass Key (For VIPs & Testing)</label>
                        <div class="input-group">
                            <input type="text" name="maintenance_secret" id="maintenance_secret_input" class="form-control" value="{{ $settings->maintenance_secret ?? 'ecx_bypass_2026' }}" placeholder="e.g. ecx_bypass_2026">
                            <button type="button" class="btn btn-outline-primary" id="copyBypassBtn" onclick="copyBypassUrl()">
                                <i class="fa fa-copy me-1"></i> Copy Bypass Link
                            </button>
                        </div>
                        <small class="text-muted f-12">
                            Share this link with team members to view the full website during maintenance: 
                            <span class="text-primary" id="bypassUrlPreview">{{ url('/') }}?bypass={{ $settings->maintenance_secret ?? 'ecx_bypass_2026' }}</span>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill f-w-600 shadow-sm" id="saveMaintenanceBtn">
                <i class="fa fa-save me-1"></i> Save Maintenance Settings
            </button>
        </div>
    </div>
</form>

<script>
    function copyBypassUrl() {
        const secret = document.getElementById('maintenance_secret_input').value.trim();
        const fullUrl = "{{ url('/') }}?bypass=" + encodeURIComponent(secret);
        navigator.clipboard.writeText(fullUrl).then(function() {
            if (typeof toastr !== 'undefined') {
                toastr.success('Secret bypass link copied to clipboard!');
            } else {
                alert('Secret bypass link copied to clipboard!\n' + fullUrl);
            }
        });
    }

    document.getElementById('maintenance_secret_input')?.addEventListener('input', function() {
        const preview = document.getElementById('bypassUrlPreview');
        if (preview) {
            preview.textContent = "{{ url('/') }}?bypass=" + encodeURIComponent(this.value.trim());
        }
    });

    document.getElementById('updatemaintenanceform')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('saveMaintenanceBtn');
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Saving...';

        const formData = new FormData(this);

        fetch("{{ route('updatemaintenance') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = originalText;
            if (data.status === 200 || data.success) {
                if (typeof toastr !== 'undefined') {
                    toastr.success(data.success || 'Maintenance settings updated successfully');
                } else {
                    alert(data.success || 'Maintenance settings updated successfully');
                }
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                alert(data.message || 'Failed to update maintenance settings.');
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = originalText;
            alert('An error occurred while saving maintenance settings.');
            console.error(err);
        });
    });
</script>
