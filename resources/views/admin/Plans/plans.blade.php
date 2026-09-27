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
    .plan-card-media {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        min-height: 180px;
        background-color: #0b1120;
        overflow: hidden;
    }
    .plan-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.35s ease;
    }
    .plan-admin-card:hover .plan-card-img {
        transform: scale(1.04);
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
    .plan-tabs-wrapper {
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        padding-bottom: 2px;
    }
    .plan-tabs-wrapper::-webkit-scrollbar {
        display: none;
    }
    .plan-tabs-bar {
        display: inline-flex !important;
        align-items: center !important;
        flex-wrap: nowrap !important;
        white-space: nowrap !important;
        gap: 6px;
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        padding: 5px;
        margin: 0;
    }
    body.dark-only .plan-tabs-bar {
        background-color: #151c30 !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    .plan-tab-btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 50px;
        border: 1px solid transparent;
        background: transparent;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap !important;
        outline: none;
        line-height: 1.3;
        flex-shrink: 0;
    }
    body.dark-only .plan-tab-btn {
        color: #94a3b8;
    }
    .plan-tab-btn:hover {
        color: #0f172a;
        background-color: rgba(99, 98, 231, 0.08);
    }
    body.dark-only .plan-tab-btn:hover {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.06);
    }
    .plan-tab-btn.active {
        background-color: var(--theme-default, #6362e7) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(99, 98, 231, 0.35);
    }
    body.dark-only .plan-tab-btn.active {
        background-color: #6362e7 !important;
        color: #ffffff !important;
    }
    .plan-tab-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 50px;
        display: inline-block;
        line-height: 1.2;
    }
    .badge-truck {
        background-color: #f59e0b;
        color: #1e293b;
    }
    .badge-crypto {
        background-color: #6362e7;
        color: #ffffff;
    }
    .badge-all {
        background-color: #64748b;
        color: #ffffff;
    }
    .plan-tab-btn.active .plan-tab-badge {
        background-color: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff !important;
    }
    @media (max-width: 575.98px) {
        .plan-tabs-bar {
            border-radius: 12px;
            padding: 4px;
            gap: 4px;
        }
        .plan-tab-btn {
            border-radius: 8px;
            padding: 7px 12px;
            font-size: 12px;
        }
    }
</style>

<div class="container-fluid">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
        <div>
            <h3 class="f-w-700 text-dark mb-1">Investment Plans</h3>
            <p class="text-muted mb-0 f-14">Configure, publish, and manage investment packages available to clients.</p>
        </div>
        <div class="flex-shrink-0">
            <a class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-inline-flex align-items-center f-w-600 f-13" href="{{ route('newplan') }}">
                <i class="fa fa-plus-circle me-2"></i> Add New Plan
            </a>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    @php
        $truckPlans = $plans->filter(fn($p) => $p->isTruck());
        $cryptoPlans = $plans->filter(fn($p) => !$p->isTruck());
    @endphp

    <!-- Category Filter Tabs & Total Count -->
    <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3 mb-4">
        <div class="plan-tabs-wrapper">
            <div class="plan-tabs-bar" role="tablist">
                <button type="button" class="plan-tab-btn active" data-tab-target="#tab-truck" role="tab" aria-selected="true">
                    <i class="fa fa-truck text-warning me-1.5"></i>
                    <span>Truck & Asset Investments</span>
                    <span class="plan-tab-badge badge-truck">{{ $truckPlans->count() }}</span>
                </button>
                <button type="button" class="plan-tab-btn" data-tab-target="#tab-crypto" role="tab" aria-selected="false">
                    <i class="fa fa-coins text-primary me-1.5"></i>
                    <span>Crypto & Trading Plans</span>
                    <span class="plan-tab-badge badge-crypto">{{ $cryptoPlans->count() }}</span>
                </button>
                <button type="button" class="plan-tab-btn" data-tab-target="#tab-all" role="tab" aria-selected="false">
                    <i class="fa fa-th-large me-1.5"></i>
                    <span>All Plans</span>
                    <span class="plan-tab-badge badge-all">{{ $plans->count() }}</span>
                </button>
            </div>
        </div>

        <div class="text-muted f-13 d-flex align-items-center flex-shrink-0">
            <i class="fa fa-layer-group text-primary me-1.5"></i>
            Showing <strong class="mx-1 text-dark">{{ $plans->count() }}</strong> packages total across all asset classes
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
        const tabButtons = document.querySelectorAll('.plan-tab-btn');
        tabButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                tabButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-selected', 'false');
                });
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');

                const targetSelector = this.getAttribute('data-tab-target');
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
