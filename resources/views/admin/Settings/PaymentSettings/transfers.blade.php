<div class="row g-4 justify-content-center">
    <div class="col-lg-8">
        <form action="javascript:void(0)" method="POST" id="trasfer">
            @csrf
            @method('PUT')

            <div class="p-3 bg-light bg-opacity-50 border rounded-3 mb-4">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="fa fa-exchange-alt text-primary f-20"></i>
                    <h5 class="f-w-700 mb-0">Peer-to-Peer & Internal User Balance Transfers</h5>
                </div>
                <p class="text-muted f-13 mb-0">Allow investors to send account balance funds directly to other registered platform members using their email address.</p>
            </div>

            <div class="row g-4">
                <!-- Feature Activation Switch -->
                <div class="col-12">
                    <label class="form-label f-w-600 f-13 d-block mb-2">Enable Internal Transfers</label>
                    <div class="selectgroup">
                        <label class="selectgroup-item">
                            <input type="radio" name="usertransfer" value="1" class="selectgroup-input" {{ $moresettings->use_transfer ? 'checked' : '' }}>
                            <span class="selectgroup-button"><i class="fa fa-check me-1"></i> Enabled</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="usertransfer" value="0" class="selectgroup-input" {{ $moresettings->use_transfer ? '' : 'checked' }}>
                            <span class="selectgroup-button"><i class="fa fa-times me-1"></i> Disabled</span>
                        </label>
                    </div>
                    <small class="text-muted d-block mt-1 f-11">Turn on to enable client-to-client transfer requests from the user dashboard.</small>
                </div>

                <!-- Minimum Transfer Amount -->
                <div class="col-md-6">
                    <label class="form-label f-w-600 f-13">Minimum Transfer Amount</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light f-w-600">{{ $settings->currency }}</span>
                        <input type="number" step="any" min="1" name="min_transfer" class="form-control form-control-lg f-w-700" value="{{ $moresettings->min_transfer }}" required>
                    </div>
                    <small class="text-muted f-11">Lowest transfer amount permitted per transaction.</small>
                </div>

                <!-- Transfer Fee / Charges -->
                <div class="col-md-6">
                    <label class="form-label f-w-600 f-13">Transfer Transaction Fee</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light f-w-600">Fee</span>
                        <input type="number" step="any" min="0" max="100" name="charges" class="form-control form-control-lg f-w-700" value="{{ $moresettings->transfer_charges }}" required>
                        <span class="input-group-text bg-light f-w-700">%</span>
                    </div>
                    <small class="text-muted f-11">Deducted from sender balance. Enter 0 for free internal transfers.</small>
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-4 pt-2 border-top text-end">
                    <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill f-w-600">
                        <i class="fa fa-save me-1"></i> Save Transfer Settings
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
