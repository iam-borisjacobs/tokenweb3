@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">MT4 / Copytrading Subscription Settings</h3>
                <p class="text-muted mb-0 f-14">Manage trading account master subscriptions, recurring billing rates, and copytrading service access.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-chart-line me-1"></i> Copytrading Engine
                </span>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card p-4 p-md-5 shadow-sm border">
                <form method="POST" action="javascript:void(0)" id="subform">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="1">

                    <div class="p-3 bg-light bg-opacity-50 border rounded-3 mb-4">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="fa fa-robot text-primary f-20"></i>
                            <h5 class="f-w-700 mb-0">Subscription Service Control</h5>
                        </div>
                        <p class="text-muted f-13 mb-3">Enable or disable copytrading and automated MT4/MT5 signal subscriptions across the entire platform.</p>

                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" name="subscription_service" id="subscripton" value="on" class="selectgroup-input" {{ $settings->subscription_service == 'on' ? 'checked' : '' }}>
                                <span class="selectgroup-button"><i class="fa fa-check me-1"></i> Active (On)</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="subscription_service" id="subscriptonoff" value="off" class="selectgroup-input" {{ $settings->subscription_service != 'on' ? 'checked' : '' }}>
                                <span class="selectgroup-button"><i class="fa fa-times me-1"></i> Inactive (Off)</span>
                            </label>
                        </div>
                    </div>

                    <h6 class="f-w-700 mb-3 text-muted text-uppercase f-12">Subscription Pricing Tiers</h6>

                    <div class="row g-4 mb-4">
                        <!-- Monthly Fee -->
                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-13">Monthly Fee (1 Month)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light f-w-600">{{ $settings->currency }}</span>
                                <input type="number" step="any" min="0" name="monthlyfee" class="form-control form-control-lg f-w-700" value="{{ $settings->monthlyfee }}" required>
                            </div>
                            <small class="text-muted f-11">Billed every 30 days</small>
                        </div>

                        <!-- Quarterly Fee -->
                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-13">Quarterly Fee (3 Months)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light f-w-600">{{ $settings->currency }}</span>
                                <input type="number" step="any" min="0" name="quaterlyfee" class="form-control form-control-lg f-w-700" value="{{ $settings->quarterlyfee }}" required>
                            </div>
                            <small class="text-muted f-11">Billed every 90 days</small>
                        </div>

                        <!-- Yearly Fee -->
                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-13">Yearly Fee (12 Months)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light f-w-600">{{ $settings->currency }}</span>
                                <input type="number" step="any" min="0" name="yearlyfee" class="form-control form-control-lg f-w-700" value="{{ $settings->yearlyfee }}" required>
                            </div>
                            <small class="text-muted f-11">Billed annually</small>
                        </div>
                    </div>

                    <div class="pt-3 border-top text-end">
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill f-w-600 shadow-sm" id="subSubmitBtn">
                            <i class="fa fa-save me-1"></i> Save Subscription Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#subform').on('submit', function(e) {
            e.preventDefault();
            var $btn = $('#subSubmitBtn');
            var origHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Saving...');

            $.ajax({
                url: "{{ route('updatesubfee') }}",
                type: 'POST',
                data: $('#subform').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $btn.prop('disabled', false).html(origHtml);
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Saved Successfully',
                            text: response.success || 'Subscription settings saved successfully.',
                            timer: 2200,
                            showConfirmButton: false
                        });
                    } else {
                        alert(response.success || 'Subscription settings saved successfully.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(origHtml);
                    var msg = 'An error occurred while saving subscription settings.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    if (window.Swal) {
                        Swal.fire({ icon: 'error', title: 'Error', text: msg });
                    } else {
                        alert(msg);
                    }
                }
            });
        });
    });
</script>
@endsection
