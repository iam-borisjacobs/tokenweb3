<div class="invest-terminal">
    <!-- Scoped Styling for Investment Terminal -->
    <style>
        /* Default hide wire:loading elements until Livewire is processing */
        [wire\:loading], [wire\:loading\.inline], [wire\:loading\.flex], [wire\:loading\.block] {
            display: none !important;
        }

        /* Semantic theme typography */
        .invest-terminal .it-title {
            color: #0f172a !important;
            transition: color 0.2s ease;
        }
        body.dark-only .invest-terminal .it-title {
            color: #ffffff !important;
        }

        .invest-terminal .it-text {
            color: #334155 !important;
            transition: color 0.2s ease;
        }
        body.dark-only .invest-terminal .it-text {
            color: #f1f5f9 !important;
        }

        .invest-terminal .it-muted {
            color: #64748b !important;
            transition: color 0.2s ease;
        }
        body.dark-only .invest-terminal .it-muted {
            color: #94a3b8 !important;
        }

        .invest-terminal .step-pill {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 3px 8px;
            border-radius: 6px;
            text-transform: uppercase;
        }
        .invest-terminal .terminal-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            transition: all 0.25s ease;
        }
        body.dark-only .invest-terminal .terminal-card {
            background-color: #1a2238;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .invest-terminal .plan-option-card {
            background-color: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .invest-terminal .plan-option-card:hover {
            transform: translateY(-2px);
            border-color: #6362e7;
            box-shadow: 0 6px 16px rgba(99, 98, 231, 0.12);
        }
        .invest-terminal .plan-option-card.active {
            background-color: rgba(99, 98, 231, 0.05);
            border-color: #6362e7;
            box-shadow: 0 0 0 1px #6362e7, 0 8px 20px rgba(99, 98, 231, 0.15);
        }
        body.dark-only .invest-terminal .plan-option-card {
            background-color: #151c30;
            border-color: rgba(255, 255, 255, 0.07);
        }
        body.dark-only .invest-terminal .plan-option-card:hover {
            border-color: rgba(99, 98, 231, 0.6);
            background-color: #182038;
        }
        body.dark-only .invest-terminal .plan-option-card.active {
            background-color: rgba(99, 98, 231, 0.12);
            border-color: #6362e7;
            box-shadow: 0 0 0 1px #6362e7, 0 8px 24px rgba(99, 98, 231, 0.25);
        }
        .invest-terminal .active-selection-banner {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
        }
        body.dark-only .invest-terminal .active-selection-banner {
            background-color: #151c30;
            border-color: rgba(255, 255, 255, 0.08);
        }
        .invest-terminal .quick-amt-btn {
            background-color: #f1f5f9;
            color: #334155;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .invest-terminal .quick-amt-btn:hover {
            background-color: #e2e8f0;
            color: #0f172a;
            border-color: #94a3b8;
            transform: translateY(-1px);
        }
        .invest-terminal .quick-amt-btn.active {
            background: linear-gradient(135deg, #6362e7 0%, #4f46e5 100%) !important;
            color: #ffffff !important;
            border-color: #6362e7 !important;
            box-shadow: 0 4px 12px rgba(99, 98, 231, 0.35);
        }
        body.dark-only .invest-terminal .quick-amt-btn {
            background-color: #151c30;
            color: #cbd5e1;
            border-color: rgba(255, 255, 255, 0.1);
        }
        body.dark-only .invest-terminal .quick-amt-btn:hover {
            background-color: #1d263f;
            color: #ffffff;
            border-color: rgba(99, 98, 231, 0.4);
        }
        .invest-terminal .custom-amt-input {
            height: 52px;
            font-size: 1.25rem;
            font-weight: 700;
            border-radius: 0;
            background-color: #ffffff;
            color: #0f172a;
            border: 1.5px solid #cbd5e1;
            padding-left: 14px;
        }
        body.dark-only .invest-terminal .custom-amt-input {
            background-color: #121829;
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.14);
        }
        .invest-terminal .custom-amt-input:focus {
            border-color: #6362e7;
            box-shadow: 0 0 0 3px rgba(99, 98, 231, 0.25);
        }
        .invest-terminal .input-currency-addon {
            background-color: #f1f5f9;
            color: #475569;
            border: 1.5px solid #cbd5e1;
            border-right: none;
            border-radius: 10px 0 0 10px;
            font-weight: 700;
            font-size: 1rem;
            padding: 0 16px;
        }
        body.dark-only .invest-terminal .input-currency-addon {
            background-color: #1d253d;
            color: #a5b4fc;
            border-color: rgba(255, 255, 255, 0.14);
        }
        .invest-terminal .btn-use-max {
            background: linear-gradient(135deg, #6362e7 0%, #4f46e5 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 12px;
            padding: 0 18px;
            border-radius: 0 10px 10px 0;
            border: 1.5px solid #6362e7;
            border-left: none;
            transition: all 0.2s ease;
        }
        .invest-terminal .btn-use-max:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            color: #ffffff;
        }
        .invest-terminal .payment-card {
            background-color: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .invest-terminal .payment-card.active {
            background-color: rgba(99, 98, 231, 0.05);
            border-color: #6362e7;
            box-shadow: 0 0 0 1px #6362e7, 0 6px 16px rgba(99, 98, 231, 0.12);
        }
        body.dark-only .invest-terminal .payment-card {
            background-color: #151c30;
            border-color: rgba(255, 255, 255, 0.08);
        }
        body.dark-only .invest-terminal .payment-card:hover {
            border-color: rgba(99, 98, 231, 0.5);
            background-color: #182038;
        }
        body.dark-only .invest-terminal .payment-card.active {
            background-color: rgba(99, 98, 231, 0.12);
            border-color: #6362e7;
            box-shadow: 0 0 0 1px #6362e7, 0 6px 20px rgba(99, 98, 231, 0.2);
        }
        .invest-terminal .contract-summary-card {
            position: sticky;
            top: 85px;
            z-index: 10;
        }
        .invest-terminal .contract-hero-banner {
            background: linear-gradient(135deg, rgba(99, 98, 231, 0.08) 0%, rgba(16, 185, 129, 0.06) 100%);
            border: 1.5px solid rgba(99, 98, 231, 0.2);
            border-radius: 12px;
            padding: 18px;
        }
        body.dark-only .invest-terminal .contract-hero-banner {
            background: linear-gradient(135deg, rgba(99, 98, 231, 0.18) 0%, rgba(16, 185, 129, 0.12) 100%);
            border-color: rgba(99, 98, 231, 0.3);
        }
        .invest-terminal .projection-box {
            background: rgba(16, 185, 129, 0.06);
            border: 1.5px solid rgba(16, 185, 129, 0.25);
            border-radius: 10px;
            padding: 14px 16px;
        }
        body.dark-only .invest-terminal .projection-box {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
        }
        .invest-terminal .metric-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px dashed rgba(148, 163, 184, 0.2);
        }
        .invest-terminal .metric-row:last-child {
            border-bottom: none;
        }
        .invest-terminal .spec-label {
            font-size: 12.5px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        body.dark-only .invest-terminal .spec-label {
            color: #94a3b8;
        }
        .invest-terminal .spec-value {
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
        }
        body.dark-only .invest-terminal .spec-value {
            color: #f1f5f9;
        }
        .invest-terminal .btn-invest-action {
            background: linear-gradient(135deg, #6362e7 0%, #4f46e5 100%);
            border: none;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            border-radius: 10px;
            transition: all 0.25s ease;
        }
        .invest-terminal .btn-invest-action:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 98, 231, 0.4);
            color: #ffffff !important;
        }
        .invest-terminal .btn-invest-action:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            background: #475569;
            box-shadow: none;
        }

        .invest-terminal .plan-card-image-wrap img {
            transition: transform 0.35s ease;
        }
        .invest-terminal .plan-option-card:hover .plan-card-image-wrap img {
            transform: scale(1.05);
        }
        .invest-terminal .contract-hero-photo-banner {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }
    </style>

    @if ((!empty($cryptoCount) && $cryptoCount > 0) || (!empty($truckCount) && $truckCount > 0) || count($plans) > 0)
        <!-- Flash & Alert Messages -->
        <div class="mb-3">
            <x-danger-alert />
            <x-success-alert />
            @if (session()->has('message'))
                <div class="alert alert-danger d-flex align-items-center gap-2 alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                    <i class="fa-solid fa-circle-exclamation fs-5 flex-shrink-0"></i>
                    <div>{{ session('message') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success d-flex align-items-center gap-2 alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                    <i class="fa-solid fa-circle-check fs-5 flex-shrink-0 text-success"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="row g-4">
            <!-- Left Column: Investment Configuration Terminal -->
            <div class="col-xl-7 col-lg-7">
                <div class="terminal-card p-4 mb-4">
                    
                    <!-- STEP 1: Select Investment Package -->
                    <div class="section-block mb-4 pb-4 border-bottom border-light-subtle">
                        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="step-pill bg-primary-subtle text-primary border border-primary-subtle">Step 1</span>
                                <h6 class="mb-0 it-title f-w-700 f-15">Select Investment Package</h6>
                            </div>
                            <span class="badge bg-secondary-subtle text-muted rounded-pill f-11">
                                {{ count($plans) }} Packages Available
                            </span>
                        </div>

                        <!-- Category Filter Tabs (Crypto vs Truck/Assets) -->
                        @if (!empty($isCryptoOn) && !empty($isTruckOn))
                            <div class="mb-3 d-flex align-items-center gap-2 flex-wrap">
                                <button type="button" 
                                        class="btn btn-sm rounded-pill px-3 py-2 f-12 f-w-700 d-inline-flex align-items-center gap-2 transition {{ $activeCategory == 'crypto' ? 'btn-primary text-white shadow-sm' : 'btn-outline-secondary' }}" 
                                        wire:click="setCategory('crypto')">
                                    <i class="fa-solid fa-coins"></i>
                                    <span>Crypto & Trading Packages</span>
                                    <span class="badge {{ $activeCategory == 'crypto' ? 'bg-white text-primary' : 'bg-secondary bg-opacity-25 text-muted' }} rounded-pill px-2 py-1 f-10">{{ $cryptoCount ?? 0 }}</span>
                                </button>
                                <button type="button" 
                                        class="btn btn-sm rounded-pill px-3 py-2 f-12 f-w-700 d-inline-flex align-items-center gap-2 transition {{ $activeCategory == 'truck' ? 'btn-warning text-dark shadow-sm' : 'btn-outline-secondary' }}" 
                                        wire:click="setCategory('truck')">
                                    <i class="fa-solid fa-truck"></i>
                                    <span>Trucking & Asset Investments</span>
                                    <span class="badge {{ $activeCategory == 'truck' ? 'bg-dark text-white' : 'bg-secondary bg-opacity-25 text-muted' }} rounded-pill px-2 py-1 f-10">{{ $truckCount ?? 0 }}</span>
                                </button>
                            </div>
                        @endif

                        @if (count($plans) == 0)
                            <div class="text-center py-4 px-3 rounded-3 border border-dashed mb-3" style="background-color: rgba(99, 98, 231, 0.03);">
                                <i class="fa-solid {{ $activeCategory == 'truck' ? 'fa-truck' : 'fa-coins' }} f-28 text-muted mb-2"></i>
                                <h6 class="f-w-700 it-title mb-1">No {{ $activeCategory == 'truck' ? 'Trucking & Asset' : 'Crypto' }} Packages Currently Available</h6>
                                <p class="text-muted f-12 mb-3">There are no packages configured under this category yet.</p>
                                @if (!empty($isCryptoOn) && !empty($isTruckOn))
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" wire:click="setCategory('{{ $activeCategory == 'truck' ? 'crypto' : 'truck' }}')">
                                        View {{ $activeCategory == 'truck' ? 'Crypto Packages' : 'Trucking Investments' }} &rarr;
                                    </button>
                                @endif
                            </div>
                        @else
                            <!-- Interactive Package Selector Grid -->
                            <div class="row g-3 mb-3">
                                @foreach ($plans as $plan)
                                    @php
                                        $isSelected = ($planSelected && $planSelected->id == $plan->id);
                                    @endphp
                                    <div class="col-md-6 col-12">
                                        <div class="plan-option-card h-100 {{ $isSelected ? 'active' : '' }}"
                                             wire:click="selectPlan({{ $plan->id }})">
                                            
                                            @if(!empty($plan->image))
                                                <div class="plan-card-image-wrap mb-2 rounded-2 overflow-hidden position-relative shadow-sm" style="height: 110px; background: #0f172a;">
                                                    <img src="{{ $plan->image_url }}" alt="{{ $plan->name }}" class="w-100 h-100" style="object-fit: cover;">
                                                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(180deg, rgba(0,0,0,0) 30%, rgba(0,0,0,0.72) 100%);"></div>
                                                    <span class="position-absolute bottom-0 start-0 m-2 badge bg-black bg-opacity-75 text-white f-10 rounded-pill px-2 py-1 border border-white border-opacity-25">
                                                        <i class="fa-solid {{ $plan->isTruck() ? 'fa-truck' : 'fa-coins' }} me-1"></i>{{ $plan->category_label }}
                                                    </span>
                                                </div>
                                            @endif

                                            <div class="d-flex align-items-start justify-content-between mb-2">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="metric-icon-circle {{ $isSelected ? 'primary' : 'neutral' }}" style="width: 32px; height: 32px; font-size: 13px;">
                                                        <i class="fa-solid {{ $plan->isTruck() ? 'fa-truck' : 'fa-gem' }}"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 it-title f-w-700 f-14">{{ $plan->name }}</h6>
                                                        <span class="it-muted f-11 d-block"><i class="fa-regular fa-clock me-1"></i>{{ $plan->expiration }}</span>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle f-11 f-w-700">
                                                        +{{ $plan->increment_amount }}{{ $plan->increment_type == 'Percentage' ? '%' : '' }}
                                                    </span>
                                                    <span class="d-block it-muted f-10 mt-1 text-uppercase">{{ $plan->increment_interval }}</span>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between pt-2 mt-2 border-top border-light-subtle f-11">
                                                <span class="it-muted">Min: <strong class="it-title">{{ $settings->currency }}{{ number_format($plan->min_price) }}</strong></span>
                                                <span class="it-muted">Max: <strong class="it-title">{{ $settings->currency }}{{ number_format($plan->max_price) }}</strong></span>
                                            </div>

                                            @if ($isSelected)
                                                <div class="position-absolute top-0 end-0 mt-2 me-2" style="z-index: 3;">
                                                    <span class="badge bg-primary rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 20px; height: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.4);">
                                                        <i class="fa-solid fa-check text-white f-10"></i>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Highlighted Active Package Specs -->
                        @if ($planSelected)
                            <div class="p-3 rounded-3 active-selection-banner d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-primary fs-5"></i>
                                    <div>
                                        <span class="it-muted f-11 text-uppercase d-block f-w-600">Active Selection</span>
                                        <h6 class="mb-0 it-title f-w-700 f-13">{{ $planSelected->name }} &bull; {{ $planSelected->expiration }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div>
                                        <span class="it-muted f-11 d-block">Daily/Periodic Rate</span>
                                        <span class="text-success f-13 f-w-700">
                                            +{{ $planSelected->increment_amount }}{{ $planSelected->increment_type == 'Percentage' ? '%' : '' }} {{ $planSelected->increment_interval }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="it-muted f-11 d-block">Allowed Capital Range</span>
                                        <span class="it-title f-13 f-w-600">
                                            {{ $settings->currency }}{{ number_format($planSelected->min_price) }} &ndash; {{ $settings->currency }}{{ number_format($planSelected->max_price) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- STEP 2: Capital Allocation -->
                    <div class="section-block mb-4 pb-4 border-bottom border-light-subtle">
                        <div class="d-flex align-items-center justify-content-between mb-2 flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="step-pill bg-primary-subtle text-primary border border-primary-subtle">Step 2</span>
                                <h6 class="mb-0 it-title f-w-700 f-15">Capital Allocation</h6>
                            </div>
                            <span class="it-muted f-12">
                                Available ({{ $paymentMethod == 'Connected Wallet' ? 'Web3 Wallet' : 'Account Balance' }}):
                                <strong class="it-title {{ $paymentMethod == 'Connected Wallet' ? 'text-success' : '' }}">{{ $settings->currency }}{{ number_format($activeAvailableBalance, 2) }}</strong>
                            </span>
                        </div>
                        <p class="it-muted f-12 mb-3">Specify the exact capital you wish to allocate to this package.</p>

                        <!-- Quick Amount Preset Pills -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="it-muted f-11 text-uppercase f-w-600">Quick Presets</span>
                                @if ($planSelected)
                                    <span class="it-muted f-11">
                                        Limit: {{ $settings->currency }}{{ number_format($planSelected->min_price) }} &ndash; {{ $settings->currency }}{{ number_format($planSelected->max_price) }}
                                    </span>
                                @endif
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @if ($planSelected)
                                    <!-- Plan Min Button -->
                                    <button type="button" class="quick-amt-btn {{ intval($amountToInvest) == intval($planSelected->min_price) ? 'active' : '' }}"
                                            wire:click="selectAmount('{{ $planSelected->min_price }}')">
                                        Min ({{ $settings->currency }}{{ number_format($planSelected->min_price) }})
                                    </button>
                                @endif

                                @php
                                    $presets = [500, 1000, 2500, 5000, 10000, 25000, 50000];
                                @endphp
                                @foreach ($presets as $val)
                                    @if (!$planSelected || ($val >= $planSelected->min_price && $val <= $planSelected->max_price && $val != $planSelected->min_price && $val != $planSelected->max_price))
                                        <button type="button" class="quick-amt-btn {{ intval($amountToInvest) == $val ? 'active' : '' }}"
                                                wire:click="selectAmount('{{ $val }}')">
                                            {{ $settings->currency }}{{ number_format($val) }}
                                        </button>
                                    @endif
                                @endforeach

                                @if ($planSelected && $planSelected->min_price != $planSelected->max_price)
                                    <!-- Plan Max Button -->
                                    <button type="button" class="quick-amt-btn {{ intval($amountToInvest) == intval($planSelected->max_price) ? 'active' : '' }}"
                                            wire:click="selectAmount('{{ $planSelected->max_price }}')">
                                        Max ({{ $settings->currency }}{{ number_format($planSelected->max_price) }})
                                    </button>
                                @endif

                                <!-- Available Source Balance Max Button -->
                                @php
                                    $maxAllowed = $planSelected ? min($activeAvailableBalance, $planSelected->max_price) : $activeAvailableBalance;
                                @endphp
                                @if ($maxAllowed > 0 && (!$planSelected || ($maxAllowed != $planSelected->min_price && $maxAllowed != $planSelected->max_price)))
                                    <button type="button" class="quick-amt-btn {{ intval($amountToInvest) == intval($maxAllowed) ? 'active' : '' }}"
                                            wire:click="selectAmount('{{ $maxAllowed }}')">
                                        <i class="fa-solid {{ $paymentMethod == 'Connected Wallet' ? 'fa-link' : 'fa-wallet' }} me-1"></i>Max Available ({{ $settings->currency }}{{ number_format($maxAllowed) }})
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Amount Input Group -->
                        <div class="mb-3">
                            <label class="form-label it-muted f-12 mb-1">Enter Capital Amount ({{ $settings->currency }} USD)</label>
                            <div class="input-group">
                                <span class="input-group-text input-currency-addon">
                                    <i class="fa-solid fa-dollar-sign me-1"></i>USD
                                </span>
                                <input type="number" required wire:model="amountToInvest"
                                       wire:keyup="checkIfAmountIsEmpty"
                                       class="form-control custom-amt-input"
                                       placeholder="e.g. 5000"
                                       min="{{ $planSelected ? $planSelected->min_price : '0' }}"
                                       max="{{ $planSelected ? $planSelected->max_price : '10000000000' }}">
                                @if ($maxAllowed > 0)
                                    <button type="button" class="btn btn-use-max"
                                            wire:click="selectAmount('{{ $maxAllowed }}')">
                                        USE MAX
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Dynamic Range & Balance Guidance Banner -->
                        @if ($planSelected)
                            @php
                                $amt = floatval($amountToInvest);
                                $min = floatval($planSelected->min_price);
                                $max = floatval($planSelected->max_price);
                                $bal = floatval($activeAvailableBalance);
                            @endphp
                            @if ($amt > 0)
                                @if ($amt < $min)
                                    <div class="p-2 px-3 rounded-3 f-12 d-flex align-items-center gap-2"
                                         style="background-color: rgba(245, 158, 11, 0.12) !important; border: 1px solid rgba(245, 158, 11, 0.3) !important; color: #d97706 !important;">
                                        <i class="fa-solid fa-triangle-exclamation flex-shrink-0" style="color: #d97706 !important; font-size: 14px;"></i>
                                        <span style="color: #d97706 !important;">Amount is <strong>below</strong> the minimum requirement of <strong>{{ $settings->currency }}{{ number_format($min) }}</strong>.</span>
                                    </div>
                                @elseif ($amt > $max)
                                    <div class="p-2 px-3 rounded-3 f-12 d-flex align-items-center gap-2"
                                         style="background-color: rgba(245, 158, 11, 0.12) !important; border: 1px solid rgba(245, 158, 11, 0.3) !important; color: #d97706 !important;">
                                        <i class="fa-solid fa-triangle-exclamation flex-shrink-0" style="color: #d97706 !important; font-size: 14px;"></i>
                                        <span style="color: #d97706 !important;">Amount <strong>exceeds</strong> the maximum limit of <strong>{{ $settings->currency }}{{ number_format($max) }}</strong> for this package.</span>
                                    </div>
                                @elseif ($amt > $bal)
                                    @if ($paymentMethod == 'Connected Wallet')
                                        <div class="p-2.5 px-3 rounded-3 f-12"
                                             style="background-color: rgba(239, 68, 68, 0.12) !important; border: 1px solid rgba(239, 68, 68, 0.3) !important; color: #ef4444 !important;">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="fa-solid fa-circle-xmark flex-shrink-0" style="color: #ef4444 !important; font-size: 14px;"></i>
                                                    <span style="color: #ef4444 !important; font-weight: 500;">
                                                        @if ($hasConnectedWallet)
                                                            @if (!empty($selectedWalletId) && $selectedWalletId !== 'all')
                                                                Selected wallet balance is insufficient ({{ $settings->currency }}{{ number_format($bal, 2) }} available for {{ $settings->currency }}{{ number_format($amt) }} allocation).
                                                            @else
                                                                Insufficient connected wallet balance ({{ $settings->currency }}{{ number_format($bal, 2) }} available).
                                                            @endif
                                                        @else
                                                            No connected Web3 wallet found. Please link your wallet.
                                                        @endif
                                                    </span>
                                                </div>
                                                @if ($hasConnectedWallet)
                                                    <a href="{{ route('portfolio') }}"
                                                       style="background-color: #dc2626 !important; color: #ffffff !important; border: 1px solid #b91c1c !important; font-size: 11.5px !important; font-weight: 700 !important; text-decoration: none !important; border-radius: 50px !important; padding: 5px 14px !important; display: inline-flex !important; align-items: center !important; gap: 5px; line-height: 1.4 !important; box-shadow: 0 2px 6px rgba(220, 38, 38, 0.4) !important;">
                                                        <i class="fa-solid fa-wallet" style="color: #ffffff !important; font-size: 10px !important;"></i>
                                                        <span style="color: #ffffff !important; font-weight: 700 !important; font-size: 11.5px !important;">Manage Wallets</span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('connect.wallet') }}"
                                                       style="background-color: #dc2626 !important; color: #ffffff !important; border: 1px solid #b91c1c !important; font-size: 11.5px !important; font-weight: 700 !important; text-decoration: none !important; border-radius: 50px !important; padding: 5px 14px !important; display: inline-flex !important; align-items: center !important; gap: 5px; line-height: 1.4 !important; box-shadow: 0 2px 6px rgba(220, 38, 38, 0.4) !important;">
                                                        <i class="fa-solid fa-link" style="color: #ffffff !important; font-size: 10px !important;"></i>
                                                        <span style="color: #ffffff !important; font-weight: 700 !important; font-size: 11.5px !important;">Connect Wallet</span>
                                                    </a>
                                                @endif
                                            </div>
                                            @if (!empty($selectedWalletId) && $selectedWalletId !== 'all' && $totalWalletBal >= $amt)
                                                <div class="mt-2 pt-2 border-top d-flex align-items-center justify-content-between flex-wrap gap-2" style="border-color: rgba(239, 68, 68, 0.25) !important;">
                                                    <span class="f-11" style="color: #fca5a5 !important;">
                                                        <i class="fa-solid fa-coins me-1 text-warning"></i>Your combined wallet balance has <strong>{{ $settings->currency }}{{ number_format($totalWalletBal, 2) }}</strong> available!
                                                    </span>
                                                    <button type="button" wire:click="selectWallet('all')"
                                                            class="btn btn-xs rounded-pill px-2.5 py-1 f-11 f-w-700"
                                                            style="background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; color: #ffffff !important; border: none !important; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.4) !important;">
                                                        <i class="fa-solid fa-layer-group me-1"></i>Switch to All Combined ({{ $settings->currency }}{{ number_format($totalWalletBal, 2) }})
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="p-2 px-3 rounded-3 f-12"
                                             style="background-color: rgba(239, 68, 68, 0.12) !important; border: 1px solid rgba(239, 68, 68, 0.3) !important; color: #ef4444 !important;">
                                            <div class="d-flex align-items-center justify-content-between gap-2">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="fa-solid fa-circle-xmark flex-shrink-0" style="color: #ef4444 !important; font-size: 14px;"></i>
                                                    <span style="color: #ef4444 !important; font-weight: 500;">Insufficient account balance ({{ $settings->currency }}{{ number_format($bal, 2) }} available).</span>
                                                </div>
                                                <a href="{{ route('deposits') }}"
                                                   style="background-color: #dc2626 !important; color: #ffffff !important; border: 1px solid #b91c1c !important; font-size: 11.5px !important; font-weight: 700 !important; text-decoration: none !important; border-radius: 50px !important; padding: 5px 14px !important; display: inline-flex !important; align-items: center !important; gap: 5px; line-height: 1.4 !important; box-shadow: 0 2px 6px rgba(220, 38, 38, 0.4) !important;">
                                                    <i class="fa-solid fa-plus" style="color: #ffffff !important; font-size: 10px !important;"></i>
                                                    <span style="color: #ffffff !important; font-weight: 700 !important; font-size: 11.5px !important;">Deposit Now</span>
                                                </a>
                                            </div>
                                            @if ($totalWalletBal >= $amt)
                                                <div class="mt-2 pt-2 border-top d-flex align-items-center justify-content-between flex-wrap gap-2" style="border-color: rgba(239, 68, 68, 0.25) !important;">
                                                    <span class="f-11" style="color: #fca5a5 !important;">
                                                        <i class="fa-solid fa-coins me-1 text-warning"></i>You have <strong>{{ $settings->currency }}{{ number_format($totalWalletBal, 2) }}</strong> in your connected Web3 wallet!
                                                    </span>
                                                    <button type="button" wire:click="changePaymentMethod('Connected Wallet')"
                                                            class="btn btn-xs rounded-pill px-2.5 py-1 f-11 f-w-700"
                                                            style="background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; color: #ffffff !important; border: none !important; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.4) !important;">
                                                        <i class="fa-solid fa-arrow-right-arrow-left me-1"></i>Pay via Web3 Wallet
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @else
                                    <div class="p-2 px-3 rounded-3 f-12 d-flex align-items-center gap-2"
                                         style="background-color: rgba(16, 185, 129, 0.12) !important; border: 1px solid rgba(16, 185, 129, 0.3) !important; color: #10b981 !important;">
                                        <i class="fa-solid fa-circle-check flex-shrink-0" style="color: #10b981 !important; font-size: 14px;"></i>
                                        <span style="color: #10b981 !important; font-weight: 500;">
                                            Eligible capital allocation. Ready to activate via <strong>{{ $paymentMethod == 'Connected Wallet' ? 'Connected Web3 Wallet' : 'Main Account Balance' }}</strong>.
                                        </span>
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>

                    <!-- STEP 3: Funding Source (Dual Options) -->
                    <div class="section-block">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="step-pill bg-primary-subtle text-primary border border-primary-subtle">Step 3</span>
                                <h6 class="mb-0 it-title f-w-700 f-15">Payment Method & Funding Source</h6>
                            </div>
                            <span class="it-muted f-11"><i class="fa-solid fa-shield-halved text-success me-1"></i>Instant Debit</span>
                        </div>

                        <!-- 2 Distinct Selectable Payment Options -->
                        <div class="row g-3 mb-2">
                            <!-- Option 1: Main Account Balance -->
                            <div class="col-md-6 col-12">
                                <div class="payment-card h-100 {{ $paymentMethod == 'Account Balance' ? 'active' : '' }} d-flex flex-column justify-content-between"
                                     wire:click="changePaymentMethod('Account Balance')">
                                    <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                        <div class="d-flex align-items-center gap-2.5">
                                            <div class="metric-icon-circle primary" style="width: 38px; height: 38px; font-size: 15px;">
                                                <i class="fa-solid fa-wallet"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 it-title f-w-700 f-13">Main Account Balance</h6>
                                                <span class="it-muted f-11">On-Platform Deposit</span>
                                            </div>
                                        </div>
                                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                                             style="width: 20px; height: 20px; border: 2px solid {{ $paymentMethod == 'Account Balance' ? '#6362e7' : 'rgba(148, 163, 184, 0.4)' }}; background-color: {{ $paymentMethod == 'Account Balance' ? '#6362e7' : 'transparent' }};">
                                            @if ($paymentMethod == 'Account Balance')
                                                <i class="fa-solid fa-check text-white f-10"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="pt-2 border-top border-light-subtle d-flex align-items-center justify-content-between flex-wrap gap-1">
                                        <span class="it-muted f-11">Available Capital</span>
                                        <span class="f-13 f-w-700 it-title">{{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Option 2: Connected Web3 Wallet -->
                            <div class="col-md-6 col-12">
                                <div class="payment-card h-100 {{ $paymentMethod == 'Connected Wallet' ? 'active' : '' }} d-flex flex-column justify-content-between"
                                     wire:click="changePaymentMethod('Connected Wallet')">
                                    <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                        <div class="d-flex align-items-center gap-2.5">
                                            <div class="metric-icon-circle success" style="width: 38px; height: 38px; font-size: 15px; background: rgba(16, 185, 129, 0.15); color: #10b981;">
                                                <i class="fa-solid fa-link"></i>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center gap-1">
                                                    <h6 class="mb-0 it-title f-w-700 f-13">Connected Web3 Wallet</h6>
                                                    @if ($hasConnectedWallet)
                                                        <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 9px; padding: 2px 5px;">Synced</span>
                                                    @else
                                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle" style="font-size: 9px; padding: 2px 5px;">Unlinked</span>
                                                    @endif
                                                </div>
                                                <span class="it-muted f-11">
                                                    @if ($hasConnectedWallet)
                                                        {{ $userWallets->count() }} Wallet{{ $userWallets->count() > 1 ? 's' : '' }} Linked
                                                    @else
                                                        Direct Web3 Settlement
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                                             style="width: 20px; height: 20px; border: 2px solid {{ $paymentMethod == 'Connected Wallet' ? '#6362e7' : 'rgba(148, 163, 184, 0.4)' }}; background-color: {{ $paymentMethod == 'Connected Wallet' ? '#6362e7' : 'transparent' }};">
                                            @if ($paymentMethod == 'Connected Wallet')
                                                <i class="fa-solid fa-check text-white f-10"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="pt-2 border-top border-light-subtle d-flex align-items-center justify-content-between flex-wrap gap-1">
                                        <span class="it-muted f-11">Available Capital</span>
                                        @if ($hasConnectedWallet)
                                            <span class="f-13 f-w-700 text-success">{{ $settings->currency }}{{ number_format($totalWalletBal, 2) }}</span>
                                        @else
                                            <a href="{{ route('connect.wallet') }}" class="f-11 text-primary f-w-600 text-decoration-none">
                                                <i class="fa-solid fa-plus me-1"></i>Connect Wallet
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Multi-wallet specific selector if user has more than 1 connected wallet -->
                        @if ($paymentMethod == 'Connected Wallet' && $hasConnectedWallet && $userWallets->count() > 1)
                            <div class="p-3 rounded-3 mt-3" style="background-color: rgba(99, 98, 231, 0.05); border: 1px dashed rgba(99, 98, 231, 0.3);">
                                <div class="d-flex align-items-center justify-content-between mb-2 flex-wrap gap-2">
                                    <span class="it-muted f-11 text-uppercase f-w-600">Choose Debit Wallet:</span>
                                    <span class="f-11 text-primary f-w-600">Combined: {{ $settings->currency }}{{ number_format($totalWalletBal, 2) }}</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="button" wire:click="selectWallet('all')"
                                            class="quick-amt-btn py-1 px-2.5 f-11 {{ $selectedWalletId === 'all' ? 'active' : '' }}">
                                        <i class="fa-solid fa-layer-group me-1"></i>All Combined ({{ $settings->currency }}{{ number_format($totalWalletBal, 2) }})
                                    </button>
                                    @foreach ($userWallets as $w)
                                        @php
                                            $isLow = ($amt > 0 && (float)$w->balance < $amt);
                                        @endphp
                                        <button type="button" wire:click="selectWallet('{{ $w->id }}')"
                                                class="quick-amt-btn py-1 px-2.5 f-11 {{ $selectedWalletId == $w->id ? 'active' : '' }}"
                                                style="{{ $isLow && $selectedWalletId != $w->id ? 'opacity: 0.8;' : '' }}">
                                            <i class="fa-solid fa-wallet me-1 {{ $isLow ? 'text-warning' : 'text-primary' }}"></i>
                                            {{ $w->wallet_provider ?: 'Wallet' }} ({{ $settings->currency }}{{ number_format($w->balance, 2) }})
                                            @if ($isLow)
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle ms-1" style="font-size: 8.5px; padding: 1px 4px;">Low</span>
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Right Column: Contract Summary & Return Projection Card -->
            <div class="col-xl-5 col-lg-5">
                <div class="terminal-card contract-summary-card p-4 shadow-sm">
                    
                    <!-- Contract Header -->
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h6 class="mb-0 it-title f-w-700 f-16">Contract Overview</h6>
                            <span class="it-muted f-12">Smart Contract Investment Summary</span>
                        </div>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 f-11">
                            <i class="fa-solid fa-shield-halved me-1"></i>Verified
                        </span>
                    </div>

                    <!-- Selected Plan Hero Banner -->
                    @if ($planSelected && !empty($planSelected->image))
                        <div class="contract-hero-banner contract-hero-photo-banner mb-3 position-relative rounded-3 overflow-hidden shadow-sm" 
                             style="min-height: 145px; background: url('{{ $planSelected->image_url }}') center/cover no-repeat; border: 1px solid rgba(255, 255, 255, 0.15);">
                            <!-- High-contrast frosted gradient backdrop overlay -->
                            <div class="position-absolute top-0 start-0 w-100 h-100" 
                                 style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.88) 0%, rgba(15, 23, 42, 0.62) 50%, rgba(15, 23, 42, 0.9) 100%); backdrop-filter: blur(1.5px);"></div>
                            
                            <div class="position-relative p-3 p-xl-4 d-flex flex-column justify-content-between h-100" style="z-index: 2;">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div>
                                        <div class="d-flex align-items-center gap-1 mb-1">
                                            <span class="badge {{ $planSelected->isTruck() ? 'bg-warning text-dark' : 'bg-primary text-white' }} f-10 rounded-pill px-2 py-1 f-w-700 shadow-sm">
                                                <i class="fa-solid {{ $planSelected->isTruck() ? 'fa-truck' : 'fa-coins' }} me-1"></i>{{ $planSelected->category_label }}
                                            </span>
                                            <span class="badge bg-white bg-opacity-20 text-white border border-white border-opacity-25 rounded-pill f-10 px-2 py-1">
                                                <i class="fa-regular fa-clock me-1"></i>{{ $planSelected->expiration }}
                                            </span>
                                        </div>
                                        <h5 class="mb-0 text-white f-w-800" style="letter-spacing: -0.02em; text-shadow: 0 2px 4px rgba(0,0,0,0.6);">{{ $planSelected->name }}</h5>
                                    </div>
                                    <div class="text-end">
                                        <span class="text-white text-opacity-75 f-10 text-uppercase f-w-700 d-block">Yield Rate</span>
                                        <h4 class="mb-0 text-success f-w-900" style="text-shadow: 0 2px 6px rgba(0,0,0,0.6);">
                                            +{{ $planSelected->increment_amount }}{{ $planSelected->increment_type == 'Percentage' ? '%' : '' }}
                                        </h4>
                                        <span class="text-white text-opacity-75 f-10 text-uppercase d-block">{{ $planSelected->increment_interval }}</span>
                                    </div>
                                </div>
                                <div class="mt-2 pt-2 border-top border-white border-opacity-20 d-flex align-items-center justify-content-between text-white f-11">
                                    <span class="text-white text-opacity-75"><i class="fa-solid fa-shield-halved text-warning me-1"></i>{{ $planSelected->isTruck() ? 'Asset-Backed Allocation' : 'Protected Smart Contract' }}</span>
                                    <span class="f-w-700 text-white">{{ $settings->currency }}{{ number_format($planSelected->min_price) }} &ndash; {{ $settings->currency }}{{ number_format($planSelected->max_price) }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="contract-hero-banner mb-3">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <span class="it-muted f-11 text-uppercase f-w-600 d-block">Package Tier</span>
                                    <h5 class="mb-1 it-title f-w-700">{{ $planSelected ? $planSelected->name : 'No Package Selected' }}</h5>
                                    <span class="badge bg-primary rounded-pill f-11 px-2 py-1 text-white">
                                        <i class="fa-regular fa-clock me-1 text-white"></i>{{ $planSelected ? $planSelected->expiration : '-' }}
                                    </span>
                                </div>
                                <div class="text-end">
                                    <span class="it-muted f-11 text-uppercase f-w-600 d-block">Yield Rate</span>
                                    <h4 class="mb-0 text-success f-w-800">
                                        @if ($planSelected)
                                            +{{ $planSelected->increment_amount }}{{ $planSelected->increment_type == 'Percentage' ? '%' : '' }}
                                        @else
                                            -
                                        @endif
                                    </h4>
                                    <span class="it-muted f-10 text-uppercase d-block">{{ $planSelected ? $planSelected->increment_interval : '' }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Contract Specification Table -->
                    <div class="contract-specs mb-3">
                        <div class="metric-row">
                            <span class="spec-label"><i class="fa-solid fa-layer-group text-primary"></i>Plan Name</span>
                            <span class="spec-value it-title">{{ $planSelected ? $planSelected->name : '-' }}</span>
                        </div>
                        <div class="metric-row">
                            <span class="spec-label"><i class="fa-regular fa-calendar-check text-info"></i>Term Duration</span>
                            <span class="spec-value it-title">{{ $planSelected ? $planSelected->expiration : '-' }}</span>
                        </div>
                        <div class="metric-row">
                            <span class="spec-label"><i class="fa-solid fa-chart-line text-success"></i>Return Accrual</span>
                            <span class="spec-value text-success">
                                @if ($planSelected)
                                    @if ($planSelected->increment_type == 'Fixed')
                                        {{ $settings->currency }}{{ number_format($planSelected->increment_amount, 2) }} {{ $planSelected->increment_interval }}
                                    @else
                                        {{ $planSelected->increment_amount }}% {{ $planSelected->increment_interval }}
                                    @endif
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="metric-row">
                            <span class="spec-label"><i class="fa-solid fa-arrows-left-right text-warning"></i>Deposit Range</span>
                            <span class="spec-value it-title">
                                {{ $planSelected ? $settings->currency . number_format($planSelected->min_price) . ' – ' . $settings->currency . number_format($planSelected->max_price) : '-' }}
                            </span>
                        </div>
                        <div class="metric-row">
                            <span class="spec-label"><i class="fa-solid fa-arrow-trend-up text-primary"></i>Total Return Range</span>
                            <span class="spec-value text-primary">
                                {{ $planSelected ? $planSelected->minr . '% – ' . $planSelected->maxr . '%' : '-' }}
                            </span>
                        </div>
                        @if ($planSelected && $planSelected->gift > 0)
                            <div class="metric-row">
                                <span class="spec-label"><i class="fa-solid fa-gift text-warning"></i>Instant Bonus Gift</span>
                                <span class="spec-value text-warning">+{{ $settings->currency }}{{ number_format($planSelected->gift, 2) }}</span>
                            </div>
                        @endif
                        <div class="metric-row">
                            <span class="spec-label"><i class="fa-solid fa-credit-card it-muted"></i>Payment Channel</span>
                            <span class="spec-value it-title">
                                @if ($paymentMethod == 'Connected Wallet')
                                    <span class="text-success"><i class="fa-solid fa-link me-1"></i>Connected Web3 Wallet</span>
                                @else
                                    <span><i class="fa-solid fa-wallet me-1 text-primary"></i>Main Account Balance</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Dynamic Return Projection Card -->
                    @php
                        $investAmt = floatval($amountToInvest);
                        $estPeriodic = 0;
                        if ($planSelected && $investAmt > 0) {
                            if ($planSelected->increment_type == 'Percentage') {
                                $estPeriodic = ($investAmt * floatval($planSelected->increment_amount)) / 100;
                            } else {
                                $estPeriodic = floatval($planSelected->increment_amount);
                            }
                        }
                    @endphp
                    <div class="projection-box mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="it-muted f-11 text-uppercase f-w-700">Projected Earnings</span>
                            <span class="badge bg-success text-white f-10 rounded-pill px-2 py-0.5">Live Estimate</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="it-muted f-12">Committed Capital:</span>
                            <span class="it-title f-14 f-w-700">{{ $settings->currency }}{{ number_format($investAmt, 2) }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="it-muted f-12">Estimated Yield per Drop:</span>
                            <span class="text-success f-13 f-w-700">
                                +{{ $settings->currency }}{{ number_format($estPeriodic, 2) }}
                                <small class="it-muted f-10 font-normal">({{ $planSelected ? $planSelected->increment_interval : '' }})</small>
                            </span>
                        </div>
                        @if ($planSelected && $investAmt > 0)
                            <div class="d-flex align-items-center justify-content-between pt-2 mt-2 border-top border-success-subtle">
                                <span class="it-muted f-12">Estimated Total Return:</span>
                                <span class="it-title f-13 f-w-700">
                                    {{ $settings->currency }}{{ number_format($investAmt * (1 + ($planSelected->minr / 100)), 2) }} &ndash; {{ $settings->currency }}{{ number_format($investAmt * (1 + ($planSelected->maxr / 100)), 2) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Security / Trust Strip -->
                    <div class="d-flex align-items-center gap-2 mb-3 px-2 it-muted f-11">
                        <i class="fa-solid fa-lock text-success"></i>
                        <span>Protected Smart Contract &bull; Automated Settlement</span>
                    </div>

                    @php
                        $isAllocationInvalid = ($planSelected && ($amt > $bal || $amt < $min || $amt > $max));
                    @endphp
                    <!-- Action CTA Button -->
                    <form wire:submit.prevent="joinPlan">
                        <button type="submit" class="btn btn-invest-action w-100 py-3 shadow"
                                {{ ($disabled || $isAllocationInvalid) ? 'disabled' : '' }} wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="joinPlan" class="d-inline-flex align-items-center justify-content-center gap-2 text-white">
                                <i class="fa-solid fa-shield-halved text-white"></i>
                                <span class="text-white">Confirm & Activate Investment</span>
                            </span>
                            <span wire:loading wire:target="joinPlan" class="d-inline-flex align-items-center justify-content-center gap-2 text-white">
                                <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                                <span class="text-white">Processing Investment...</span>
                            </span>
                        </button>
                    </form>

                    <!-- Feedback message under button -->
                    <div wire:loading wire:target="joinPlan" class="text-center text-primary mt-2 f-12">
                        <i class="fa-solid fa-spinner fa-spin me-1"></i>{{ $feedback ? $feedback : 'Please wait, activating contract...' }}
                    </div>

                </div>
            </div>
        </div>

    @else
        <!-- Empty State (No Plans Configured) -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="terminal-card p-5 text-center">
                    <div class="metric-icon-circle neutral mx-auto mb-3" style="width: 64px; height: 64px; font-size: 28px;">
                        <i class="fa-solid fa-layer-group it-muted"></i>
                    </div>
                    <h5 class="it-title f-w-700 mb-2">No Investment Packages Available</h5>
                    <p class="it-muted f-13 mb-4">There are currently no active investment packages available in this category. Please check back shortly or contact our 24/7 dedicated support desk.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back to Dashboard
                        </a>
                        <a href="{{ route('support') }}" class="btn btn-primary btn-sm px-3">
                            <i class="fa-solid fa-headset me-1"></i>Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
