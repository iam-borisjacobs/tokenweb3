@extends('layouts.app')

@section('styles')
    @parent
    <style>
        /* App Settings Specific Polished UI */
        .app-settings-tab-nav {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 6px;
            border-radius: 50rem;
        }
        body.dark-only .app-settings-tab-nav {
            background: #111827 !important;
            border-color: #374151 !important;
        }
        .app-settings-tab-nav .nav-link {
            color: #64748b;
            font-weight: 600;
            font-size: 13.5px;
            padding: 8px 18px;
            border-radius: 50rem;
            transition: all 0.2s ease;
        }
        .app-settings-tab-nav .nav-link:hover {
            color: var(--theme-default, #6362e7);
            background: rgba(99, 98, 231, 0.06);
        }
        .app-settings-tab-nav .nav-link.active {
            color: #fff !important;
            background: var(--theme-default, #6362e7) !important;
            box-shadow: 0 4px 12px rgba(99, 98, 231, 0.3);
        }
        body.dark-only .app-settings-tab-nav .nav-link {
            color: #9ca3af;
        }
        body.dark-only .app-settings-tab-nav .nav-link.active {
            color: #ffffff !important;
        }

        /* Card Panels & Containers */
        .settings-card-section {
            background: #ffffff;
            border: 1px solid #e8ecf2;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .settings-card-section:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }
        body.dark-only .settings-card-section {
            background: #19202f !important;
            border-color: #273142 !important;
            box-shadow: none !important;
        }
        body.dark-only .settings-card-section:hover {
            border-color: #3b485d !important;
        }

        /* Sub cards */
        .settings-subcard {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }
        body.dark-only .settings-subcard {
            background: #111827 !important;
            border-color: #2b3648 !important;
        }

        /* Inputs in Settings */
        .settings-card-section .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        body.dark-only .settings-card-section .form-label {
            color: #e2e8f0;
        }
        .settings-card-section .form-control,
        .settings-card-section .form-select {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 13.5px;
            padding: 8px 12px;
            transition: all 0.2s ease;
        }
        .settings-card-section .form-control:focus,
        .settings-card-section .form-select:focus {
            border-color: var(--theme-default, #6362e7);
            box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.15);
        }
        body.dark-only .settings-card-section .form-control,
        body.dark-only .settings-card-section .form-select {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #f1f5f9 !important;
        }

        /* Selectgroup pill radio toggles */
        .selectgroup {
            display: inline-flex;
            background: #f1f5f9;
            border-radius: 50rem;
            padding: 3px;
            gap: 2px;
            border: 1px solid #e2e8f0;
        }
        body.dark-only .selectgroup {
            background: #0f172a;
            border-color: #334155;
        }
        .selectgroup-item {
            position: relative;
            margin: 0;
            cursor: pointer;
        }
        .selectgroup-input {
            position: absolute;
            opacity: 0;
            z-index: -1;
        }
        .selectgroup-button {
            display: block;
            padding: 4px 14px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            border-radius: 50rem;
            transition: all 0.2s ease;
            user-select: none;
        }
        .selectgroup-input:checked + .selectgroup-button {
            background: var(--theme-default, #6362e7);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(99, 98, 231, 0.35);
        }
        body.dark-only .selectgroup-button {
            color: #94a3b8;
        }
        body.dark-only .selectgroup-input:checked + .selectgroup-button {
            color: #ffffff;
        }

        /* Slide Config Cards & Dark Mode Adjustments */
        .slide-config-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        body.dark-only .slide-config-card {
            background-color: #141b2b !important;
            border-color: #273142 !important;
        }
        body.dark-only .slide-config-card .form-control,
        body.dark-only .slide-config-card .form-select {
            background-color: #0c121e !important;
            border-color: #273142 !important;
            color: #f8fafc !important;
        }
        body.dark-only .slide-config-card .form-control:focus,
        body.dark-only .slide-config-card .form-select:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
        }
        body.dark-only .slide-config-card .form-label {
            color: #cbd5e1 !important;
        }
        body.dark-only .slide-config-card .text-muted {
            color: #94a3b8 !important;
        }
        body.dark-only .slide-preview-box {
            background-color: #0c121e !important;
            border-color: #273142 !important;
        }
        body.dark-only .alert-light {
            background-color: #141b2b !important;
            border-color: #273142 !important;
            color: #cbd5e1 !important;
        }
        body.dark-only .alert-light .text-muted {
            color: #94a3b8 !important;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    @if (!empty($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li><i class="fa fa-warning me-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">App Settings</h3>
                <p class="text-muted mb-0 f-14">Configure platform modules, website information, trading preferences, email servers, and theme displays.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-cogs me-1"></i> System Configuration
                </span>
            </div>
        </div>
    </div>

    <!-- Main Settings Card with Modern Pills -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card p-4 shadow-sm border">
                <!-- Navigation Pills -->
                <ul class="nav nav-pills gap-2 mb-4 p-2 bg-light bg-opacity-50 rounded-3 border flex-wrap" id="appSettingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill px-3 py-2 f-14 f-w-600" id="module-tab" data-bs-toggle="pill" data-bs-target="#module" type="button" role="tab" aria-controls="module" aria-selected="true">
                            <i class="fa fa-cubes me-1"></i> Module
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="info-tab" data-bs-toggle="pill" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">
                            <i class="fa fa-globe me-1"></i> Website Information
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="pref-tab" data-bs-toggle="pill" data-bs-target="#pref" type="button" role="tab" aria-controls="pref" aria-selected="false">
                            <i class="fa fa-sliders me-1"></i> Preference
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="email-tab" data-bs-toggle="pill" data-bs-target="#email" type="button" role="tab" aria-controls="email" aria-selected="false">
                            <i class="fa fa-envelope-o me-1"></i> Email/Google Login-Captcha
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="display-tab" data-bs-toggle="pill" data-bs-target="#display" type="button" role="tab" aria-controls="display" aria-selected="false">
                            <i class="fa fa-paint-brush me-1"></i> Theme/Display
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="wallets-tab" data-bs-toggle="pill" data-bs-target="#wallets" type="button" role="tab" aria-controls="wallets" aria-selected="false">
                            <i class="fa fa-wallet me-1"></i> Crypto Wallet Addresses
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="wallet-types-tab" data-bs-toggle="pill" data-bs-target="#wallet-types" type="button" role="tab" aria-controls="wallet-types" aria-selected="false">
                            <i class="fa fa-plug me-1"></i> Connect Wallet Icons
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="whatsapp-tab" data-bs-toggle="pill" data-bs-target="#whatsapp" type="button" role="tab" aria-controls="whatsapp" aria-selected="false">
                            <i class="fa fa-whatsapp me-1 text-success"></i> WhatsApp Alerts
                        </button>
                    </li>
                </ul>

                <!-- Tab Panes -->
                <div class="tab-content" id="appSettingsTabContent">
                    <div class="tab-pane fade show active" id="module" role="tabpanel" aria-labelledby="module-tab">
                        <livewire:admin.software-module />
                    </div>
                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                        @include('admin.Settings.AppSettings.webinfo')
                    </div>
                    <div class="tab-pane fade" id="pref" role="tabpanel" aria-labelledby="pref-tab">
                        @include('admin.Settings.AppSettings.webpreference')
                    </div>
                    <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                        @include('admin.Settings.AppSettings.email')
                    </div>
                    <div class="tab-pane fade" id="display" role="tabpanel" aria-labelledby="display-tab">
                        <livewire:admin.theme-display />
                    </div>
                    <div class="tab-pane fade" id="wallets" role="tabpanel" aria-labelledby="wallets-tab">
                        @include('admin.Settings.AppSettings.wallet_addresses')
                    </div>
                    <div class="tab-pane fade" id="wallet-types" role="tabpanel" aria-labelledby="wallet-types-tab">
                        @include('admin.Settings.AppSettings.wallet_types')
                    </div>
                    <div class="tab-pane fade" id="whatsapp" role="tabpanel" aria-labelledby="whatsapp-tab">
                        @include('admin.Settings.AppSettings.whatsapp')
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
            // Initialize Select2 if present
            if ($.fn.select2) {
                $('.select2').select2({ width: '100%' });
            }

            // URL Hash Support for direct tab linking (e.g. #info or #pref)
            var hash = window.location.hash;
            if (hash) {
                var tabTriggerEl = document.querySelector('button[data-bs-target="' + hash + '"]');
                if (tabTriggerEl && window.bootstrap && window.bootstrap.Tab) {
                    var tab = bootstrap.Tab.getOrCreateInstance(tabTriggerEl);
                    tab.show();
                }
            }

            // Sync URL hash when tab changes
            var tabButtons = document.querySelectorAll('#appSettingsTabs button[data-bs-toggle="pill"]');
            tabButtons.forEach(function(btn) {
                btn.addEventListener('shown.bs.tab', function(e) {
                    var target = e.target.getAttribute('data-bs-target');
                    if (target) {
                        history.replaceState(null, null, target);
                    }
                });
            });

            // Notification Helper using SweetAlert2
            function notifyUser(type, title, message) {
                if (window.Swal) {
                    Swal.fire({
                        icon: type,
                        title: title,
                        text: message,
                        timer: 2500,
                        showConfirmButton: false
                    });
                } else {
                    alert(message);
                }
            }

            // Currency Change handler
            window.changecurr = function() {
                var e = document.getElementById("select_c");
                if (e) {
                    var selected = e.options[e.selectedIndex].id;
                    var s_c = document.getElementById("s_c");
                    if (s_c) s_c.value = selected;
                }
            };

            // Submit Preference Form via AJAX
            $('#updatepreference').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitBtn = form.find('input[type="submit"], button[type="submit"]');
                submitBtn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('updatepreference') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        notifyUser('success', 'Preferences Updated', response.success || 'Platform preferences have been saved.');
                    },
                    error: function(err) {
                        submitBtn.prop('disabled', false);
                        var errMsg = (err.responseJSON && err.responseJSON.message) ? err.responseJSON.message : 'Could not update preferences.';
                        notifyUser('error', 'Update Failed', errMsg);
                    }
                });
            });

            // Mail Server Switcher Logic
            var sendmailRadio = document.querySelector('#sendmailserver');
            var smtpRadio = document.querySelector('#smtpserver');
            var smtpFields = document.querySelectorAll('.smtp');

            function syncMailServerUI() {
                if (smtpRadio && smtpRadio.checked) {
                    smtpFields.forEach(function(el) {
                        el.classList.remove('d-none');
                    });
                } else {
                    smtpFields.forEach(function(el) {
                        el.classList.add('d-none');
                    });
                }
            }

            if (sendmailRadio) sendmailRadio.addEventListener('change', syncMailServerUI);
            if (smtpRadio) smtpRadio.addEventListener('change', syncMailServerUI);
            syncMailServerUI();

            // Submit Email Configuration Form via AJAX
            $('#emailform').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitBtn = form.find('input[type="submit"], button[type="submit"]');
                submitBtn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('updateemailpreference') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        notifyUser('success', 'Email Settings Saved', response.success || 'Email and authentication settings have been updated.');
                    },
                    error: function(err) {
                        submitBtn.prop('disabled', false);
                        var errMsg = (err.responseJSON && err.responseJSON.message) ? err.responseJSON.message : 'Could not update email settings.';
                        notifyUser('error', 'Update Failed', errMsg);
                    }
                });
            });

            // Submit WhatsApp Configuration Form via AJAX
            $('#whatsappform').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitBtn = $('#saveWhatsAppBtn');
                var origText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Saving...');

                $.ajax({
                    url: "{{ route('updatewhatsapp') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        submitBtn.prop('disabled', false).html(origText);
                        notifyUser('success', 'WhatsApp Settings Saved', response.success || 'Your WhatsApp alert configuration has been updated.');
                    },
                    error: function(err) {
                        submitBtn.prop('disabled', false).html(origText);
                        var errMsg = (err.responseJSON && err.responseJSON.message) ? err.responseJSON.message : 'Could not update WhatsApp settings.';
                        notifyUser('error', 'Update Failed', errMsg);
                    }
                });
            });
        });
    </script>
@endsection
