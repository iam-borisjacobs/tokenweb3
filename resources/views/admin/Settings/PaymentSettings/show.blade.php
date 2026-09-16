@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">Payment Settings</h3>
                <p class="text-muted mb-0 f-14">Configure accepted payment methods, deposit/withdrawal preferences, CoinPayments, gateways, and internal transfers.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-credit-card me-1"></i> Finance Engine
                </span>
            </div>
        </div>
    </div>

    <!-- Main Payment Settings Card -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card p-4 shadow-sm border">
                <!-- Navigation Pills -->
                <ul class="nav nav-pills gap-2 mb-4 p-2 bg-light bg-opacity-50 rounded-3 border flex-wrap" id="paymentSettingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill px-3 py-2 f-14 f-w-600" id="methods-tab" data-bs-toggle="pill" data-bs-target="#methodsTabPane" type="button" role="tab" aria-controls="methodsTabPane" aria-selected="true">
                            <i class="fa fa-credit-card me-1"></i> Payment Methods
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="pref-tab" data-bs-toggle="pill" data-bs-target="#prefTabPane" type="button" role="tab" aria-controls="prefTabPane" aria-selected="false">
                            <i class="fa fa-sliders me-1"></i> Payment Preferences
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="coin-tab" data-bs-toggle="pill" data-bs-target="#coinTabPane" type="button" role="tab" aria-controls="coinTabPane" aria-selected="false">
                            <i class="fa fa-coins me-1"></i> CoinPayments
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="gate-tab" data-bs-toggle="pill" data-bs-target="#gateTabPane" type="button" role="tab" aria-controls="gateTabPane" aria-selected="false">
                            <i class="fa fa-server me-1"></i> Gateways (Stripe / PayPal / Paystack)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="trans-tab" data-bs-toggle="pill" data-bs-target="#transTabPane" type="button" role="tab" aria-controls="transTabPane" aria-selected="false">
                            <i class="fa fa-exchange-alt me-1"></i> Internal Transfers
                        </button>
                    </li>
                </ul>

                <!-- Tab Content Panes -->
                <div class="tab-content" id="paymentSettingsTabContent">
                    <div class="tab-pane fade show active" id="methodsTabPane" role="tabpanel" aria-labelledby="methods-tab">
                        @include('admin.Settings.PaymentSettings.deposit')
                    </div>
                    <div class="tab-pane fade" id="prefTabPane" role="tabpanel" aria-labelledby="pref-tab">
                        @include('admin.Settings.PaymentSettings.withdrawal')
                    </div>
                    <div class="tab-pane fade" id="coinTabPane" role="tabpanel" aria-labelledby="coin-tab">
                        @include('admin.Settings.PaymentSettings.coinpayment')
                    </div>
                    <div class="tab-pane fade" id="gateTabPane" role="tabpanel" aria-labelledby="gate-tab">
                        @include('admin.Settings.PaymentSettings.gateway')
                    </div>
                    <div class="tab-pane fade" id="transTabPane" role="tabpanel" aria-labelledby="trans-tab">
                        @include('admin.Settings.PaymentSettings.transfers')
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
                    title: 'Error',
                    text: msg || 'An error occurred while saving. Please try again.',
                });
            } else {
                alert(msg);
            }
        }

        // Generic AJAX form submit handler helper
        function handleAjaxForm(formSelector, url, defaultSuccessMsg) {
            $(formSelector).on('submit', function(e) {
                e.preventDefault();
                var $btn = $(this).find('button[type="submit"], input[type="submit"]');
                var origText = $btn.is('input') ? $btn.val() : $btn.html();
                if ($btn.is('input')) {
                    $btn.prop('disabled', true).val('Saving...');
                } else {
                    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Saving...');
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $(formSelector).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if ($btn.is('input')) {
                            $btn.prop('disabled', false).val(origText);
                        } else {
                            $btn.prop('disabled', false).html(origText);
                        }
                        if (response.status === 200 || response.success) {
                            notifyResponse(response, defaultSuccessMsg);
                        } else {
                            notifyError(response.message || 'Operation could not be completed.');
                        }
                    },
                    error: function(xhr) {
                        if ($btn.is('input')) {
                            $btn.prop('disabled', false).val(origText);
                        } else {
                            $btn.prop('disabled', false).html(origText);
                        }
                        var msg = 'Failed to save settings.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        notifyError(msg);
                    }
                });
            });
        }

        // Initialize AJAX for payment preference, coinpayments, gateways, and internal transfers
        handleAjaxForm('#paypreform', "{{ route('paypreference') }}", 'Payment preferences updated successfully.');
        handleAjaxForm('#coinpayform', "{{ route('updatecpd') }}", 'CoinPayments credentials saved successfully.');
        handleAjaxForm('#gatewayform', "{{ route('updategateway') }}", 'Payment gateway settings saved successfully.');
        handleAjaxForm('#trasfer', "{{ route('updatetransfer') }}", 'Transfer settings updated successfully.');

        // URL Hash Support for direct tab linking
        var hash = window.location.hash;
        if (hash) {
            var tabTrigger = document.querySelector('button[data-bs-target="' + hash + '"]');
            if (tabTrigger && window.bootstrap && window.bootstrap.Tab) {
                bootstrap.Tab.getOrCreateInstance(tabTrigger).show();
            }
        }
        var tabButtons = document.querySelectorAll('#paymentSettingsTabs button[data-bs-toggle="pill"]');
        tabButtons.forEach(function(btn) {
            btn.addEventListener('shown.bs.tab', function(e) {
                var target = e.target.getAttribute('data-bs-target');
                if (target) {
                    history.replaceState(null, null, target);
                }
            });
        });
    });
</script>
@endsection
