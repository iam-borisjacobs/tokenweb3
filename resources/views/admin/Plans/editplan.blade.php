@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="f-w-700 mb-1">Update Investment Plan</h3>
                <p class="text-muted mb-0 f-14">Modify parameters, ROI percentages, or duration for package <strong>{{ $plan->name }}</strong>.</p>
            </div>
            <div>
                <a href="{{ route('plans') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Plans
                </a>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <div class="row">
        <div class="col-lg-12">
            <div class="card p-4 shadow-sm border-0">
                <form role="form" method="post" action="{{ route('updateplan') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $plan->id }}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-w-600">Plan Name <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $plan->name }}" placeholder="Enter Plan name" type="text" name="name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Investment Category <span class="text-danger">*</span></label>
                            <select class="form-select" name="category" required>
                                <option value="crypto" {{ ($plan->category ?? 'crypto') == 'crypto' ? 'selected' : '' }}>🪙 Crypto / Financial Trading Package</option>
                                <option value="truck" {{ ($plan->category ?? '') == 'truck' ? 'selected' : '' }}>🚛 Trucking / Logistics & Physical Asset</option>
                            </select>
                            <small class="text-muted f-11">Categorizes the package for user browsing and specialized card displays.</small>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label f-w-600 d-flex justify-content-between align-items-center mb-1">
                                <span>Plan Picture / Graphic</span>
                                <span class="badge bg-light text-muted border f-11">Recommended for Trucks / Real Assets</span>
                            </label>
                            <input class="form-control" type="file" name="image" accept="image/*">
                            <small class="text-muted f-11">Upload a photo of the truck, asset, or vehicle (JPG, PNG, WebP up to 10MB).</small>

                            @if(!empty($plan->image))
                                <div class="d-flex align-items-center justify-content-between mt-2 p-2 border rounded" style="background-color: #f8fafc;">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $plan->image_url }}" alt="{{ $plan->name }}" style="height: 52px; width: 78px; object-fit: cover; border-radius: 6px;" class="border shadow-sm">
                                        <div>
                                            <span class="f-12 f-w-600 text-dark d-block">Current Plan Photo</span>
                                            <small class="text-muted f-11">Uploading a new file will automatically replace this image.</small>
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="removePlanImg">
                                        <label class="form-check-label f-12 text-danger cursor-pointer f-w-600" for="removePlanImg">Remove Photo</label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Default Plan Price ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $plan->price }}" placeholder="Enter Plan price" type="number" name="price" required>
                            <small class="text-muted f-11">Default investment price without commas.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Minimum Investment Amount ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $plan->min_price }}" placeholder="Enter Plan minimum price" type="number" step="any" name="min_price" required>
                            <small class="text-muted f-11">Minimum deposit allowed for this package.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Maximum Investment Amount ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $plan->max_price }}" placeholder="Enter Plan maximum price" type="number" step="any" name="max_price" required>
                            <small class="text-muted f-11">Maximum deposit limit for this package.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Minimum Return (%) <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $plan->minr }}" placeholder="Enter minimum return" type="number" step="any" name="minr" required>
                            <small class="text-muted f-11">Minimum expected ROI percentage.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Maximum Return (%) <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{ $plan->maxr }}" placeholder="Enter maximum return" type="number" step="any" name="maxr" required>
                            <small class="text-muted f-11">Maximum expected ROI percentage.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Gift Bonus ({{ $settings->currency }})</label>
                            <input class="form-control" value="{{ $plan->gift }}" placeholder="Enter Additional Gift Bonus" type="number" step="any" name="gift" required>
                            <small class="text-muted f-11">Bonus awarded when client purchases this plan.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Top-up Interval</label>
                            <select class="form-select" name="t_interval">
                                <option value="{{ $plan->increment_interval }}" selected>{{ $plan->increment_interval }} (Current)</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Daily">Daily</option>
                                <option value="Hourly">Hourly</option>
                                <option value="Every 30 Minutes">Every 30 Minutes</option>
                                <option value="Every 10 Minutes">Every 10 Minutes</option>
                            </select>
                            <small class="text-muted f-11">Frequency for automated ROI distribution.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Top-up Type</label>
                            <select class="form-select" name="t_type">
                                <option value="{{ $plan->increment_type }}" selected>{{ $plan->increment_type }} (Current)</option>
                                <option value="Percentage">Percentage (%)</option>
                                <option value="Fixed">Fixed Amount ({{ $settings->currency }})</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Top-up Amount</label>
                            <input class="form-control" value="{{ $plan->increment_amount }}" placeholder="Top-up amount" type="number" step="any" name="t_amount" required>
                            <small class="text-muted f-11">ROI amount added every interval period.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 d-flex justify-content-between align-items-center">
                                <span>Investment Duration <span class="text-danger">*</span></span>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#durationModal" class="f-11 text-primary">
                                    <i class="fa fa-info-circle"></i> Format Guide
                                </a>
                            </label>
                            <input class="form-control" value="{{ $plan->expiration }}" placeholder="e.g. 14 Days, 1 Months" type="text" name="expiration" required>
                            <small class="text-muted f-11">Total running duration (e.g., 7 Days, 2 Weeks, 1 Months).</small>
                        </div>

                        <div class="col-12 mt-4 pt-3 border-top text-end">
                            <a href="{{ route('plans') }}" class="btn btn-outline-secondary me-2 px-4 py-2 rounded-2">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-2 shadow-sm">
                                <i class="fa fa-save me-1"></i> Update Plan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Duration Format Modal -->
<div id="durationModal" class="modal fade" tabindex="-1" aria-labelledby="durationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title f-w-700" id="durationModalLabel"><i class="fa fa-clock text-primary me-2"></i> Duration Format Guide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-2"><strong>1. Digits First:</strong> Always precede the timeframe with a digit (e.g. <code>1</code>, <code>7</code>, <code>30</code>), never words.</p>
                <p class="mb-2"><strong>2. Include a Space:</strong> Add a space after the number (e.g. <code>14 Days</code>, not <code>14Days</code>).</p>
                <p class="mb-3"><strong>3. Capitalized Plural:</strong> Always capitalize the first letter and keep it plural: <code>Days</code>, <code>Weeks</code>, <code>Months</code>, <code>Years</code>.</p>
                <div class="p-3 bg-light rounded text-center">
                    <span class="text-muted f-12 d-block mb-1">Valid Examples:</span>
                    <strong class="text-primary f-16">1 Days &bull; 7 Days &bull; 2 Weeks &bull; 1 Months &bull; 1 Years</strong>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-primary btn-sm px-4 rounded-pill" data-bs-dismiss="modal">Understood</button>
            </div>
        </div>
    </div>
</div>
@endsection
