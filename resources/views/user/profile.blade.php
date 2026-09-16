@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h4 class="mb-1 font-weight-700">Account Settings</h4>
                <p class="text-muted mb-0 f-13">Manage your personal identification, payout withdrawal destinations, and account credentials.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('twofa') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                    <i class="fa fa-shield-alt me-1"></i> Advanced Security (2FA)
                </a>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />
    <x-error-alert />

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-3 p-md-4">
                    <!-- Segmented Navigation Tabs -->
                    <ul class="nav profile-nav-pills mb-4" id="accountSettingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-per" data-bs-toggle="tab" data-bs-target="#per" data-toggle="tab" href="#per" type="button" role="tab" aria-controls="per" aria-selected="true">
                                <i class="fa fa-user-circle"></i>
                                <span>Personal Settings</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-set" data-bs-toggle="tab" data-bs-target="#set" data-toggle="tab" href="#set" type="button" role="tab" aria-controls="set" aria-selected="false">
                                <i class="fa fa-wallet"></i>
                                <span>Withdrawal Settings</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-pas" data-bs-toggle="tab" data-bs-target="#pas" data-toggle="tab" href="#pas" type="button" role="tab" aria-controls="pas" aria-selected="false">
                                <i class="fa fa-lock"></i>
                                <span>Password / Security</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-sec" data-bs-toggle="tab" data-bs-target="#sec" data-toggle="tab" href="#sec" type="button" role="tab" aria-controls="sec" aria-selected="false">
                                <i class="fa fa-bell"></i>
                                <span>Notification Preferences</span>
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Panes -->
                    <div class="tab-content pt-2" id="accountSettingsTabContent">
                        <div class="tab-pane fade show active" id="per" role="tabpanel" aria-labelledby="tab-per">
                            @include('profile.update-profile-information-form')
                        </div>
                        <div class="tab-pane fade" id="set" role="tabpanel" aria-labelledby="tab-set">
                            @include('profile.update-withdrawal-method')
                        </div>
                        <div class="tab-pane fade" id="pas" role="tabpanel" aria-labelledby="tab-pas">
                            @include('profile.update-password-form')
                        </div>
                        <div class="tab-pane fade" id="sec" role="tabpanel" aria-labelledby="tab-sec">
                            @include('profile.update-security-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Support URL hash deep-linking (e.g. #set, #pas, #sec)
            var hash = window.location.hash;
            if (hash) {
                var triggerEl = document.querySelector('#accountSettingsTabs [data-bs-target="' + hash + '"], #accountSettingsTabs [href="' + hash + '"]');
                if (triggerEl && window.bootstrap && window.bootstrap.Tab) {
                    var tab = bootstrap.Tab.getOrCreateInstance(triggerEl);
                    tab.show();
                }
            }

            // Update URL hash on tab switch
            var tabButtons = document.querySelectorAll('#accountSettingsTabs button[data-bs-toggle="tab"]');
            tabButtons.forEach(function(btn) {
                btn.addEventListener('shown.bs.tab', function(event) {
                    var target = event.target.getAttribute('data-bs-target') || event.target.getAttribute('href');
                    if (target) {
                        history.replaceState(null, null, target);
                    }
                });
            });
        });
    </script>
    @endpush
@endsection
