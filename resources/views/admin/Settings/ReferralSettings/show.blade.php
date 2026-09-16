@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">Referral & Bonus Settings</h3>
                <p class="text-muted mb-0 f-14">Configure multi-level referral commissions, welcome bonuses, and deposit bonuses.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-gift me-1"></i> Bonus System
                </span>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card p-4 shadow-sm border">
                <!-- Navigation Pills -->
                <ul class="nav nav-pills gap-2 mb-4 p-2 bg-light bg-opacity-50 rounded-3 border flex-wrap" id="referralSettingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill px-3 py-2 f-14 f-w-600" id="referral-tab" data-bs-toggle="pill" data-bs-target="#referralTabPane" type="button" role="tab" aria-controls="referralTabPane" aria-selected="true">
                            <i class="fa fa-users me-1"></i> Referral Commissions
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="otherbonus-tab" data-bs-toggle="pill" data-bs-target="#otherBonusTabPane" type="button" role="tab" aria-controls="otherBonusTabPane" aria-selected="false">
                            <i class="fa fa-gift me-1"></i> Registration & Deposit Bonuses
                        </button>
                    </li>
                </ul>

                <!-- Tab Content Panes -->
                <div class="tab-content" id="referralSettingsTabContent">
                    <div class="tab-pane fade show active" id="referralTabPane" role="tabpanel" aria-labelledby="referral-tab">
                        @include('admin.Settings.ReferralSettings.referral')
                    </div>
                    <div class="tab-pane fade" id="otherBonusTabPane" role="tabpanel" aria-labelledby="otherbonus-tab">
                        @include('admin.Settings.ReferralSettings.other-bonus')
                    </div>
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
        // Notification Helper using SweetAlert2
        function notifyResponse(response, defaultMsg) {
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Saved Successfully',
                    text: response.success || defaultMsg,
                    timer: 2500,
                    showConfirmButton: false
                });
            } else {
                alert(response.success || defaultMsg);
            }
        }

        function notifyError(msg) {
            if (window.Swal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error Occurred',
                    text: msg || 'Failed to update settings. Please check logs and try again.',
                });
            } else {
                alert(msg);
            }
        }

        // Referral Commission Form AJAX
        $('#refform').on('submit', function(e) {
            e.preventDefault();
            var $btn = $(this).find('button[type="submit"]');
            var origHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Saving...');

            $.ajax({
                url: "{{ route('updaterefbonus') }}",
                type: 'POST',
                data: $('#refform').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $btn.prop('disabled', false).html(origHtml);
                    if (response.status === 200 || response.success) {
                        notifyResponse(response, 'Referral bonus settings saved successfully.');
                    } else {
                        notifyError(response.message || 'Unable to save referral bonuses.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(origHtml);
                    var msg = 'An error occurred while saving referral bonuses.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    notifyError(msg);
                }
            });
        });

        // Other Bonus Form AJAX
        $('#bonusform').on('submit', function(e) {
            e.preventDefault();
            var $btn = $(this).find('button[type="submit"]');
            var origHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Saving...');

            $.ajax({
                url: "{{ route('otherbonus') }}",
                type: 'POST',
                data: $('#bonusform').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $btn.prop('disabled', false).html(origHtml);
                    if (response.status === 200 || response.success) {
                        notifyResponse(response, 'Extra bonus settings saved successfully.');
                    } else {
                        notifyError(response.message || 'Unable to save extra bonuses.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(origHtml);
                    var msg = 'An error occurred while saving bonus settings.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    notifyError(msg);
                }
            });
        });
    });
</script>
@endsection
