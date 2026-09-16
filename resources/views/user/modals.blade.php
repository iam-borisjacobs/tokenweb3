<!-- Submit MT4/Trading Account Modal -->
<div id="submitmt4modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">
                    <i class="fa-solid fa-chart-line text-primary me-2"></i> Subscribe to Account Management
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" method="post" action="{{ route('savemt4details') }}" id="mt4SubscriptionForm">
                @csrf
                <div class="modal-body">
                    <div class="p-3 bg-light rounded-3 mb-4 text-muted f-12">
                        <i class="fa-solid fa-shield-halved text-primary me-1"></i>
                        Connect your MT4/MT5 account for automated execution. Subscription fees are deducted directly from your available balance.
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Subscription Duration <span class="text-danger">*</span></label>
                            <select class="form-select" onchange="calcAmount(this)" name="duration" id="duratn" required>
                                <option value="" selected disabled>-- Choose Duration --</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Quaterly">Quarterly</option>
                                <option value="Yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Subscription Fee</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 fw-bold">{{ $settings->currency }}</span>
                                <input class="form-control border-start-0 f-w-700 text-primary" type="text" id="amount" placeholder="0.00" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">MT4/MT5 Account Login ID <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="userid" placeholder="e.g. 8839201" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Account Master Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="pswrd" placeholder="Enter account password" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Account Display Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" placeholder="e.g. Primary Trading Acc" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Account Type <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="acntype" placeholder="e.g. Standard, ECN, Cent" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-13">Base Currency <span class="text-danger">*</span></label>
                            <input class="form-control text-uppercase" type="text" name="currency" placeholder="USD, EUR, GBP" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-13">Leverage <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="leverage" placeholder="e.g. 1:500" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-13">Broker Server <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="server" placeholder="e.g. IC-Markets-Live02" required>
                        </div>
                    </div>

                    <input id="amountpay" type="hidden" name="amount">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm" id="btnSubmitSub">
                        <i class="fa-solid fa-check me-1"></i> Confirm & Subscribe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function calcAmount(sub) {
        var amountEl = document.getElementById('amount');
        var amountpayEl = document.getElementById('amountpay');
        if (!amountEl || !amountpayEl) return;

        if (sub.value === "Quaterly" || sub.value === "Quarterly") {
            amountEl.value = '{{ $settings->quarterlyfee }}';
            amountpayEl.value = '{{ $settings->quarterlyfee }}';
        } else if (sub.value === "Yearly") {
            amountEl.value = '{{ $settings->yearlyfee }}';
            amountpayEl.value = '{{ $settings->yearlyfee }}';
        } else if (sub.value === "Monthly") {
            amountEl.value = '{{ $settings->monthlyfee }}';
            amountpayEl.value = '{{ $settings->monthlyfee }}';
        }
    }
</script>
