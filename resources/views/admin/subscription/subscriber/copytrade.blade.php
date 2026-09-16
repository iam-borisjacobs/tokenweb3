    <!-- Start Copy Trade Modal -->
    <div class="modal fade" id="copytrade{{ $item['id'] }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-bottom pb-3">
                    <h5 class="modal-title f-w-700 text-dark">
                        <i class="fa-solid fa-copy text-primary me-2"></i> Start Copy Trading
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('cptrade') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subscriberid" value="{{ $item['id'] }}">
                        <label class="form-label f-w-600 f-13">Select Master Account Provider</label>
                        <select name="master" class="form-select form-control mt-1 mb-4" required>
                            @foreach ($masters as $mAccount)
                                <option value="{{ $mAccount['id'] }}">
                                    {{ $mAccount['account_name'] }} (Login: {{ $mAccount['login'] }})
                                </option>
                            @endforeach
                        </select>
                        <div class="text-end">
                            <button type="button" class="btn btn-light rounded-pill px-3 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                                <i class="fa-solid fa-play me-1"></i> Start Copy Trade
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
