@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">Swap & Crypto Asset Settings</h3>
                <p class="text-muted mb-0 f-14">Configure instant crypto swap engine, platform exchange fees, currency conversion ratios, and supported assets.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-sync-alt me-1"></i> Swap Engine
                </span>
            </div>
        </div>
    </div>

    <!-- Configuration Cards -->
    <div class="row g-4 mb-5">
        <!-- Feature Status & Exchange Fee -->
        <div class="col-lg-5">
            <div class="card h-100 p-4 shadow-sm border">
                <h5 class="f-w-700 mb-3 text-primary d-flex align-items-center gap-2">
                    <i class="fa fa-sliders"></i> Swap Engine Control
                </h5>

                <!-- Feature Toggle Switch -->
                <div class="p-3 bg-light bg-opacity-50 rounded-3 border mb-4">
                    <label class="form-label f-w-600 f-13 d-block mb-2">Enable Instant Crypto Swap Feature</label>
                    <div class="selectgroup">
                        <label class="selectgroup-item">
                            <input type="radio" name="crypto" id="cryptoyes" value="true" class="selectgroup-input" {{ $moresettings->use_crypto_feature == 'true' ? 'checked' : '' }}>
                            <span class="selectgroup-button"><i class="fa fa-check me-1"></i> Enabled</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="crypto" id="cryptono" value="false" class="selectgroup-input" {{ $moresettings->use_crypto_feature != 'true' ? 'checked' : '' }}>
                            <span class="selectgroup-button"><i class="fa fa-times me-1"></i> Disabled</span>
                        </label>
                    </div>
                    <small class="text-muted d-block mt-2 f-11">When disabled, client investors cannot access the Crypto Swap & Exchange interface in their dashboard.</small>
                </div>

                <!-- Exchange Fee & Rate Form -->
                <form action="{{ route('exchangefee') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Platform Swap Fee (%)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light f-w-600">Fee</span>
                            <input type="number" step="any" min="0" max="100" name="fee" value="{{ $moresettings->fee }}" class="form-control form-control-lg f-w-700" required>
                            <span class="input-group-text bg-light f-w-700">%</span>
                        </div>
                        <small class="text-muted f-11">Deducted on every cryptocurrency swap transaction.</small>
                    </div>

                    @if ($settings->currency != '$')
                        <div class="mb-4">
                            <label class="form-label f-w-600 f-13">{{ $settings->s_currency }} to USD Conversion Rate</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light f-w-600">1 USD =</span>
                                <input type="number" name="rate" value="{{ $moresettings->currency_rate }}" step="any" class="form-control form-control-lg f-w-700" placeholder="450" required>
                                <span class="input-group-text bg-light f-w-600">{{ $settings->s_currency }}</span>
                            </div>
                            <small class="text-muted f-11">Used to compute user balances and equivalent values in your primary currency.</small>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-w-600 w-100">
                        <i class="fa fa-save me-1"></i> Save Swap Parameters
                    </button>
                </form>
            </div>
        </div>

        <!-- Supported Crypto Assets Table -->
        <div class="col-lg-7">
            <div class="card h-100 p-4 shadow-sm border">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <div>
                        <h5 class="f-w-700 mb-1 text-primary d-flex align-items-center gap-2">
                            <i class="fa fa-coins"></i> Supported Crypto Assets
                        </h5>
                        <p class="text-muted f-13 mb-0">Enable or disable specific blockchain assets available in the swap pool.</p>
                    </div>
                </div>

                <div class="alert alert-warning py-2 px-3 rounded-3 f-12 d-flex align-items-center gap-2 mb-3">
                    <i class="fa fa-exclamation-triangle"></i>
                    <span>Please ensure users hold zero balance in an asset before disabling it to prevent stranded funds.</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="f-13 f-w-700">Asset Name</th>
                                <th scope="col" class="f-13 f-w-700">Symbol</th>
                                <th scope="col" class="f-13 f-w-700">Status</th>
                                <th scope="col" class="f-13 f-w-700 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('admin.Settings.Crypto.assets')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function notifySwapFeature(msg) {
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Status Updated',
                    text: msg,
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                alert(msg);
            }
        }

        $('#cryptoyes').on('change', function() {
            if ($(this).is(':checked')) {
                $.ajax({
                    url: "{{ url('admin/dashboard/useexchange/true') }}",
                    type: 'GET',
                    success: function(response) {
                        notifySwapFeature(response.success || 'Swap feature enabled successfully.');
                    },
                    error: function() {
                        if (window.Swal) {
                            Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to update swap feature status.' });
                        }
                    }
                });
            }
        });

        $('#cryptono').on('change', function() {
            if ($(this).is(':checked')) {
                $.ajax({
                    url: "{{ url('admin/dashboard/useexchange/false') }}",
                    type: 'GET',
                    success: function(response) {
                        notifySwapFeature(response.success || 'Swap feature disabled.');
                    },
                    error: function() {
                        if (window.Swal) {
                            Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to update swap feature status.' });
                        }
                    }
                });
            }
        });
    });
</script>
@endsection
