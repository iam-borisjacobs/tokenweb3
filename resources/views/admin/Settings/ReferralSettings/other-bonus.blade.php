<div>
    <form method="post" action="javascript:void(0)" id="bonusform">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="1">

        <div class="row g-4">
            <!-- Registration / Signup Bonus -->
            <div class="col-md-6">
                <div class="card h-100 p-3 border rounded-3 bg-light bg-opacity-25">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="fa fa-gift f-16"></i>
                        </div>
                        <div>
                            <h6 class="f-w-700 mb-0">Registration / Welcome Bonus</h6>
                            <small class="text-muted">Instant credit for new members</small>
                        </div>
                    </div>

                    <p class="text-muted f-13 mb-3">Amount automatically credited to new users upon registering an account on your platform.</p>

                    <div class="input-group mb-2">
                        <span class="input-group-text bg-white f-w-600">{{ $settings->currency }}</span>
                        <input type="number" step="any" min="0" class="form-control form-control-lg f-w-700" name="signup_bonus" value="{{ $settings->signup_bonus }}" required>
                    </div>
                    <small class="text-muted f-11">Set to 0 to disable automatic signup bonuses.</small>
                </div>
            </div>

            <!-- Deposit Bonus -->
            <div class="col-md-6">
                <div class="card h-100 p-3 border rounded-3 bg-light bg-opacity-25">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="fa fa-percent f-16"></i>
                        </div>
                        <div>
                            <h6 class="f-w-700 mb-0">Deposit Bonus Rate</h6>
                            <small class="text-muted">Percentage added on each deposit</small>
                        </div>
                    </div>

                    <p class="text-muted f-13 mb-3">Calculates the percentage specified on every completed user deposit and credits it as an additional bonus balance.</p>

                    <div class="input-group mb-2">
                        <span class="input-group-text bg-white f-w-600">Rate</span>
                        <input type="number" step="any" min="0" max="100" class="form-control form-control-lg f-w-700" name="deposit_bonus" value="{{ $settings->deposit_bonus }}" required>
                        <span class="input-group-text bg-white f-w-700">%</span>
                    </div>
                    <small class="text-muted f-11">Example: 5% bonus on a $1,000 deposit yields an extra $50 bonus.</small>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-4 pt-2 border-top">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill f-w-600">
                    <i class="fa fa-save me-1"></i> Save Bonus Settings
                </button>
            </div>
        </div>
    </form>
</div>
