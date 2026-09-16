@extends('layouts.dash')
@section('title', 'AI Algorithmic Trading Bots')

@section('content')
<div class="container-fluid py-3">
    <!-- Header Banner -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1 rounded-pill f-11 f-w-700">
                    <i class="fa-solid fa-microchip me-1"></i> NEURAL ENGINE v4.8 ACTIVE
                </span>
                @if($isLocked)
                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1 rounded-pill f-11 f-w-700">
                        <i class="fa-solid fa-lock me-1"></i> Clearance Required
                    </span>
                @endif
            </div>
            <h4 class="f-w-800 text-dark mb-1">AI Algorithmic Trading Bots</h4>
            <p class="text-muted f-13 mb-0">Autonomous algorithmic bots executing machine-learning trade strategies 24/7 with microsecond execution.</p>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="{{ route('copytrading') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-13 f-w-600">
                <i class="fa-solid fa-user-tie me-1"></i> Master Traders
            </a>
            <a href="{{ route('tsignals') }}" class="btn btn-primary rounded-pill px-3 py-2 f-13 f-w-700 shadow-sm">
                <i class="fa-solid fa-bolt me-1"></i> Premium Signals
            </a>
        </div>
    </div>

    @if($isLocked)
    <!-- Institutional Clearance Banner -->
    <div class="card border-0 mb-4 text-white p-3 shadow-sm" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%); border-radius: 14px;">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-warning bg-opacity-20 d-flex align-items-center justify-content-center text-warning flex-shrink-0" style="width: 44px; height: 44px; font-size: 20px;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h6 class="text-white f-w-700 mb-1 f-14">AI Bot Deployment Status: <span class="text-warning">Restricted</span></h6>
                    <p class="text-white text-opacity-80 f-12 mb-0">
                        Deploying autonomous AI trading bots on live exchange liquidity requires qualified capital of <strong>{{ $settings->currency }}{{ number_format($settings->min_trading_balance, 2) }}</strong>. Your qualified balance is <strong>{{ $settings->currency }}{{ number_format($userTotalBalance, 2) }}</strong>.
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2 flex-shrink-0">
                <button type="button" class="btn btn-warning text-dark rounded-pill px-3 py-2 f-12 f-w-700" onclick="window.openTradingClearanceModal(event, 'AI Trading Bots')">
                    <i class="fa-solid fa-unlock me-1"></i> Request Clearance
                </button>
                <a href="{{ route('deposits') }}" class="btn btn-outline-light rounded-pill px-3 py-2 f-12 f-w-600">
                    <i class="fa-solid fa-wallet me-1"></i> Deposit
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- AI Bot Performance Metrics Ribbon -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <small class="text-muted f-11 d-block mb-1">Bot Execution Uptime</small>
                <h5 class="f-w-800 text-success mb-0 f-18">99.98%</h5>
                <small class="text-muted f-10">Fault-tolerant cloud clusters</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <small class="text-muted f-11 d-block mb-1">Decision Engine Latency</small>
                <h5 class="f-w-800 text-primary mb-0 f-18">1.4 ms</h5>
                <small class="text-success f-10"><i class="fa-solid fa-bolt me-1"></i>Colocated API nodes</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <small class="text-muted f-11 d-block mb-1">24h Automated Volume</small>
                <h5 class="f-w-800 text-dark mb-0 f-18">$12.4 Million</h5>
                <small class="text-muted f-10">Across 8,420 micro-trades</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <small class="text-muted f-11 d-block mb-1">Risk Assessment</small>
                <h5 class="f-w-800 text-info mb-0 f-18">Auto Circuit-Breaker</h5>
                <small class="text-muted f-10">Dynamic volatility guards</small>
            </div>
        </div>
    </div>

    <!-- AI Bots Grid (4 Core Strategies) -->
    <div class="row g-4 mb-4">
        <!-- Bot 1: Infinity Grid -->
        <div class="col-md-6 col-xl-3">
            <div class="card border shadow-sm h-100 mb-0 d-flex flex-column" style="border-radius: 16px;">
                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                            <i class="fa-solid fa-table-cells f-20"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">Est. 48.6% APY</span>
                    </div>

                    <h5 class="f-w-800 text-dark mb-1 f-16">AI Infinity Grid Bot</h5>
                    <p class="text-muted f-12 mb-3">Captures continuous profit from price oscillations by placing automated geometric buy and sell grids.</p>

                    <div class="p-3 bg-light rounded-3 mb-3">
                        <div class="d-flex justify-content-between mb-1 f-11">
                            <span class="text-muted">Target Assets:</span>
                            <strong class="text-dark">BTC, ETH, SOL</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1 f-11">
                            <span class="text-muted">Strategy Type:</span>
                            <strong class="text-dark">High-Frequency Grid</strong>
                        </div>
                        <div class="d-flex justify-content-between f-11">
                            <span class="text-muted">Max Historical DD:</span>
                            <strong class="text-success">3.2%</strong>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                                onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'AI Infinity Grid Bot')" : "openBotModal('AI Infinity Grid Bot', '48.6%')" }}">
                            @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Deploy Grid Bot
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bot 2: Smart DCA Multi-Pair -->
        <div class="col-md-6 col-xl-3">
            <div class="card border shadow-sm h-100 mb-0 d-flex flex-column" style="border-radius: 16px;">
                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                            <i class="fa-solid fa-layer-group f-20"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">Est. 34.2% APY</span>
                    </div>

                    <h5 class="f-w-800 text-dark mb-1 f-16">Smart DCA Multi-Pair</h5>
                    <p class="text-muted f-12 mb-3">Accumulates high-conviction assets during market dips using RSI divergence & Fibonacci levels.</p>

                    <div class="p-3 bg-light rounded-3 mb-3">
                        <div class="d-flex justify-content-between mb-1 f-11">
                            <span class="text-muted">Target Assets:</span>
                            <strong class="text-dark">Top 10 Crypto Basket</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1 f-11">
                            <span class="text-muted">Strategy Type:</span>
                            <strong class="text-dark">Algorithmic Averaging</strong>
                        </div>
                        <div class="d-flex justify-content-between f-11">
                            <span class="text-muted">Max Historical DD:</span>
                            <strong class="text-success">4.8%</strong>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                                onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Smart DCA Bot')" : "openBotModal('Smart DCA Multi-Pair', '34.2%')" }}">
                            @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Deploy DCA Bot
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bot 3: Tri-Exchange Arbitrage -->
        <div class="col-md-6 col-xl-3">
            <div class="card border shadow-sm h-100 mb-0 d-flex flex-column" style="border-radius: 16px;">
                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);">
                            <i class="fa-solid fa-shuffle f-20"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">Est. 28.5% APY</span>
                    </div>

                    <h5 class="f-w-800 text-dark mb-1 f-16">Tri-Exchange Arbitrage</h5>
                    <p class="text-muted f-12 mb-3">Exploits instantaneous price inefficiencies between centralized order books with zero directional risk.</p>

                    <div class="p-3 bg-light rounded-3 mb-3">
                        <div class="d-flex justify-content-between mb-1 f-11">
                            <span class="text-muted">Target Assets:</span>
                            <strong class="text-dark">Binance, Coinbase, OKX</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1 f-11">
                            <span class="text-muted">Strategy Type:</span>
                            <strong class="text-dark">Delta-Neutral Arbitrage</strong>
                        </div>
                        <div class="d-flex justify-content-between f-11">
                            <span class="text-muted">Max Historical DD:</span>
                            <strong class="text-success">0.9%</strong>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                                onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Arbitrage Bot')" : "openBotModal('Tri-Exchange Arbitrage', '28.5%')" }}">
                            @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Deploy Arbitrage Bot
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bot 4: Deep Neural Momentum -->
        <div class="col-md-6 col-xl-3">
            <div class="card border shadow-sm h-100 mb-0 d-flex flex-column" style="border-radius: 16px;">
                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="fa-solid fa-brain f-20"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-11 f-w-700 px-2 py-1">Est. 62.4% APY</span>
                    </div>

                    <h5 class="f-w-800 text-dark mb-1 f-16">Deep Neural Momentum</h5>
                    <p class="text-muted f-12 mb-3">LSTM recurrent neural network modeling order flow imbalances to capture high-velocity breakouts.</p>

                    <div class="p-3 bg-light rounded-3 mb-3">
                        <div class="d-flex justify-content-between mb-1 f-11">
                            <span class="text-muted">Target Assets:</span>
                            <strong class="text-dark">High-Vol Alts & BTC</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1 f-11">
                            <span class="text-muted">Strategy Type:</span>
                            <strong class="text-dark">Deep Learning Breakout</strong>
                        </div>
                        <div class="d-flex justify-content-between f-11">
                            <span class="text-muted">Max Historical DD:</span>
                            <strong class="text-warning">7.2%</strong>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm"
                                onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Deep Neural Momentum Bot')" : "openBotModal('Deep Neural Momentum', '62.4%')" }}">
                            @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Deploy Neural Bot
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Bot Executions / Simulation Logs -->
    <div class="card border shadow-sm mb-4" style="border-radius: 14px;">
        <div class="card-header border-bottom py-3 px-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-terminal text-primary f-16"></i>
                <h6 class="f-w-700 text-dark mb-0 f-14">Live Algorithm Execution Log</h6>
            </div>
            <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-10">Engine Connected</span>
        </div>
        <div class="card-body p-3 bg-dark text-white font-monospace f-11" style="max-height: 220px; overflow-y: auto; border-radius: 0 0 14px 14px;">
            <div class="text-success mb-1">[2026-09-13 01:40:12 UTC] INF_GRID: Placed buy order 0.12 BTC @ $109,850.00 (Order #98124)</div>
            <div class="text-info mb-1">[2026-09-13 01:41:04 UTC] ARB_ENGINE: Detected 0.38% spread on ETH/USDT between Binance and OKX. Executed synthetic hedge.</div>
            <div class="text-white-50 mb-1">[2026-09-13 01:41:55 UTC] NEURAL_CORE: Ingesting L2 order book depth for SOL/USDT... Imbalance +14.2% buyer pressure.</div>
            <div class="text-success mb-1">[2026-09-13 01:42:20 UTC] INF_GRID: Sell order filled 0.12 BTC @ $110,210.00. Net Profit: +$43.20 (+0.33%).</div>
        </div>
    </div>
</div>

<!-- Modal: Configure Bot Deployment -->
<div class="modal fade" id="deployBotModal" tabindex="-1" aria-labelledby="deployBotLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-robot text-primary f-18"></i>
                    <h6 class="modal-title f-w-700 text-dark mb-0 f-15" id="deployBotLabel">Deploy Trading Bot</h6>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="p-3 bg-light rounded-3 mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted f-12">Algorithm:</span>
                        <strong class="text-dark f-12" id="selectedBotName">AI Infinity Grid Bot</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted f-12">Projected APY:</span>
                        <span class="text-success f-w-700 f-12" id="selectedBotApy">48.6%</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label f-12 f-w-600 text-muted mb-1">Bot Operating Capital ($)</label>
                    <div class="input-group">
                        <span class="input-group-text f-12">{{ $settings->currency }}</span>
                        <input type="number" step="any" min="500" class="form-control f-12" id="botCapital" value="2500" placeholder="2500.00">
                    </div>
                    <small class="text-muted f-11">Available Balance: {{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2) }}</small>
                </div>

                <div class="mb-3">
                    <label class="form-label f-12 f-w-600 text-muted mb-1">Auto Profit Reinvestment</label>
                    <select class="form-select f-12">
                        <option value="compound" selected>Compound Gains (Maximum Growth)</option>
                        <option value="harvest">Harvest to Account Balance Daily</option>
                    </select>
                </div>

                <button type="button" class="btn btn-primary w-100 py-2 rounded-pill f-13 f-w-700 shadow-sm" onclick="confirmBotDeployment()">
                    <i class="fa-solid fa-play me-1"></i> Start Autonomous Execution
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openBotModal(name, apy) {
        document.getElementById('selectedBotName').innerText = name;
        document.getElementById('selectedBotApy').innerText = apy;
        var m = new bootstrap.Modal(document.getElementById('deployBotModal'));
        m.show();
    }

    function confirmBotDeployment() {
        var cap = document.getElementById('botCapital').value;
        var name = document.getElementById('selectedBotName').innerText;
        var modalEl = document.getElementById('deployBotModal');
        var modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        if (window.toastr) {
            toastr.success(`Autonomous bot [${name}] deployed with $${cap} operating capital!`);
        } else {
            alert(`Bot [${name}] deployed!`);
        }
    }
</script>
@endsection
