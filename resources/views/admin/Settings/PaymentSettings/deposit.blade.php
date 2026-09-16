<div class="row g-4">
    <div class="col-12">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 pb-3 border-bottom">
            <div>
                <h5 class="f-w-700 mb-1">Configured Payment Methods</h5>
                <p class="text-muted f-13 mb-0">Active fiat currencies, bank transfer accounts, and cryptocurrency wallets available for deposits & withdrawals.</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-14 f-w-600 shadow-sm" data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
                    <i class="fa fa-plus-circle me-1"></i> Add Payment Method
                </button>
            </div>
        </div>
    </div>

    <!-- Table of Methods -->
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="f-13 f-w-700">Method Name</th>
                        <th scope="col" class="f-13 f-w-700">Type</th>
                        <th scope="col" class="f-13 f-w-700">Used For</th>
                        <th scope="col" class="f-13 f-w-700">Status</th>
                        <th scope="col" class="f-13 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($methods as $method)
                        <tr>
                            <td class="f-w-600">
                                <div class="d-flex align-items-center gap-2">
                                    @if ($method->img_url)
                                        <img src="{{ $method->img_url }}" alt="{{ $method->name }}" class="rounded-circle border" style="width: 28px; height: 28px; object-fit: contain;">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center border" style="width: 28px; height: 28px;">
                                            <i class="fa fa-credit-card f-12 text-muted"></i>
                                        </div>
                                    @endif
                                    <span>{{ $method->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $method->methodtype == 'crypto' ? 'bg-light-warning text-warning' : 'bg-light-info text-info' }} rounded-pill px-3 py-1 f-12 text-capitalize">
                                    {{ $method->methodtype }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark rounded-pill px-3 py-1 f-12 text-capitalize border">
                                    {{ $method->type }}
                                </span>
                            </td>
                            <td>
                                @if ($method->status == 'enabled')
                                    <span class="badge bg-light-success text-success rounded-pill px-3 py-1 f-12">
                                        <i class="fa fa-check-circle me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-light-danger text-danger rounded-pill px-3 py-1 f-12">
                                        <i class="fa fa-times-circle me-1"></i> Disabled
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('editpaymethod', $method->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3" title="Edit Method">
                                        <i class="fa fa-edit me-1"></i> Edit
                                    </a>

                                    @php
                                        $defaultMethods = ['Bitcoin', 'Ethereum', 'Litecoin', 'Paypal', 'Bank Transfer', 'Credit Card', 'USDT', 'BUSD'];
                                    @endphp

                                    @if (in_array($method->name, $defaultMethods))
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3 opacity-50" disabled title="Default system method cannot be deleted">
                                            <i class="fa fa-lock me-1"></i> Locked
                                        </button>
                                    @else
                                        <a href="{{ route('deletepaymethod', $method->id) }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 delete-method-btn" onclick="return confirm('Are you sure you want to delete this payment method?');" title="Delete Method">
                                            <i class="fa fa-trash-alt me-1"></i> Delete
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fa fa-info-circle f-18 mb-2 d-block"></i>
                                No payment methods configured yet. Click "Add Payment Method" above to add your first method.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Add New Payment Method -->
<div class="modal fade" id="addPaymentMethodModal" tabindex="-1" aria-labelledby="addPaymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title f-w-700" id="addPaymentMethodModalLabel">
                    <i class="fa fa-plus-circle text-primary me-1"></i> Add New Payment Method
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('addpaymethod') }}" enctype="multipart/form-data" id="addPayMethodForm">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Method Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="e.g. Bank Deposit, Solana, USDT TRC20" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Minimum Amount <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" name="minimum" id="minamount" placeholder="0" required>
                            <small class="text-muted f-11">Applies to withdrawal limits</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Maximum Amount <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" name="maximum" id="maxamount" placeholder="1000000" required>
                            <small class="text-muted f-11">Applies to withdrawal limits</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Fee / Charges <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" name="charges" id="charges" value="0" required>
                            <small class="text-muted f-11">Applies to withdrawal fees</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Charges Calculation Type</label>
                            <select name="chargetype" class="form-select">
                                <option value="percentage">Percentage (%)</option>
                                <option value="fixed">Fixed ({{ $settings->currency }})</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Category / Architecture <span class="text-danger">*</span></label>
                            <select name="methodtype" id="new_methodtype" class="form-select" required>
                                <option value="currency">Fiat Currency / Bank Transfer</option>
                                <option value="crypto">Cryptocurrency Wallet</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Logo / Icon URL (Optional)</label>
                            <input type="text" class="form-control" name="url" id="url" placeholder="https://example.com/logo.png">
                        </div>

                        {{-- Fiat / Bank Transfer Fields --}}
                        <div class="col-md-6 currency-field">
                            <label class="form-label f-w-600 f-13">Bank Name</label>
                            <input type="text" class="form-control currinput" name="bank" id="bank" placeholder="e.g. JPMorgan Chase">
                        </div>
                        <div class="col-md-6 currency-field">
                            <label class="form-label f-w-600 f-13">Account Holder Name</label>
                            <input type="text" class="form-control currinput" name="account_name" id="acnt_name" placeholder="Company or Agent Name">
                        </div>
                        <div class="col-md-6 currency-field">
                            <label class="form-label f-w-600 f-13">Account / IBAN Number</label>
                            <input type="text" class="form-control currinput" name="account_number" id="acnt_number" placeholder="Account or IBAN number">
                        </div>
                        <div class="col-md-6 currency-field">
                            <label class="form-label f-w-600 f-13">SWIFT / Routing Code</label>
                            <input type="text" class="form-control currinput" name="swift" id="swift" placeholder="SWIFT/BIC code">
                        </div>

                        {{-- Cryptocurrency Fields --}}
                        <div class="col-md-12 d-none crypto-field">
                            <label class="form-label f-w-600 f-13">Wallet Address</label>
                            <input type="text" class="form-control cryptoinput" name="walletaddress" id="walletaddress" placeholder="e.g. 0x... or bc1q...">
                        </div>
                        <div class="col-md-6 d-none crypto-field">
                            <label class="form-label f-w-600 f-13">Network / Blockchain Type</label>
                            <input type="text" placeholder="e.g. ERC20, TRC20, BEP20, Solana" class="form-control cryptoinput" name="wallettype" id="wallettype">
                        </div>
                        <div class="col-md-6 d-none crypto-field">
                            <label class="form-label f-w-600 f-13">QR Code Image (Optional)</label>
                            <input type="file" name="barcode" class="form-control cryptoinput">
                            <small class="text-muted f-11">Recommended: Square PNG/JPG (approx 500x500px)</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Availability Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="enabled">Enabled (Active)</option>
                                <option value="disabled">Disabled</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Operation Support <span class="text-danger">*</span></label>
                            <select name="typefor" class="form-select" required>
                                <option value="both">Both (Deposit & Withdrawal)</option>
                                <option value="deposit">Deposit Only</option>
                                <option value="withdrawal">Withdrawal Only</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Instruction / Payment Note (Optional)</label>
                            <input type="text" class="form-control" name="note" placeholder="e.g. Confirmations may take 10-30 minutes. Please include transaction hash.">
                        </div>

                        <div class="col-12 mt-4 pt-2 border-top text-end">
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-5">
                                <i class="fa fa-save me-1"></i> Save Method
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var methodSelect = document.getElementById('new_methodtype');
        var currFields = document.querySelectorAll('.currency-field');
        var cryptoFields = document.querySelectorAll('.crypto-field');

        if (methodSelect) {
            methodSelect.addEventListener('change', function() {
                if (this.value === 'currency') {
                    cryptoFields.forEach(function(el) { el.classList.add('d-none'); });
                    currFields.forEach(function(el) { el.classList.remove('d-none'); });
                } else {
                    currFields.forEach(function(el) { el.classList.add('d-none'); });
                    cryptoFields.forEach(function(el) { el.classList.remove('d-none'); });
                }
            });
        }
    });
</script>
