<div>
    <form method="post" action="javascript:void(0)" id="refform">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="1">

        <div class="row g-4">
            <!-- Direct Referral Highlight Card -->
            <div class="col-12">
                <div class="p-3 bg-light bg-opacity-50 border border-primary border-opacity-25 rounded-3 mb-2">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <h5 class="f-w-700 mb-1 text-primary">
                                <i class="fa fa-user-plus me-1"></i> Direct Referral Commission (Level 1)
                            </h5>
                            <p class="text-muted f-13 mb-0">Percentage commission paid to the direct sponsor whenever their directly invited user funds or deposits.</p>
                        </div>
                        <div class="col-md-5 mt-2 mt-md-0">
                            <div class="input-group">
                                <span class="input-group-text bg-white f-w-600">Rate</span>
                                <input type="number" step="any" min="0" max="100" class="form-control form-control-lg f-w-700 text-primary" name="ref_commission" value="{{ $settings->referral_commission }}" required>
                                <span class="input-group-text bg-light f-w-700">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Multi-level Indirect Commissions -->
            <div class="col-12">
                <h6 class="f-w-700 mb-2 text-muted text-uppercase f-12">Multi-Level Indirect Referral Tree</h6>
                <p class="text-muted f-13 mb-3">Optional downstream commissions awarded to higher-tier uplines across generational levels 2 through 6.</p>

                <div class="row g-3">
                    <div class="col-md-6 col-lg-4">
                        <label class="form-label f-w-600 f-13">Indirect Level 2</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light f-12">Lvl 2</span>
                            <input type="number" step="any" min="0" max="100" class="form-control" name="ref_commission1" value="{{ $settings->referral_commission1 }}" required>
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <label class="form-label f-w-600 f-13">Indirect Level 3</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light f-12">Lvl 3</span>
                            <input type="number" step="any" min="0" max="100" class="form-control" name="ref_commission2" value="{{ $settings->referral_commission2 }}" required>
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <label class="form-label f-w-600 f-13">Indirect Level 4</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light f-12">Lvl 4</span>
                            <input type="number" step="any" min="0" max="100" class="form-control" name="ref_commission3" value="{{ $settings->referral_commission3 }}" required>
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <label class="form-label f-w-600 f-13">Indirect Level 5</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light f-12">Lvl 5</span>
                            <input type="number" step="any" min="0" max="100" class="form-control" name="ref_commission4" value="{{ $settings->referral_commission4 }}" required>
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <label class="form-label f-w-600 f-13">Indirect Level 6</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light f-12">Lvl 6</span>
                            <input type="number" step="any" min="0" max="100" class="form-control" name="ref_commission5" value="{{ $settings->referral_commission5 }}" required>
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-4 pt-2 border-top">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill f-w-600">
                    <i class="fa fa-save me-1"></i> Save Referral Commissions
                </button>
            </div>
        </div>
    </form>
</div>
