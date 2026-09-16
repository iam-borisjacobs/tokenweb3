<div class="row g-4">
    <!-- Section Header -->
    <div class="col-12">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 pb-3 border-bottom">
            <div>
                <h5 class="f-w-700 mb-1">
                    <i class="fa fa-wallet text-primary me-2"></i>Crypto Deposit & Receiving Wallet Addresses
                </h5>
                <p class="text-muted f-13 mb-0">Configure cryptocurrency wallet addresses displayed to users for deposit transactions and automated fund routing.</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-14 f-w-600 shadow-sm" data-bs-toggle="modal" data-bs-target="#addCryptoWalletModal">
                    <i class="fa fa-plus-circle me-1"></i> Add New Wallet Address
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="col-12">
        <div class="row g-3">
            <div class="col-sm-6 col-md-4">
                <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-primary text-white" style="width: 42px; height: 42px; font-size: 18px;">
                        <i class="fa fa-coins"></i>
                    </div>
                    <div>
                        <div class="text-muted f-11 text-uppercase f-w-600">Total Crypto Wallets</div>
                        <h4 class="f-w-800 text-dark mb-0">{{ $cryptoMethods->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-success text-white" style="width: 42px; height: 42px; font-size: 18px;">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <div>
                        <div class="text-muted f-11 text-uppercase f-w-600">Active Receiving Addresses</div>
                        <h4 class="f-w-800 text-success mb-0">{{ $cryptoMethods->where('status', 'enabled')->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-info text-white" style="width: 42px; height: 42px; font-size: 18px;">
                        <i class="fa fa-network-wired"></i>
                    </div>
                    <div>
                        <div class="text-muted f-11 text-uppercase f-w-600">Supported Networks</div>
                        <h4 class="f-w-800 text-info mb-0">BTC, ETH, TRC20, SOL</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table of Configured Cryptocurrency Wallet Addresses -->
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="f-13 f-w-700">Coin / Asset</th>
                        <th scope="col" class="f-13 f-w-700">Network</th>
                        <th scope="col" class="f-13 f-w-700">Receiving Wallet Address</th>
                        <th scope="col" class="f-13 f-w-700">Limits (Min / Max)</th>
                        <th scope="col" class="f-13 f-w-700">Status</th>
                        <th scope="col" class="f-13 f-w-700 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cryptoMethods as $method)
                        <tr>
                            <td class="f-w-600">
                                <div class="d-flex align-items-center gap-2">
                                    @if ($method->img_url)
                                        <img src="{{ $method->img_url }}" alt="{{ $method->name }}" class="rounded-circle border" style="width: 32px; height: 32px; object-fit: contain;">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center border text-primary" style="width: 32px; height: 32px; font-size: 14px;">
                                            <i class="fa fa-wallet"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-dark f-w-700 f-13">{{ $method->name }}</div>
                                        <small class="text-muted f-11">{{ $method->type ?? 'deposit' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light-warning text-warning rounded-pill px-3 py-1 f-12 text-uppercase f-w-700 border">
                                    {{ $method->network ?? 'Mainnet' }}
                                </span>
                            </td>
                            <td>
                                @if(!empty($method->wallet_address))
                                    <div class="d-flex align-items-center gap-2">
                                        <code class="p-1 px-2 rounded bg-light border f-12 text-dark font-monospace" style="user-select: all;">
                                            {{ $method->wallet_address }}
                                        </code>
                                        <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2 rounded" title="Copy Address" onclick="navigator.clipboard.writeText('{{ $method->wallet_address }}'); alert('Address copied: {{ $method->wallet_address }}');">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </div>
                                @else
                                    <span class="text-muted f-12 f-italic">No address configured</span>
                                @endif
                            </td>
                            <td>
                                <div class="f-12 text-dark f-w-600">
                                    Min: {{ $settings->currency }}{{ number_format($method->minimum ?? 0) }}
                                </div>
                                <small class="text-muted f-11">
                                    Max: {{ $settings->currency }}{{ number_format($method->maximum ?? 0) }}
                                </small>
                            </td>
                            <td>
                                @if ($method->status == 'enabled')
                                    <span class="badge bg-light-success text-success rounded-pill px-3 py-1 f-12 f-w-600">
                                        <i class="fa fa-check-circle me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-light-danger text-danger rounded-pill px-3 py-1 f-12 f-w-600">
                                        <i class="fa fa-times-circle me-1"></i> Disabled
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('editpaymethod', $method->id) }}" class="btn btn-outline-primary btn-sm rounded px-2 py-1" title="Edit Wallet Details">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('deletepaymethod', $method->id) }}" class="btn btn-outline-danger btn-sm rounded px-2 py-1" title="Delete Wallet" onclick="return confirm('Are you sure you want to delete this cryptocurrency wallet address?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa fa-wallet f-36 mb-2 opacity-50"></i>
                                <h6 class="f-w-700">No Cryptocurrency Wallet Addresses Configured</h6>
                                <p class="f-12 text-muted mb-3">Add your first deposit wallet address (e.g. Bitcoin, USDT, Ethereum) for client deposits.</p>
                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 py-2 f-w-600" data-bs-toggle="modal" data-bs-target="#addCryptoWalletModal">
                                    <i class="fa fa-plus-circle me-1"></i> Add Wallet Address
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add New Cryptocurrency Wallet Address Modal -->
<div class="modal fade" id="addCryptoWalletModal" tabindex="-1" aria-labelledby="addCryptoWalletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg border-0" style="border-radius: 16px;">
            <div class="modal-header border-bottom p-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center text-primary" style="width: 36px; height: 36px; font-size: 16px; background: rgba(99, 98, 231, 0.12);">
                        <i class="fa fa-wallet"></i>
                    </div>
                    <div>
                        <h5 class="f-w-700 text-dark mb-0" id="addCryptoWalletModalLabel">Add Cryptocurrency Wallet Address</h5>
                        <small class="text-muted f-11">Configure a new company crypto receiving address for investor deposits</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('addpaymethod') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="methodtype" value="crypto">
                <input type="hidden" name="typefor" value="deposit">
                <input type="hidden" name="charges" value="0">
                <input type="hidden" name="chargetype" value="percentage">

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-13 f-w-600 text-dark">Cryptocurrency Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="e.g. Bitcoin, Ethereum, USDT, Solana" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-13 f-w-600 text-dark">Network / Chain Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="wallettype" placeholder="e.g. TRC20, ERC20, BEP20, Mainnet, SOL" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label f-13 f-w-600 text-dark">Receiving Wallet Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-monospace" name="walletaddress" placeholder="e.g. bc1q... or 0x... or TLz6jq..." required>
                            <small class="text-muted f-11">Ensure this address is correct. Funds deposited by users will be routed to this wallet.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-13 f-w-600 text-dark">Minimum Deposit Amount ({{ $settings->currency }})</label>
                            <input type="number" step="any" class="form-control" name="minimum" value="10" placeholder="10">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-13 f-w-600 text-dark">Maximum Deposit Amount ({{ $settings->currency }})</label>
                            <input type="number" step="any" class="form-control" name="maximum" value="1000000" placeholder="1000000">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-13 f-w-600 text-dark">Coin Icon / Logo Image URL (Optional)</label>
                            <input type="text" class="form-control" name="url" placeholder="https://.../coin-logo.png">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-13 f-w-600 text-dark">Status</label>
                            <select class="form-select" name="status">
                                <option value="enabled" selected>Active / Enabled</option>
                                <option value="disabled">Disabled</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label f-13 f-w-600 text-dark">Upload QR Code / Barcode Image (Optional)</label>
                            <input type="file" class="form-control" name="barcode" accept="image/*">
                            <small class="text-muted f-11">Upload a QR code of this wallet address so users can scan to pay easily.</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top p-3 px-4">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 f-w-600 shadow-sm">
                        <i class="fa fa-save me-1"></i> Save Wallet Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
