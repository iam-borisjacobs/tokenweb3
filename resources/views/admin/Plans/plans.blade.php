@extends('layouts.app')

@section('content')
<style>
    .plan-admin-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 12px;
    }
    .plan-admin-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12) !important;
    }
    .plan-metric-box {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 10px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    body.dark-only .plan-metric-box {
        background-color: rgba(255, 255, 255, 0.04);
        border-color: rgba(255, 255, 255, 0.08);
    }
    .plan-metric-box .metric-label {
        font-size: 11px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
    }
    body.dark-only .plan-metric-box .metric-label {
        color: #94a3b8;
    }
    .plan-metric-box .metric-val {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }
    body.dark-only .plan-metric-box .metric-val {
        color: #f1f5f9;
    }
    .plan-price-strip {
        background: rgba(99, 98, 231, 0.06);
        border: 1px solid rgba(99, 98, 231, 0.2);
        border-radius: 8px;
        padding: 8px 12px;
    }
    body.dark-only .plan-price-strip {
        background: rgba(99, 98, 231, 0.12);
        border-color: rgba(99, 98, 231, 0.3);
    }
    .admin-plan-tabs .nav-link {
        color: #64748b;
        font-weight: 600;
        border-radius: 50px;
        padding: 8px 18px;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        font-size: 13px;
    }
    .admin-plan-tabs .nav-link:hover {
        color: #0f172a;
        background-color: rgba(99, 98, 231, 0.08);
    }
    .admin-plan-tabs .nav-link.active {
        background-color: var(--theme-default, #6362e7) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(99, 98, 231, 0.35);
    }
    body.dark-only .admin-plan-tabs {
        background-color: #151c30 !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    body.dark-only .admin-plan-tabs .nav-link {
        color: #94a3b8;
    }
    body.dark-only .admin-plan-tabs .nav-link:hover {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.06);
    }
    body.dark-only .admin-plan-tabs .nav-link.active {
        background-color: #6362e7 !important;
        color: #ffffff !important;
    }
</style>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">Investment Plans</h3>
                <p class="text-muted mb-0 f-14">Configure, publish, and manage investment packages available to clients.</p>
            </div>
            <div>
                <a class="btn btn-primary px-4 py-2 rounded-pill shadow-sm" href="{{ route('newplan') }}">
                    <i class="fa fa-plus me-1"></i> Add New Plan
                </a>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    @php
        $truckPlans = $plans->filter(fn($p) => $p->isTruck());
        $cryptoPlans = $plans->filter(fn($p) => !$p->isTruck());
    @endphp

    <!-- Category Filter Tabs -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <ul class="nav nav-pills admin-plan-tabs p-1 rounded-pill bg-light border gap-1 d-inline-flex mb-0" id="planTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-truck-btn" data-bs-toggle="pill" data-bs-target="#tab-truck" type="button" role="tab" aria-controls="tab-truck" aria-selected="true">
                    <i class="fa fa-truck text-warning me-1"></i> Truck & Asset Investments 
                    <span class="badge bg-warning text-dark ms-1 px-2 py-1 rounded-pill f-11">{{ $truckPlans->count() }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-crypto-btn" data-bs-toggle="pill" data-bs-target="#tab-crypto" type="button" role="tab" aria-controls="tab-crypto" aria-selected="false">
                    <i class="fa fa-coins text-primary me-1"></i> Crypto & Trading Plans
                    <span class="badge bg-primary text-white ms-1 px-2 py-1 rounded-pill f-11">{{ $cryptoPlans->count() }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-all-btn" data-bs-toggle="pill" data-bs-target="#tab-all" type="button" role="tab" aria-controls="tab-all" aria-selected="false">
                    <i class="fa fa-th-large me-1"></i> All Plans
                    <span class="badge bg-secondary text-white ms-1 px-2 py-1 rounded-pill f-11">{{ $plans->count() }}</span>
                </button>
            </li>
        </ul>

        <div class="text-muted f-13">
            Showing <strong>{{ $plans->count() }}</strong> packages total across all asset classes
        </div>
    </div>

    <!-- Tab Content Panels -->
    <div class="tab-content" id="planTabsContent">
        <!-- TRUCK & ASSET INVESTMENTS TAB -->
        <div class="tab-pane fade show active" id="tab-truck" role="tabpanel" aria-labelledby="tab-truck-btn">
            <div class="row g-3 g-xl-4">
                @forelse ($truckPlans as $plan)
                    @include('admin.Plans.partials.plan-card', ['plan' => $plan])
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="card p-5 border-0 shadow-sm rounded-4">
                            <i class="fa fa-truck f-48 text-warning mb-3"></i>
                            <h4 class="f-w-700">No Truck Investment Plans Configured</h4>
                            <p class="text-muted mb-3">Add commercial fleet and physical asset packages for your investors.</p>
                            <div>
                                <a href="{{ route('newplan') }}" class="btn btn-warning text-dark px-4 py-2 rounded-pill f-w-600 shadow-sm">
                                    <i class="fa fa-plus me-1"></i> Create Truck Plan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- CRYPTO & TRADING PLANS TAB -->
        <div class="tab-pane fade" id="tab-crypto" role="tabpanel" aria-labelledby="tab-crypto-btn">
            <div class="row g-3 g-xl-4">
                @forelse ($cryptoPlans as $plan)
                    @include('admin.Plans.partials.plan-card', ['plan' => $plan])
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="card p-5 border-0 shadow-sm rounded-4">
                            <i class="fa fa-coins f-48 text-primary mb-3"></i>
                            <h4 class="f-w-700">No Crypto Investment Plans Configured</h4>
                            <p class="text-muted mb-3">Configure high-yield cryptocurrency and trading portfolio plans.</p>
                            <div>
                                <a href="{{ route('newplan') }}" class="btn btn-primary px-4 py-2 rounded-pill f-w-600 shadow-sm">
                                    <i class="fa fa-plus me-1"></i> Create Crypto Plan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- ALL PLANS TAB -->
        <div class="tab-pane fade" id="tab-all" role="tabpanel" aria-labelledby="tab-all-btn">
            <div class="row g-3 g-xl-4">
                @forelse ($plans as $plan)
                    @include('admin.Plans.partials.plan-card', ['plan' => $plan])
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="card p-5 border-0 shadow-sm rounded-4">
                            <i class="fa fa-layer-group f-48 text-muted mb-3"></i>
                            <h4 class="f-w-700">No Investment Plans Configured</h4>
                            <p class="text-muted mb-3">Get started by creating your first investment plan for clients.</p>
                            <div>
                                <a href="{{ route('newplan') }}" class="btn btn-primary px-4 py-2 rounded-pill f-w-600 shadow-sm">
                                    <i class="fa fa-plus me-1"></i> Create Plan Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fallback tab switcher in case Bootstrap JS attributes need explicit binding
        const tabButtons = document.querySelectorAll('#planTabs button[data-bs-toggle="pill"]');
        tabButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                tabButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-selected', 'false');
                });
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');

                const targetSelector = this.getAttribute('data-bs-target');
                const panes = document.querySelectorAll('#planTabsContent .tab-pane');
                panes.forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                const activePane = document.querySelector(targetSelector);
                if (activePane) {
                    activePane.classList.add('show', 'active');
                }
            });
        });
    });
</script>
@endsection
