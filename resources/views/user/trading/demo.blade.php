@extends('layouts.dash')
@section('title', 'Demo Trading Terminal')

@section('content')
<div class="container-fluid py-3">
    <!-- Header Banner -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill f-11 f-w-700">
                    <i class="fa-solid fa-flask me-1"></i> SIMULATED ENVIRONMENT
                </span>
                @if($isLocked)
                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1 rounded-pill f-11 f-w-700">
                        <i class="fa-solid fa-lock me-1"></i> Live Execution Locked
                    </span>
                @endif
            </div>
            <h4 class="f-w-800 text-dark mb-1">Demo Trading Terminal</h4>
            <p class="text-muted f-13 mb-0">Hone your institutional trading strategies in real-time with zero risk.</p>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <!-- Simulated Balance Card -->
            <div class="card border mb-0 py-2 px-3 shadow-sm" style="border-radius: 12px; background: rgba(99, 98, 231, 0.04);">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <small class="text-muted f-11 d-block font-weight-bold text-uppercase">Virtual Demo Balance</small>
                        <span class="f-18 f-w-800 text-primary" id="demoBalanceDisplay">${{ number_format($demoBalance ?? 88140.00, 2) }}</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-1 px-2 f-11" onclick="resetDemoBalance()" title="Reset virtual capital">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reset
                    </button>
                </div>
            </div>

            <!-- Switch to Live -->
            <a href="{{ $isLocked ? 'javascript:void(0)' : route('livemarkets') }}" 
               @if($isLocked) onclick="window.openTradingClearanceModal(event, 'Live Markets')" @endif
               class="btn btn-primary rounded-pill px-3 py-2 f-13 f-w-700 shadow-sm d-flex align-items-center gap-2">
                @if($isLocked)<i class="fa-solid fa-lock"></i>@else<i class="fa-solid fa-arrow-up-right-from-square"></i>@endif
                <span>Switch to Live</span>
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
                    <h6 class="text-white f-w-700 mb-1 f-14">Live Trading Clearance Status: <span class="text-warning">Restricted</span></h6>
                    <p class="text-white text-opacity-80 f-12 mb-0">
                        Demo trading is fully operational. Live market order routing requires a qualified institutional threshold of <strong>{{ $settings->currency }}{{ number_format($settings->min_trading_balance, 2) }}</strong>. Your qualified balance is <strong>{{ $settings->currency }}{{ number_format($userTotalBalance, 2) }}</strong>.
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2 flex-shrink-0">
                <button type="button" class="btn btn-warning text-dark rounded-pill px-3 py-2 f-12 f-w-700" onclick="window.openTradingClearanceModal(event, 'Live Execution')">
                    <i class="fa-solid fa-unlock me-1"></i> Unlock Live Clearance
                </button>
                <a href="{{ route('deposits') }}" class="btn btn-outline-light rounded-pill px-3 py-2 f-12 f-w-600">
                    <i class="fa-solid fa-wallet me-1"></i> Deposit
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Terminal Main Layout: Chart (8 cols) + Order Form (4 cols) -->
    <div class="row g-3 mb-4">
        <!-- Live TradingView Chart -->
        <div class="col-lg-8">
            <div class="card border shadow-sm h-100 mb-0" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header bg-transparent border-bottom py-3 px-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-brands fa-bitcoin text-warning f-20"></i>
                        <span class="f-w-800 text-dark f-15">BTC / USDT</span>
                        <span class="badge bg-success rounded-pill f-10">+2.84%</span>
                        <span class="text-muted f-12 ms-2">Spot • Real-time Feeds</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <button type="button" class="btn btn-sm btn-light border py-1 px-2 f-11 active">15M</button>
                        <button type="button" class="btn btn-sm btn-light border py-1 px-2 f-11">1H</button>
                        <button type="button" class="btn btn-sm btn-light border py-1 px-2 f-11">4H</button>
                        <button type="button" class="btn btn-sm btn-light border py-1 px-2 f-11">1D</button>
                    </div>
                </div>
                <div class="card-body p-0" style="height: 520px;">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container" style="height:100%;width:100%">
                        <div id="tradingview_demo_chart" style="height:100%;width:100%"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                            new TradingView.widget({
                                "autosize": true,
                                "symbol": "BINANCE:BTCUSDT",
                                "interval": "60",
                                "timezone": "Etc/UTC",
                                "theme": document.body.classList.contains("dark-only") ? "dark" : "light",
                                "style": "1",
                                "locale": "en",
                                "toolbar_bg": "#f1f3f6",
                                "enable_publishing": false,
                                "allow_symbol_change": true,
                                "container_id": "tradingview_demo_chart"
                            });
                        </script>
                    </div>
                    <!-- TradingView Widget END -->
                </div>
            </div>
        </div>

        <!-- Simulated Order Execution Terminal -->
        <div class="col-lg-4">
            <div class="card border shadow-sm h-100 mb-0" style="border-radius: 14px;">
                <div class="card-header border-bottom py-3 px-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="f-w-700 text-dark mb-0 f-14">Simulated Execution</h6>
                        <small class="text-muted f-11">Test orders fill instantly against spot price</small>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill f-10">Demo Active</span>
                </div>
                <div class="card-body p-3">
                    <!-- Buy / Sell Toggle Tabs -->
                    <div class="d-grid grid-columns-2 gap-2 mb-3" style="display: grid; grid-template-columns: 1fr 1fr;">
                        <button type="button" class="btn btn-success py-2 f-12 f-w-700" id="demoBtnBuy" onclick="setDemoTab('buy')">BUY / LONG</button>
                        <button type="button" class="btn btn-outline-danger py-2 f-12 f-w-700" id="demoBtnSell" onclick="setDemoTab('sell')">SELL / SHORT</button>
                    </div>

                    <form id="demoOrderForm" onsubmit="handleDemoOrder(event)">
                        <!-- Order Type -->
                        <div class="mb-3">
                            <label class="form-label f-12 f-w-600 text-muted mb-1">Order Type</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-primary flex-fill f-11" id="btnMarketOrder" onclick="setOrderType('market')">Market</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary flex-fill f-11" id="btnLimitOrder" onclick="setOrderType('limit')">Limit</button>
                            </div>
                        </div>

                        <!-- Asset Pair -->
                        <div class="mb-3">
                            <label class="form-label f-12 f-w-600 text-muted mb-1">Asset Pair</label>
                            <select class="form-select f-12" id="demoPair">
                                <option value="BTCUSDT" data-price="110012">Bitcoin (BTC / USDT) - $110,012.00</option>
                                <option value="ETHUSDT" data-price="3420">Ethereum (ETH / USDT) - $3,420.50</option>
                                <option value="SOLUSDT" data-price="182">Solana (SOL / USDT) - $182.20</option>
                                <option value="EURUSD" data-price="1.085">EUR / USD - 1.0850</option>
                            </select>
                        </div>

                        <!-- Amount -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label f-12 f-w-600 text-muted mb-0">Simulated Amount ($)</label>
                                <small class="text-primary f-11 cursor-pointer" onclick="setDemoMax()">Max Available</small>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text f-12">$</span>
                                <input type="number" step="any" min="10" class="form-control f-12" id="demoAmount" placeholder="1000.00" value="1000" required>
                            </div>
                            <div class="d-flex gap-1 mt-1">
                                <button type="button" class="btn btn-xs btn-light border flex-fill f-10 py-1" onclick="setDemoPercent(0.1)">10%</button>
                                <button type="button" class="btn btn-xs btn-light border flex-fill f-10 py-1" onclick="setDemoPercent(0.25)">25%</button>
                                <button type="button" class="btn btn-xs btn-light border flex-fill f-10 py-1" onclick="setDemoPercent(0.5)">50%</button>
                                <button type="button" class="btn btn-xs btn-light border flex-fill f-10 py-1" onclick="setDemoPercent(1.0)">100%</button>
                            </div>
                        </div>

                        <!-- Leverage -->
                        <div class="mb-3">
                            <label class="form-label f-12 f-w-600 text-muted mb-1">Virtual Leverage: <span class="text-primary f-w-700" id="levDisplay">10x</span></label>
                            <input type="range" class="form-range" min="1" max="50" step="1" value="10" id="demoLeverage" oninput="document.getElementById('levDisplay').innerText = this.value + 'x'">
                        </div>

                        <!-- TP / SL -->
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label f-11 f-w-600 text-muted mb-1">Take Profit ($)</label>
                                <input type="number" step="any" class="form-control f-11" id="demoTP" placeholder="Optional">
                            </div>
                            <div class="col-6">
                                <label class="form-label f-11 f-w-600 text-muted mb-1">Stop Loss ($)</label>
                                <input type="number" step="any" class="form-control f-11" id="demoSL" placeholder="Optional">
                            </div>
                        </div>

                        <!-- Submit Order Button -->
                        <button type="submit" class="btn btn-success w-100 py-2 f-13 f-w-700 shadow-sm" id="btnDemoSubmit">
                            <i class="fa-solid fa-bolt me-1"></i> Place Demo BUY Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Simulated Positions Table -->
    <div class="card border shadow-sm mb-4" style="border-radius: 14px;">
        <div class="card-header border-bottom py-3 px-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-list-check text-primary f-16"></i>
                <h6 class="f-w-700 text-dark mb-0 f-14">Active Simulated Positions</h6>
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill f-10" id="positionCountBadge">2 Open</span>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill py-1 px-2 f-11" onclick="closeAllPositions()">
                <i class="fa-solid fa-xmark me-1"></i> Close All Positions
            </button>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0 f-12" id="demoPositionsTable">
                <thead class="bg-light text-muted f-11 text-uppercase">
                    <tr>
                        <th class="ps-3">Pair / Side</th>
                        <th>Order Type</th>
                        <th>Entry Price</th>
                        <th>Current Price</th>
                        <th>Size / Leverage</th>
                        <th>PnL ($)</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody id="demoPositionsBody">
                    <tr id="pos-row-1">
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-brands fa-bitcoin text-warning f-16"></i>
                                <div>
                                    <strong class="text-dark">BTC / USDT</strong>
                                    <span class="badge bg-success bg-opacity-10 text-success ms-1 f-9">LONG</span>
                                </div>
                            </div>
                        </td>
                        <td>Market</td>
                        <td>$108,420.00</td>
                        <td>$110,012.00</td>
                        <td>$5,000.00 (10x)</td>
                        <td class="text-success f-w-700">+$734.20 (+14.68%)</td>
                        <td><span class="badge bg-success rounded-pill f-10">Running</span></td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-xs btn-outline-danger rounded-pill py-1 px-2 f-10" onclick="closePosition('pos-row-1', 734.20)">Close</button>
                        </td>
                    </tr>
                    <tr id="pos-row-2">
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-brands fa-ethereum text-primary f-16"></i>
                                <div>
                                    <strong class="text-dark">ETH / USDT</strong>
                                    <span class="badge bg-danger bg-opacity-10 text-danger ms-1 f-9">SHORT</span>
                                </div>
                            </div>
                        </td>
                        <td>Limit</td>
                        <td>$3,450.00</td>
                        <td>$3,420.50</td>
                        <td>$2,500.00 (5x)</td>
                        <td class="text-success f-w-700">+$213.70 (+8.55%)</td>
                        <td><span class="badge bg-success rounded-pill f-10">Running</span></td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-xs btn-outline-danger rounded-pill py-1 px-2 f-10" onclick="closePosition('pos-row-2', 213.70)">Close</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var currentDemoTab = 'buy';
    var demoBalance = {{ $demoBalance ?? 88140.00 }};

    function setDemoTab(type) {
        currentDemoTab = type;
        var buyBtn = document.getElementById('demoBtnBuy');
        var sellBtn = document.getElementById('demoBtnSell');
        var submitBtn = document.getElementById('btnDemoSubmit');

        if (type === 'buy') {
            buyBtn.className = 'btn btn-success py-2 f-12 f-w-700';
            sellBtn.className = 'btn btn-outline-danger py-2 f-12 f-w-700';
            submitBtn.className = 'btn btn-success w-100 py-2 f-13 f-w-700 shadow-sm';
            submitBtn.innerHTML = '<i class="fa-solid fa-arrow-up me-1"></i> Place Demo BUY Order';
        } else {
            sellBtn.className = 'btn btn-danger py-2 f-12 f-w-700';
            buyBtn.className = 'btn btn-outline-success py-2 f-12 f-w-700';
            submitBtn.className = 'btn btn-danger w-100 py-2 f-13 f-w-700 shadow-sm';
            submitBtn.innerHTML = '<i class="fa-solid fa-arrow-down me-1"></i> Place Demo SELL Order';
        }
    }

    function setOrderType(type) {
        var mBtn = document.getElementById('btnMarketOrder');
        var lBtn = document.getElementById('btnLimitOrder');
        if (type === 'market') {
            mBtn.className = 'btn btn-sm btn-primary flex-fill f-11';
            lBtn.className = 'btn btn-sm btn-outline-secondary flex-fill f-11';
        } else {
            lBtn.className = 'btn btn-sm btn-primary flex-fill f-11';
            mBtn.className = 'btn btn-sm btn-outline-secondary flex-fill f-11';
        }
    }

    function setDemoMax() {
        document.getElementById('demoAmount').value = demoBalance.toFixed(2);
    }

    function setDemoPercent(pct) {
        var amt = (demoBalance * pct).toFixed(2);
        document.getElementById('demoAmount').value = amt;
    }

    function resetDemoBalance() {
        demoBalance = 100000.00;
        document.getElementById('demoBalanceDisplay').innerText = '$' + demoBalance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        if (window.toastr) {
            toastr.success('Virtual demo capital reset to $100,000.00');
        } else {
            alert('Virtual demo capital reset to $100,000.00');
        }
    }

    function handleDemoOrder(e) {
        e.preventDefault();
        var amt = parseFloat(document.getElementById('demoAmount').value) || 0;
        if (amt > demoBalance) {
            if (window.toastr) toastr.error('Order amount exceeds virtual demo balance!');
            else alert('Order amount exceeds virtual demo balance!');
            return;
        }

        demoBalance -= amt;
        document.getElementById('demoBalanceDisplay').innerText = '$' + demoBalance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});

        var pair = document.getElementById('demoPair').value;
        var lev = document.getElementById('demoLeverage').value;
        var side = currentDemoTab.toUpperCase();

        var newRowId = 'pos-row-' + Date.now();
        var tr = document.createElement('tr');
        tr.id = newRowId;
        tr.innerHTML = `
            <td class="ps-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-coins text-warning f-16"></i>
                    <div>
                        <strong class="text-dark">${pair}</strong>
                        <span class="badge ${side === 'BUY' ? 'bg-success' : 'bg-danger'} bg-opacity-10 ${side === 'BUY' ? 'text-success' : 'text-danger'} ms-1 f-9">${side === 'BUY' ? 'LONG' : 'SHORT'}</span>
                    </div>
                </div>
            </td>
            <td>Market</td>
            <td>$110,012.00</td>
            <td>$110,012.00</td>
            <td>$${amt.toLocaleString('en-US', {minimumFractionDigits: 2})} (${lev}x)</td>
            <td class="text-success f-w-700">+$0.00 (0.00%)</td>
            <td><span class="badge bg-success rounded-pill f-10">Running</span></td>
            <td class="text-end pe-3">
                <button type="button" class="btn btn-xs btn-outline-danger rounded-pill py-1 px-2 f-10" onclick="closePosition('${newRowId}', 0)">Close</button>
            </td>
        `;
        document.getElementById('demoPositionsBody').prepend(tr);

        if (window.toastr) {
            toastr.success(`Simulated ${side} order of $${amt.toLocaleString()} on ${pair} executed successfully!`);
        } else {
            alert(`Simulated ${side} order executed!`);
        }
    }

    function closePosition(rowId, profit) {
        var row = document.getElementById(rowId);
        if (row) {
            row.remove();
            demoBalance += profit;
            document.getElementById('demoBalanceDisplay').innerText = '$' + demoBalance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            if (window.toastr) toastr.info('Position closed successfully.');
        }
    }

    function closeAllPositions() {
        document.getElementById('demoPositionsBody').innerHTML = '<tr><td colspan="8" class="text-center py-4 text-muted">No open simulated positions.</td></tr>';
        if (window.toastr) toastr.info('All open simulated positions closed.');
    }
</script>
@endsection
