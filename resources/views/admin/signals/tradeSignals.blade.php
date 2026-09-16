@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-chart-line text-primary me-2"></i> Trade Signals Dispatcher
            </h3>
            <p class="text-muted mb-0 f-13">Create, broadcast, and publish trading setups and profit results to subscribers.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <a href="{{ route('signal.settings') }}" class="btn btn-light rounded-pill px-3 py-2 f-13 f-w-600 shadow-sm">
                <i class="fa-solid fa-gear me-1"></i> Signal Settings
            </a>
            <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm" data-bs-toggle="modal" data-bs-target="#addSignalModal">
                <i class="fa-solid fa-plus me-1"></i> New Trade Signal
            </button>
        </div>
    </div>

    <!-- Signals Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Active & Published Signals</h5>
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-1 f-12 f-w-600">
                {{ count($signals) }} Total Signal{{ count($signals) === 1 ? '' : 's' }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Ref #</th>
                        <th class="f-12 f-w-700">Direction</th>
                        <th class="f-12 f-w-700">Pair / Asset</th>
                        <th class="f-12 f-w-700">Entry Price</th>
                        <th class="f-12 f-w-700">Take Profit</th>
                        <th class="f-12 f-w-700">Stop Loss</th>
                        <th class="f-12 f-w-700">Outcome / Result</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700">Date Added</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($signals as $signal)
                        <tr>
                            <td class="font-monospace f-w-700 f-13 text-dark">
                                #{{ $signal->reference }}
                            </td>
                            <td>
                                @if ($signal->trade_direction == 'Buy')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-arrow-trend-up me-1"></i> BUY
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-arrow-trend-down me-1"></i> SELL
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace px-2 py-1 rounded-pill f-12 f-w-700">
                                    {{ $signal->currency_pair }}
                                </span>
                            </td>
                            <td class="font-monospace f-w-600 f-13 text-dark">
                                {{ $signal->price }}
                            </td>
                            <td>
                                <div class="font-monospace f-12 text-success">
                                    TP1: <strong>{{ $signal->take_profit1 }}</strong>
                                    @if($signal->take_profit2)
                                        <br>TP2: <strong>{{ $signal->take_profit2 }}</strong>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="font-monospace f-12 text-danger f-w-600">
                                    {{ $signal->stop_loss1 }}
                                </span>
                            </td>
                            <td>
                                @if(!empty($signal->result))
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 f-11">
                                        {{ $signal->result }}
                                    </span>
                                @else
                                    <span class="text-muted f-12">—</span>
                                @endif
                            </td>
                            <td>
                                @if ($signal->status == 'published')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-circle-check me-1"></i> Published
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-eye-slash me-1"></i> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted f-12 text-nowrap">
                                {{ $signal->created_at ? \Carbon\Carbon::parse($signal->created_at)->format('M d, Y • h:i A') : 'N/A' }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    @if ($signal->status == 'unpublished')
                                        <a href="{{ route('pubsignals', ['signal' => $signal->id]) }}" class="btn btn-outline-primary btn-sm rounded-pill px-2 py-1 f-11" title="Publish Signal">
                                            <i class="fa-solid fa-bullhorn me-1"></i> Publish
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-2 py-1 f-11" data-bs-toggle="modal" data-bs-target="#resultModal{{ $signal->id }}" title="Update Result">
                                            <i class="fa-solid fa-trophy me-1"></i> Result
                                        </button>
                                    @endif

                                    <a href="{{ route('delete.signal', ['signal' => $signal->id]) }}" class="btn btn-outline-danger btn-sm rounded-pill px-2 py-1 f-11" onclick="return confirm('Delete this trade signal?');" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>

                                <!-- Result Modal -->
                                <div class="modal fade" id="resultModal{{ $signal->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm text-start">
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-header border-bottom pb-3">
                                                <h5 class="modal-title f-w-700 text-dark">
                                                    <i class="fa-solid fa-trophy text-primary me-2"></i> Update Result
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('updt.result') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="signalId" value="{{ $signal->id }}">
                                                <div class="modal-body p-4">
                                                    <label class="form-label f-w-600 f-12">Signal Outcome</label>
                                                    <input type="text" name="result" value="{{ $signal->result }}" class="form-control" placeholder="e.g. +45 Pips Profit or SL Hit" required>
                                                </div>
                                                <div class="modal-footer border-top pt-3">
                                                    <button type="button" class="btn btn-light rounded-pill px-3 py-1 f-12" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill px-3 py-1 f-12 f-w-700">
                                                        Save Result
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-signal f-32 mb-2 d-block text-muted opacity-50"></i>
                                No trade signals created yet. Click "New Trade Signal" to dispatch your first trade setup.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Signal Modal -->
<div class="modal fade" id="addSignalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title f-w-700 text-dark">
                    <i class="fa-solid fa-plus text-primary me-2"></i> Create New Trade Signal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('postsignals') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Trade Direction <span class="text-danger">*</span></label>
                            <select name="direction" class="form-select form-control" required>
                                <option value="Buy">BUY (Long)</option>
                                <option value="Sell">SELL (Short)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Currency / Asset Pair <span class="text-danger">*</span></label>
                            <input type="text" name="pair" class="form-control" placeholder="e.g. EUR/USD or BTC/USDT" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-12">Entry Price <span class="text-danger">*</span></label>
                            <input type="text" name="price" class="form-control" placeholder="e.g. 1.0850" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-12">Take Profit 1 <span class="text-danger">*</span></label>
                            <input type="text" step="any" name="tp1" class="form-control" placeholder="e.g. 1.0920" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-12">Take Profit 2 <small class="text-muted">(Optional)</small></label>
                            <input type="text" step="any" name="tp2" class="form-control" placeholder="e.g. 1.0980">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Stop Loss <span class="text-danger">*</span></label>
                            <input type="text" step="any" name="sl1" class="form-control" placeholder="e.g. 1.0800" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-light rounded-pill px-4 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                        <i class="fa-solid fa-paper-plane me-1"></i> Create Signal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
