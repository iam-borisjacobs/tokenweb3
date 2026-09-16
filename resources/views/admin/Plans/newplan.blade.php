@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="f-w-700 mb-1">Add Investment Plan</h3>
                <p class="text-muted mb-0 f-14">Define pricing, expected returns, duration, and top-up rules for a new plan.</p>
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
                <form role="form" method="post" action="{{ route('addplan') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-w-600">Plan Name <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. Standard Silver Plan or Mack Truck Hauler" type="text" name="name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Investment Category <span class="text-danger">*</span></label>
                            <select class="form-select" name="category" required>
                                <option value="crypto" selected>🪙 Crypto / Financial Trading Package</option>
                                <option value="truck">🚛 Trucking / Logistics & Physical Asset</option>
                            </select>
                            <small class="text-muted f-11">Categorizes the package for user browsing and specialized card displays.</small>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label f-w-600 d-flex justify-content-between align-items-center mb-1">
                                <span>Plan Picture / Graphic</span>
                                <span class="badge bg-light text-muted border f-11">Recommended for Trucks / Real Assets</span>
                            </label>
                            <input class="form-control" type="file" name="image" accept="image/*">
                            <small class="text-muted f-11">Upload a photo of the truck, asset, or vehicle (JPG, PNG, WebP up to 10MB). Displayed prominently in the Contract Overview and package cards.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Default Plan Price ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. 500" type="number" name="price" required>
                            <small class="text-muted f-11">Default investment price without commas.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Minimum Investment Amount ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. 100" type="number" step="any" name="min_price" required>
                            <small class="text-muted f-11">Minimum deposit allowed for this package.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Maximum Investment Amount ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. 5000" type="number" step="any" name="max_price" required>
                            <small class="text-muted f-11">Maximum deposit limit for this package.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Minimum Return (%) <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. 5" type="number" step="any" name="minr" required>
                            <small class="text-muted f-11">Minimum expected ROI percentage.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Maximum Return (%) <span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="e.g. 15" type="number" step="any" name="maxr" required>
                            <small class="text-muted f-11">Maximum expected ROI percentage.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Gift Bonus ({{ $settings->currency }})</label>
                            <input class="form-control" placeholder="e.g. 25" type="number" step="any" name="gift" value="0">
                            <small class="text-muted f-11">Bonus awarded when client purchases this plan.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Top-up Interval</label>
                            <select class="form-select" name="t_interval">
                                <option value="Monthly">Monthly</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Daily" selected>Daily</option>
                                <option value="Hourly">Hourly</option>
                                <option value="Every 30 Minutes">Every 30 Minutes</option>
                                <option value="Every 10 Minutes">Every 10 Minutes</option>
                            </select>
                            <small class="text-muted f-11">Frequency for automated ROI distribution.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Top-up Type</label>
                            <select class="form-select" name="t_type">
                                <option value="Percentage" selected>Percentage (%)</option>
                                <option value="Fixed">Fixed Amount ({{ $settings->currency }})</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Top-up Amount</label>
                            <input class="form-control" placeholder="e.g. 2.5" type="number" step="any" name="t_amount" required>
                            <small class="text-muted f-11">ROI amount added every interval period.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600">Plan Duration (e.g. Days, Weeks, Months)</label>
                            <input class="form-control" placeholder="e.g. 14 Days, 1 Month" type="text" name="expiration" required>
                            <small class="text-muted f-11">Total running duration of the investment.</small>
                        </div>

                        <div class="col-12 mt-4 pt-3 border-top text-end">
                            <a href="{{ route('plans') }}" class="btn btn-outline-secondary me-2 px-4 py-2 rounded-2">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-2 shadow-sm">
                                <i class="fa fa-save me-1"></i> Save Investment Plan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
