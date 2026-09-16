<!-- Renew Master account Modal -->
<div class="modal fade" id="renewModal{{ $item['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg text-center p-3">
            <div class="modal-body pt-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 24px;">
                    <i class="fa-solid fa-rotate"></i>
                </div>
                <h5 class="f-w-700 text-dark mb-2">Renew Master Account</h5>
                <p class="text-muted f-13 mb-4">
                    You will be charged <strong>${{ $amountPerSlot }}</strong> to renew this provider account slot.
                </p>
                <form action="{{ route('renew.master') }}" method="POST">
                    @csrf
                    <input type="hidden" name="account_id" value="{{ $item['id'] }}">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light rounded-pill w-100 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 f-13 f-w-700">
                            Yes Proceed
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Strategy Modal -->
<div class="modal fade" id="strategyModal{{ $item['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title f-w-700 text-dark">
                    <i class="fa-solid fa-sliders text-primary me-2"></i> Update Trading Strategy
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updatestrategy') }}" method="POST">
                @csrf
                <input type="hidden" name="account_id" value="{{ $item['id'] }}">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-12">Strategy Name</label>
                        <input type="text" name="name" value="{{ $item['strategy_name'] }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-12">Short Description</label>
                        <input type="text" name="desc" value="{{ $item['strategy_description'] }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-12">Trade Size Mode</label>
                        <select name="trademode" class="form-select form-control" required>
                            <option selected>{{ $item['strategy_mode'] }}</option>
                            <option value="none">none</option>
                            <option value="contractSize">contractSize</option>
                            <option value="balance">balance</option>
                            <option value="equity">equity</option>
                            <option value="fixedVolume">fixedVolume</option>
                            <option value="fixedRisk">fixedRisk</option>
                            <option value="expression">expression</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label f-w-600 f-12">Mode Parameter Value</label>
                        <input type="text" name="modecompliment" value="{{ $item['stra_com'] }}" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-light rounded-pill px-3 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Strategy
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
