<div class="row g-4">
    <!-- Section Header -->
    <div class="col-12">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 pb-3 border-bottom">
            <div>
                <h5 class="f-w-700 mb-1">
                    <i class="fa fa-plug text-primary me-2"></i>Connect Wallet Icons & Providers
                </h5>
                <p class="text-muted f-13 mb-0">Manage supported Web3 wallet providers, upload custom wallet icons, and control active options displayed on the user Connect Wallet modal.</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-14 f-w-600 shadow-sm" data-bs-toggle="modal" data-bs-target="#addWalletTypeModal">
                    <i class="fa fa-plus-circle me-1"></i> Add New Wallet
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
                        <i class="fa fa-wallet"></i>
                    </div>
                    <div>
                        <div class="text-muted f-11 text-uppercase f-w-600">Total Wallets</div>
                        <h4 class="f-w-800 text-dark mb-0">{{ $walletTypes->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-success text-white" style="width: 42px; height: 42px; font-size: 18px;">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <div>
                        <div class="text-muted f-11 text-uppercase f-w-600">Active / Visible</div>
                        <h4 class="f-w-800 text-success mb-0">{{ $walletTypes->where('status', 'enabled')->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-secondary text-white" style="width: 42px; height: 42px; font-size: 18px;">
                        <i class="fa fa-eye-slash"></i>
                    </div>
                    <div>
                        <div class="text-muted f-11 text-uppercase f-w-600">Disabled / Hidden</div>
                        <h4 class="f-w-800 text-secondary mb-0">{{ $walletTypes->where('status', 'disabled')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Controls Bar -->
    <div class="col-12">
        <div class="card p-3 border shadow-sm bg-light bg-opacity-25 rounded-3 mb-0">
            <div class="row align-items-center g-2">
                <div class="col-md-6 col-lg-5">
                    <div class="position-relative">
                        <i class="fa fa-search position-absolute text-muted" style="left: 14px; top: 50%; transform: translateY(-50%); font-size: 13px;"></i>
                        <input type="text" id="adminWalletSearchInput" class="form-control form-control-sm rounded-pill f-13" placeholder="Search wallet by name..." onkeyup="filterAdminWallets(this.value)" style="padding-left: 36px;">
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 text-md-end">
                    <span id="adminWalletCountDisplay" class="badge bg-light text-muted border f-12 px-3 py-2 rounded-pill">
                        Showing {{ $walletTypes->count() }} providers
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Table of Configured Wallets -->
    <div class="col-12">
        <div class="table-responsive rounded-3 border">
            <table class="table table-hover align-middle mb-0" id="adminWalletsTable">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="f-13 f-w-700" style="width: 50px;">#</th>
                        <th scope="col" class="f-13 f-w-700" style="width: 80px;">Icon</th>
                        <th scope="col" class="f-13 f-w-700">Wallet Name</th>
                        <th scope="col" class="f-13 f-w-700">Icon File</th>
                        <th scope="col" class="f-13 f-w-700 text-center" style="width: 120px;">Status</th>
                        <th scope="col" class="f-13 f-w-700 text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($walletTypes as $index => $w)
                        <tr class="admin-wallet-row" data-name="{{ strtolower($w->name) }}">
                            <td class="text-muted f-12">{{ $index + 1 }}</td>
                            <td>
                                <div class="rounded-3 border p-1 d-flex align-items-center justify-content-center bg-white" style="width: 44px; height: 44px;">
                                    <img src="{{ $w->icon_url }}" alt="{{ $w->name }}" style="max-width: 38px; max-height: 38px; object-fit: contain;" onerror="this.onerror=null; this.src='{{ asset('assets/wallet-types/icons/generic.svg') }}';">
                                </div>
                            </td>
                            <td>
                                <span class="f-w-700 text-dark f-14">{{ $w->name }}</span>
                            </td>
                            <td>
                                <code class="f-11 text-muted">{{ $w->icon ?? 'default' }}</code>
                            </td>
                            <td class="text-center">
                                @if ($w->status === 'enabled')
                                    <a href="{{ route('admin.wallettypes.toggle', $w->id) }}" class="badge bg-success-light text-success border border-success px-3 py-1 rounded-pill text-decoration-none f-12" title="Click to disable">
                                        <i class="fa fa-check-circle me-1"></i> Enabled
                                    </a>
                                @else
                                    <a href="{{ route('admin.wallettypes.toggle', $w->id) }}" class="badge bg-secondary-light text-secondary border border-secondary px-3 py-1 rounded-pill text-decoration-none f-12" title="Click to enable">
                                        <i class="fa fa-times-circle me-1"></i> Disabled
                                    </a>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.wallettypes.toggle', $w->id) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-2 py-1" title="Toggle Status">
                                        <i class="fa {{ $w->status === 'enabled' ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </a>
                                    <a href="{{ route('admin.wallettypes.delete', $w->id) }}" onclick="return confirm('Are you sure you want to delete {{ addslashes($w->name) }}?')" class="btn btn-outline-danger btn-sm rounded-pill px-2 py-1" title="Delete Wallet">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa fa-wallet f-36 mb-2 opacity-50"></i>
                                <div class="f-14 f-w-700">No wallet types found</div>
                                <div class="f-12">Click "Add New Wallet" above to add your first supported wallet.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Add New Wallet Provider -->
<div class="modal fade" id="addWalletTypeModal" tabindex="-1" aria-labelledby="addWalletTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0" style="border-radius: 16px;">
            <div class="modal-header border-bottom p-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center text-primary" style="width: 36px; height: 36px; font-size: 16px; background: rgba(99, 98, 231, 0.12);">
                        <i class="fa fa-plus-circle"></i>
                    </div>
                    <h5 class="modal-title f-w-700 mb-0" id="addWalletTypeModalLabel">Add Connect Wallet Provider</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.wallettypes.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Wallet Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Phantom, Rainbow, SafePal, BitKeep" required>
                        <small class="text-muted f-11">The official display name of the cryptocurrency wallet.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Wallet Icon Image</label>
                        <input type="file" name="icon" class="form-control" accept="image/png, image/jpeg, image/jpg, image/webp, image/svg+xml" onchange="previewNewWalletIcon(this)">
                        <small class="text-muted f-11">Upload square PNG, JPG, WEBP, or SVG (Recommended: 128x128 or 256x256 px transparent).</small>
                        
                        <!-- Icon Preview Box -->
                        <div id="newWalletIconPreviewContainer" class="mt-2 p-2 border rounded-3 bg-light text-center" style="display: none; width: 80px; height: 80px; margin: 8px auto 0 auto;">
                            <img id="newWalletIconPreview" src="" alt="Preview" style="max-width: 64px; max-height: 64px; object-fit: contain;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Status</label>
                        <select name="status" class="form-select">
                            <option value="enabled" selected>Enabled (Visible to Users)</option>
                            <option value="disabled">Disabled (Hidden)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top p-3 px-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 f-w-600">
                        <i class="fa fa-save me-1"></i> Save Wallet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function filterAdminWallets(query) {
    const q = query.trim().toLowerCase();
    const rows = document.querySelectorAll('.admin-wallet-row');
    let visibleCount = 0;

    rows.forEach(function(row) {
        const name = row.getAttribute('data-name') || '';
        if (name.includes(q)) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    const counter = document.getElementById('adminWalletCountDisplay');
    if (counter) {
        counter.textContent = 'Showing ' + visibleCount + ' providers';
    }
}

function previewNewWalletIcon(input) {
    const previewContainer = document.getElementById('newWalletIconPreviewContainer');
    const previewImg = document.getElementById('newWalletIconPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
    }
}
</script>
