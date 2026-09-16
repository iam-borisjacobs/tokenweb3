@extends('layouts.dash')
@section('title', $title ?? 'My Packages')

@section('content')
    <!-- Scoped Theme Tokens & Styling -->
    <style>
        .myplans-view .it-title {
            color: #0f172a !important;
            transition: color 0.2s ease;
        }
        body.dark-only .myplans-view .it-title {
            color: #ffffff !important;
        }

        .myplans-view .it-text {
            color: #334155 !important;
            transition: color 0.2s ease;
        }
        body.dark-only .myplans-view .it-text {
            color: #f1f5f9 !important;
        }

        .myplans-view .it-muted {
            color: #64748b !important;
            transition: color 0.2s ease;
        }
        body.dark-only .myplans-view .it-muted {
            color: #94a3b8 !important;
        }

        .myplans-view .plan-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px 24px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .myplans-view .plan-card:hover {
            transform: translateY(-2px);
            border-color: #6362e7;
            box-shadow: 0 8px 24px rgba(99, 98, 231, 0.12);
        }
        body.dark-only .myplans-view .plan-card {
            background-color: #1a2238;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        body.dark-only .myplans-view .plan-card:hover {
            border-color: rgba(99, 98, 231, 0.6);
            background-color: #1e2742;
        }

        .myplans-view .filter-pill {
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            background-color: #f1f5f9;
            border: 1.5px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .myplans-view .filter-pill:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }
        .myplans-view .filter-pill.active {
            background: linear-gradient(135deg, #6362e7 0%, #4f46e5 100%) !important;
            color: #ffffff !important;
            border-color: #6362e7 !important;
            box-shadow: 0 4px 12px rgba(99, 98, 231, 0.35);
        }
        body.dark-only .myplans-view .filter-pill {
            background-color: #151c30;
            color: #cbd5e1;
            border-color: rgba(255, 255, 255, 0.08);
        }
        body.dark-only .myplans-view .filter-pill:hover {
            background-color: #1d263f;
            color: #ffffff;
            border-color: rgba(99, 98, 231, 0.4);
        }

        .myplans-view .timeline-block {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 16px;
        }
        body.dark-only .myplans-view .timeline-block {
            background-color: #151c30;
            border-color: rgba(255, 255, 255, 0.07);
        }
    </style>

    <div class="myplans-view">
        <!-- Page Header -->
        <div class="page-title mb-4">
            <div class="row align-items-center justify-content-between g-3">
                <div class="col-md-7">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1 p-0 bg-transparent f-12">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="it-muted text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item it-muted">Portfolio & Investments</li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">My Packages</li>
                        </ol>
                    </nav>
                    <h4 class="mb-1 it-title f-w-700">My Investment Packages</h4>
                    <p class="mb-0 it-muted f-13">Track your active packages, monitor daily yield drops, and view maturity schedules.</p>
                </div>
                <div class="col-md-5">
                    <div class="d-flex align-items-center justify-content-md-end gap-2 flex-wrap">
                        <a href="{{ route('mplans') }}" class="btn btn-primary rounded-3 d-inline-flex align-items-center gap-2 f-13 py-2 px-3 shadow-sm text-white" style="color: #ffffff !important;">
                            <i class="fa-solid fa-plus text-white"></i>
                            <span>Explore New Packages</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <x-danger-alert />
        <x-success-alert />

        <!-- Filter Pills Bar -->
        @php
            $currentSort = request()->route('sort') ?? 'All';
            $allCount = \App\Models\User_plans::where('user', Auth::user()->id)->count();
            $activeCount = \App\Models\User_plans::where('user', Auth::user()->id)->where('active', 'yes')->count();
            $expiredCount = \App\Models\User_plans::where('user', Auth::user()->id)->where('active', 'expired')->count();
            $cancelledCount = \App\Models\User_plans::where('user', Auth::user()->id)->where('active', 'cancelled')->count();
        @endphp
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <div class="d-flex align-items-center flex-wrap gap-2">
                <a href="{{ route('myplans', 'All') }}" class="filter-pill {{ $currentSort == 'All' ? 'active' : '' }}">
                    <span>All Packages</span>
                    <span class="badge {{ $currentSort == 'All' ? 'bg-white text-primary' : 'bg-secondary-subtle it-muted' }} rounded-pill f-11 px-2 py-0.5">{{ $allCount }}</span>
                </a>
                <a href="{{ route('myplans', 'yes') }}" class="filter-pill {{ $currentSort == 'yes' ? 'active' : '' }}">
                    <i class="fa-solid fa-circle-play f-11 {{ $currentSort == 'yes' ? 'text-white' : 'text-success' }}"></i>
                    <span>Active</span>
                    <span class="badge {{ $currentSort == 'yes' ? 'bg-white text-success' : 'bg-secondary-subtle it-muted' }} rounded-pill f-11 px-2 py-0.5">{{ $activeCount }}</span>
                </a>
                <a href="{{ route('myplans', 'expired') }}" class="filter-pill {{ $currentSort == 'expired' ? 'active' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left f-11 {{ $currentSort == 'expired' ? 'text-white' : 'text-warning' }}"></i>
                    <span>Expired</span>
                    <span class="badge {{ $currentSort == 'expired' ? 'bg-white text-warning' : 'bg-secondary-subtle it-muted' }} rounded-pill f-11 px-2 py-0.5">{{ $expiredCount }}</span>
                </a>
                <a href="{{ route('myplans', 'cancelled') }}" class="filter-pill {{ $currentSort == 'cancelled' ? 'active' : '' }}">
                    <i class="fa-solid fa-ban f-11 {{ $currentSort == 'cancelled' ? 'text-white' : 'text-danger' }}"></i>
                    <span>Inactive</span>
                    <span class="badge {{ $currentSort == 'cancelled' ? 'bg-white text-danger' : 'bg-secondary-subtle it-muted' }} rounded-pill f-11 px-2 py-0.5">{{ $cancelledCount }}</span>
                </a>
            </div>
            <div class="it-muted f-12">
                Showing <strong>{{ count($plans) }}</strong> of <strong>{{ $allCount }}</strong> contracts
            </div>
        </div>

        <!-- Investment Package Cards List -->
        <div class="row g-3 mb-4">
            @forelse ($plans as $plan)
                <div class="col-12">
                    <div class="plan-card">
                        <div class="row align-items-center g-3">
                            
                            <!-- Left: Package Tier & Capital -->
                            <div class="col-lg-3 col-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="metric-icon-circle {{ $plan->active == 'yes' ? 'primary' : 'neutral' }}" style="width: 44px; height: 44px; font-size: 18px;">
                                        <i class="fa-solid fa-gem"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 it-title f-w-700 f-16">{{ $plan->dplan ? $plan->dplan->name : 'Investment Package' }}</h5>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="it-muted f-12">Capital:</span>
                                            <span class="it-title f-w-700 f-14">{{ $settings->currency }}{{ number_format($plan->amount, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Middle Left: Rate & Accrual Schedule -->
                            <div class="col-lg-3 col-md-3">
                                <span class="it-muted f-11 text-uppercase f-w-600 d-block mb-1">Expected Return</span>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle f-12 f-w-700">
                                        @if ($plan->dplan)
                                            +{{ $plan->dplan->increment_amount }}{{ $plan->dplan->increment_type == 'Percentage' ? '%' : '' }}
                                        @else
                                            ROI
                                        @endif
                                    </span>
                                    <span class="it-muted f-12">{{ $plan->dplan ? $plan->dplan->increment_interval : 'Daily' }}</span>
                                </div>
                            </div>

                            <!-- Middle Right: Timeline (Start & Maturity Dates) -->
                            <div class="col-lg-4 col-md-3">
                                <div class="timeline-block">
                                    <div class="d-flex align-items-center justify-content-between f-11 it-muted mb-1">
                                        <span><i class="fa-regular fa-calendar me-1"></i>Start Date</span>
                                        <span><i class="fa-regular fa-calendar-check me-1"></i>Maturity Date</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between f-12 it-title f-w-600">
                                        <span>{{ $plan->created_at ? $plan->created_at->format('M d, Y') : '-' }}</span>
                                        <i class="fa-solid fa-arrow-right text-primary f-10 mx-2"></i>
                                        <span>{{ $plan->expire_date ? \Carbon\Carbon::parse($plan->expire_date)->format('M d, Y') : '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Status & Action Button -->
                            <div class="col-lg-2 col-md-2 text-md-end">
                                <div class="d-flex align-items-center justify-content-md-end gap-3">
                                    <div>
                                        @if ($plan->active == 'yes')
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1.5 f-12 f-w-600 d-inline-flex align-items-center gap-1">
                                                <span class="rounded-circle bg-success d-inline-block" style="width: 6px; height: 6px;"></span>
                                                <span>Active</span>
                                            </span>
                                        @elseif($plan->active == 'expired')
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1.5 f-12 f-w-600 d-inline-flex align-items-center gap-1">
                                                <span class="rounded-circle bg-warning d-inline-block" style="width: 6px; height: 6px;"></span>
                                                <span>Expired</span>
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1.5 f-12 f-w-600 d-inline-flex align-items-center gap-1">
                                                <span class="rounded-circle bg-danger d-inline-block" style="width: 6px; height: 6px;"></span>
                                                <span>Inactive</span>
                                            </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('plandetails', $plan->id) }}" class="btn btn-outline-secondary btn-sm rounded-circle d-inline-flex align-items-center justify-content-center"
                                       style="width: 36px; height: 36px;" title="View Plan Details">
                                        <i class="fa-solid fa-chevron-right f-12"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-12">
                    <div class="plan-card text-center py-5">
                        <div class="metric-icon-circle neutral mx-auto mb-3" style="width: 64px; height: 64px; font-size: 26px;">
                            <i class="fa-solid fa-seedling it-muted"></i>
                        </div>
                        <h5 class="it-title f-w-700 mb-2">No Investment Packages Found</h5>
                        <p class="it-muted f-13 mb-4 mx-auto" style="max-width: 480px;">
                            You do not currently have any packages in this category. Start earning automated daily yields by joining an investment package today.
                        </p>
                        <a href="{{ route('mplans') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm text-white" style="color: #ffffff !important;">
                            <i class="fa-solid fa-gem me-1 text-white"></i>Explore Investment Packages
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if (count($plans) > 0)
            <div class="d-flex justify-content-center">
                {{ $plans->links() }}
            </div>
        @endif

    </div>
@endsection
