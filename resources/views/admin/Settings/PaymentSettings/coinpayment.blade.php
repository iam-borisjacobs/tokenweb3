<div class="row g-4 justify-content-center">
    <div class="col-lg-8">
        <form action="javascript:void(0)" method="POST" id="coinpayform">
            @csrf
            @method('PUT')

            <div class="p-3 bg-light bg-opacity-50 border rounded-3 mb-4">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="fa fa-coins text-warning f-20"></i>
                    <h5 class="f-w-700 mb-0">CoinPayments API Configuration</h5>
                </div>
                <p class="text-muted f-13 mb-0">Connect your CoinPayments.net merchant account for automated cryptocurrency deposits, instant IPN confirmations, and automated client withdrawals.</p>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label f-w-600 f-13">CoinPayments Merchant ID <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fa fa-id-card text-muted"></i></span>
                        <input class="form-control" placeholder="Enter CoinPayments Merchant ID" type="text" name="cp_m_id" value="{{ $cpd->cp_m_id }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label f-w-600 f-13">IPN Secret Key <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fa fa-key text-muted"></i></span>
                        <input class="form-control" placeholder="Enter IPN Secret string" type="password" name="cp_ipn_secret" value="{{ $cpd->cp_ipn_secret }}" required>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label f-w-600 f-13">Debug / Notification Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fa fa-envelope text-muted"></i></span>
                        <input class="form-control" placeholder="admin@example.com" type="email" name="cp_debug_email" value="{{ $cpd->cp_debug_email }}" required>
                    </div>
                    <small class="text-muted f-11">CoinPayments will dispatch diagnostic error reports and IPN traces to this address.</small>
                </div>

                <div class="col-12">
                    <label class="form-label f-w-600 f-13">API Public Key <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fa fa-lock-open text-muted"></i></span>
                        <input class="form-control" placeholder="Paste your API Public Key" type="text" name="cp_p_key" value="{{ $cpd->cp_p_key }}" required>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label f-w-600 f-13">API Private Key <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fa fa-lock text-muted"></i></span>
                        <input class="form-control" placeholder="Paste your API Private Key" type="password" name="cp_pv_key" value="{{ $cpd->cp_pv_key }}" required>
                    </div>
                </div>

                <div class="col-12 mt-4 pt-2 border-top text-end">
                    <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill f-w-600">
                        <i class="fa fa-save me-1"></i> Save CoinPayments Credentials
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
