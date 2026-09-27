<div class="col-sm-6 col-lg-4 col-xxl-3">
    <div class="card border-0 shadow-sm overflow-hidden h-100 plan-admin-card position-relative d-flex flex-column">
        <!-- Top accent line -->
        <div style="height: 4px; background: {{ $plan->isTruck() ? 'linear-gradient(90deg, #ff9f43, #f39c12)' : 'linear-gradient(90deg, #6362e7, #a855f7)' }};"></div>
        
        <!-- Header Banner / Image Thumbnail -->
        <div class="position-relative overflow-hidden plan-card-media" style="width: 100%; aspect-ratio: 16 / 9; min-height: 170px; background-color: #0b1120;">
            <img src="{{ $plan->image_url }}" 
                 alt="{{ $plan->name }}" 
                 class="w-100 h-100 plan-card-img" 
                 style="object-fit: cover; object-position: center; display: block;"
                 onerror="this.onerror=null; this.src='{{ asset('themes/ecx/assets/images/plans/' . ($plan->isTruck() ? 'truck_logistics_fleet.jpg' : 'plan_gold_ecx.jpg')) }}';">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(180deg, rgba(0,0,0,0.15) 0%, rgba(0,0,0,0) 40%, rgba(0,0,0,0.5) 100%); pointer-events: none;"></div>
            
            <!-- Category Badge on Photo -->
            <span class="position-absolute top-0 start-0 m-2 badge {{ $plan->isTruck() ? 'bg-warning text-dark' : 'bg-primary text-white' }} f-11 rounded-pill px-2.5 py-1 shadow-sm">
                <i class="fa {{ $plan->isTruck() ? 'fa-truck' : 'fa-coins' }} me-1"></i>{{ $plan->category_label }}
            </span>
            
            <!-- Duration Badge on Photo -->
            <span class="position-absolute bottom-0 end-0 m-2 badge bg-dark bg-opacity-75 text-white border border-secondary border-opacity-50 f-11 rounded-pill px-2.5 py-1" style="backdrop-filter: blur(4px);">
                <i class="fa fa-clock me-1 text-warning"></i>{{ $plan->expiration }}
            </span>
        </div>

        <div class="card-body p-3 d-flex flex-column justify-content-between flex-grow-1">
            <div>
                <!-- Title & Plan ID -->
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="f-w-700 text-dark mb-0 text-truncate" title="{{ $plan->name }}" style="max-width: 80%;">
                        {{ $plan->name }}
                    </h5>
                    <span class="badge bg-light-primary text-primary px-2 py-1 rounded-pill f-10 f-w-700">#{{ $plan->id }}</span>
                </div>

                <!-- Price Highlight Strip (Snug & Fitted) -->
                <div class="plan-price-strip d-flex justify-content-between align-items-center mb-3">
                    <span class="f-11 text-muted text-uppercase f-w-700">Default Price</span>
                    <h4 class="f-w-800 text-primary mb-0">{{ $settings->currency }}{{ number_format($plan->price) }}</h4>
                </div>

                <!-- 2x2 Metric Grid (Snug & Zero Dead Space) -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="plan-metric-box">
                            <span class="metric-label"><i class="fa fa-arrow-circle-down text-success me-1"></i> Min Deposit</span>
                            <span class="metric-val">{{ $settings->currency }}{{ number_format($plan->min_price) }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="plan-metric-box">
                            <span class="metric-label"><i class="fa fa-arrow-circle-up text-primary me-1"></i> Max Deposit</span>
                            <span class="metric-val">{{ $settings->currency }}{{ number_format($plan->max_price) }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="plan-metric-box">
                            <span class="metric-label"><i class="fa fa-chart-line text-info me-1"></i> Return (ROI)</span>
                            <span class="metric-val text-success">{{ number_format($plan->minr) }}% - {{ number_format($plan->maxr) }}%</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="plan-metric-box">
                            <span class="metric-label"><i class="fa fa-clock text-warning me-1"></i> Payout</span>
                            <span class="metric-val text-truncate" title="{{ $plan->increment_interval ?? 'Daily' }}">
                                {{ $plan->increment_interval ?? 'Daily' }} 
                                <small class="text-muted">({{ $plan->increment_amount ?? 0 }}{{ ($plan->increment_type ?? 'Percentage') == 'Percentage' ? '%' : '' }})</small>
                            </span>
                        </div>
                    </div>
                </div>

                @if(!empty($plan->gift) && $plan->gift > 0)
                    <div class="d-flex justify-content-between align-items-center py-1 px-2 mb-2 rounded bg-light border f-11">
                        <span class="text-muted"><i class="fa fa-gift text-warning me-1"></i> Gift Bonus:</span>
                        <span class="f-w-700 text-dark">{{ $settings->currency }}{{ number_format($plan->gift) }}</span>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="pt-2 border-top d-flex gap-2 mt-auto">
                <a href="{{ route('editplan', $plan->id) }}" class="btn btn-outline-primary btn-sm flex-fill py-2 rounded-2 f-12 f-w-600">
                    <i class="fa fa-edit me-1"></i> Edit Plan
                </a>
                <a href="{{ url('admin/dashboard/trashplan') }}/{{ $plan->id }}" class="btn btn-outline-danger btn-sm px-3 py-2 rounded-2 f-12" onclick="return confirm('Are you sure you want to delete the plan {{ $plan->name }}?');" title="Delete Plan">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
        </div>
    </div>
</div>
