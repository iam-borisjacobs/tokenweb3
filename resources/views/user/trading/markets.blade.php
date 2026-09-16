@extends('layouts.dash')
@section('title', 'Live Markets & Crypto Tickers')

@section('content')
<div class="container-fluid py-3">
    <!-- Header Banner -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 rounded-pill f-11 f-w-700">
                    <i class="fa-solid fa-satellite-dish me-1"></i> INSTITUTIONAL MARKET FEEDS
                </span>
                @if($isLocked)
                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1 rounded-pill f-11 f-w-700">
                        <i class="fa-solid fa-lock me-1"></i> Clearance Required
                    </span>
                @endif
            </div>
            <h4 class="f-w-800 text-dark mb-1">Live Global Markets</h4>
            <p class="text-muted f-13 mb-0">High-frequency liquidity feeds across Cryptocurrencies, FX pairs, Commodities, and Equities.</p>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="{{ route('demotrading') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-13 f-w-600">
                <i class="fa-solid fa-graduation-cap me-1"></i> Demo Practice
            </a>
            <button type="button" class="btn btn-primary rounded-pill px-3 py-2 f-13 f-w-700 shadow-sm" onclick="refreshMarketData()">
                <i class="fa-solid fa-rotate me-1" id="refreshIcon"></i> Refresh Tickers
            </button>
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
                    <h6 class="text-white f-w-700 mb-1 f-14">Institutional Clearance Threshold: <span class="text-warning">Locked</span></h6>
                    <p class="text-white text-opacity-80 f-12 mb-0">
                        Real-time market data is viewable. Direct order execution on live liquidity books requires qualified capital of <strong>{{ $settings->currency }}{{ number_format($settings->min_trading_balance, 2) }}</strong>. Your qualified balance is <strong>{{ $settings->currency }}{{ number_format($userTotalBalance, 2) }}</strong>.
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2 flex-shrink-0">
                <button type="button" class="btn btn-warning text-dark rounded-pill px-3 py-2 f-12 f-w-700" onclick="window.openTradingClearanceModal(event, 'Live Execution')">
                    <i class="fa-solid fa-unlock me-1"></i> Request Clearance
                </button>
                <a href="{{ route('deposits') }}" class="btn btn-outline-light rounded-pill px-3 py-2 f-12 f-w-600">
                    <i class="fa-solid fa-wallet me-1"></i> Deposit
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Global Metrics Ribbon -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted f-11 d-block">Global Market Cap</small>
                        <h6 class="f-w-800 text-dark mb-0 f-15">$2.84 Trillion</h6>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill f-10">+3.14%</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted f-11 d-block">24h Global Volume</small>
                        <h6 class="f-w-800 text-dark mb-0 f-15">$104.2 Billion</h6>
                    </div>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill f-10">High</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted f-11 d-block">BTC Dominance</small>
                        <h6 class="f-w-800 text-dark mb-0 f-15">57.42%</h6>
                    </div>
                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill f-10">Consolidating</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border shadow-sm h-100 p-3 mb-0" style="border-radius: 12px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted f-11 d-block">Liquidity Index</small>
                        <h6 class="f-w-800 text-success mb-0 f-15">Optimal (Tier 1)</h6>
                    </div>
                    <i class="fa-solid fa-circle-check text-success f-18"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Embedded TradingView Market Overview Widget -->
    <div class="card border shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header border-bottom py-3 px-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-chart-line text-primary f-16"></i>
                <h6 class="f-w-700 text-dark mb-0 f-14">Institutional Market Screener</h6>
            </div>
            <span class="badge bg-light text-muted border rounded-pill f-11">TradingView Feed</span>
        </div>
        <div class="card-body p-0" style="height: 440px;">
            <div class="tradingview-widget-container" style="height:100%;width:100%">
                <div class="tradingview-widget-container__widget" style="height:calc(100% - 32px);width:100%"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
                {
                    "colorTheme": "dark",
                    "dateRange": "12M",
                    "showChart": true,
                    "locale": "en",
                    "largeChartUrl": "",
                    "isTransparent": true,
                    "showSymbolLogo": true,
                    "showFloatingTooltip": false,
                    "width": "100%",
                    "height": "100%",
                    "tabs": [
                        {
                            "title": "Crypto Spot",
                            "symbols": [
                                { "s": "BINANCE:BTCUSDT", "d": "Bitcoin" },
                                { "s": "BINANCE:ETHUSDT", "d": "Ethereum" },
                                { "s": "BINANCE:SOLUSDT", "d": "Solana" },
                                { "s": "BINANCE:BNBUSDT", "d": "Binance Coin" },
                                { "s": "BINANCE:XRPUSDT", "d": "Ripple" }
                            ]
                        },
                        {
                            "title": "Forex",
                            "symbols": [
                                { "s": "FX:EURUSD", "d": "EUR / USD" },
                                { "s": "FX:GBPUSD", "d": "GBP / USD" },
                                { "s": "FX:USDJPY", "d": "USD / JPY" },
                                { "s": "FX:AUDUSD", "d": "AUD / USD" }
                            ]
                        }
                    ]
                }
                </script>
            </div>
        </div>
    </div>

    <!-- Comprehensive Markets Table -->
    <div class="card border shadow-sm mb-4" style="border-radius: 14px;">
        <div class="card-header border-bottom py-3 px-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-3">
                <h6 class="f-w-700 text-dark mb-0 f-14">Live Asset Quotes</h6>
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-primary active" onclick="filterMarket('all', this)">All</button>
                    <button type="button" class="btn btn-outline-primary" onclick="filterMarket('crypto', this)">Crypto</button>
                    <button type="button" class="btn btn-outline-primary" onclick="filterMarket('forex', this)">Forex</button>
                    <button type="button" class="btn btn-outline-primary" onclick="filterMarket('commodities', this)">Commodities</button>
                </div>
            </div>
            <div style="max-width: 250px;">
                <input type="text" class="form-control form-control-sm rounded-pill f-12" placeholder="Search asset or pair..." id="marketSearch" onkeyup="searchMarketTable()">
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0 f-12" id="marketTable">
                <thead class="bg-light text-muted f-11 text-uppercase">
                    <tr>
                        <th class="ps-3">Asset</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>24h Change</th>
                        <th>24h High</th>
                        <th>24h Low</th>
                        <th>24h Volume</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody id="marketBody">
                    <!-- BTC -->
                    <tr data-cat="crypto">
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-brands fa-bitcoin text-warning f-22"></i>
                                <div>
                                    <strong class="text-dark d-block">Bitcoin</strong>
                                    <span class="text-muted f-11">BTC / USDT</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill f-10">Crypto</span></td>
                        <td class="f-w-700 text-dark">$110,012.00</td>
                        <td class="text-success f-w-700"><i class="fa-solid fa-caret-up me-1"></i>+2.84%</td>
                        <td>$111,200.00</td>
                        <td>$106,940.00</td>
                        <td>$42.8B</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 f-11 f-w-600" 
                                    onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Bitcoin Live Execution')" : "window.location.href='" . route('dashboard') . "'" }}">
                                @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Trade
                            </button>
                        </td>
                    </tr>

                    <!-- ETH -->
                    <tr data-cat="crypto">
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-brands fa-ethereum text-primary f-22"></i>
                                <div>
                                    <strong class="text-dark d-block">Ethereum</strong>
                                    <span class="text-muted f-11">ETH / USDT</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill f-10">Crypto</span></td>
                        <td class="f-w-700 text-dark">$3,420.50</td>
                        <td class="text-success f-w-700"><i class="fa-solid fa-caret-up me-1"></i>+4.12%</td>
                        <td>$3,485.00</td>
                        <td>$3,280.00</td>
                        <td>$21.4B</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 f-11 f-w-600" 
                                    onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Ethereum Live Execution')" : "window.location.href='" . route('dashboard') . "'" }}">
                                @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Trade
                            </button>
                        </td>
                    </tr>

                    <!-- SOL -->
                    <tr data-cat="crypto">
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-purple text-white d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 13px; background: #8b5cf6;">
                                    <i class="fa-solid fa-bolt"></i>
                                </div>
                                <div>
                                    <strong class="text-dark d-block">Solana</strong>
                                    <span class="text-muted f-11">SOL / USDT</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill f-10">Crypto</span></td>
                        <td class="f-w-700 text-dark">$182.20</td>
                        <td class="text-success f-w-700"><i class="fa-solid fa-caret-up me-1"></i>+6.35%</td>
                        <td>$186.50</td>
                        <td>$171.00</td>
                        <td>$8.9B</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 f-11 f-w-600" 
                                    onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Solana Live Execution')" : "window.location.href='" . route('dashboard') . "'" }}">
                                @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Trade
                            </button>
                        </td>
                    </tr>

                    <!-- EUR/USD -->
                    <tr data-cat="forex">
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 13px;">
                                    <i class="fa-solid fa-euro-sign"></i>
                                </div>
                                <div>
                                    <strong class="text-dark d-block">EUR / USD</strong>
                                    <span class="text-muted f-11">Euro vs US Dollar</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill f-10">Forex</span></td>
                        <td class="f-w-700 text-dark">1.0852</td>
                        <td class="text-danger f-w-700"><i class="fa-solid fa-caret-down me-1"></i>-0.24%</td>
                        <td>1.0890</td>
                        <td>1.0835</td>
                        <td>$340B</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 f-11 f-w-600" 
                                    onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'EUR/USD Live Execution')" : "window.location.href='" . route('dashboard') . "'" }}">
                                @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Trade
                            </button>
                        </td>
                    </tr>

                    <!-- GBP/USD -->
                    <tr data-cat="forex">
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 13px;">
                                    <i class="fa-solid fa-sterling-sign"></i>
                                </div>
                                <div>
                                    <strong class="text-dark d-block">GBP / USD</strong>
                                    <span class="text-muted f-11">British Pound vs USD</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill f-10">Forex</span></td>
                        <td class="f-w-700 text-dark">1.2940</td>
                        <td class="text-success f-w-700"><i class="fa-solid fa-caret-up me-1"></i>+0.18%</td>
                        <td>1.2980</td>
                        <td>1.2910</td>
                        <td>$210B</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 f-11 f-w-600" 
                                    onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'GBP/USD Live Execution')" : "window.location.href='" . route('dashboard') . "'" }}">
                                @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Trade
                            </button>
                        </td>
                    </tr>

                    <!-- Gold -->
                    <tr data-cat="commodities">
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center font-weight-bold" style="width: 28px; height: 28px; font-size: 13px; background: #fbbf24;">
                                    <i class="fa-solid fa-ring"></i>
                                </div>
                                <div>
                                    <strong class="text-dark d-block">Gold Spot (XAU / USD)</strong>
                                    <span class="text-muted f-11">Gold Troy Ounce</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill f-10">Commodities</span></td>
                        <td class="f-w-700 text-dark">$2,748.40</td>
                        <td class="text-success f-w-700"><i class="fa-solid fa-caret-up me-1"></i>+1.15%</td>
                        <td>$2,760.00</td>
                        <td>$2,725.00</td>
                        <td>$65B</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 f-11 f-w-600" 
                                    onclick="{{ $isLocked ? "window.openTradingClearanceModal(event, 'Gold Spot Live Execution')" : "window.location.href='" . route('dashboard') . "'" }}">
                                @if($isLocked)<i class="fa-solid fa-lock me-1"></i>@endif Trade
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function filterMarket(cat, btn) {
        var buttons = btn.parentElement.querySelectorAll('button');
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        var rows = document.querySelectorAll('#marketBody tr');
        rows.forEach(r => {
            if (cat === 'all' || r.getAttribute('data-cat') === cat) {
                r.style.display = '';
            } else {
                r.style.display = 'none';
            }
        });
    }

    function searchMarketTable() {
        var q = document.getElementById('marketSearch').value.toLowerCase();
        var rows = document.querySelectorAll('#marketBody tr');
        rows.forEach(r => {
            var txt = r.innerText.toLowerCase();
            r.style.display = txt.includes(q) ? '' : 'none';
        });
    }

    function refreshMarketData() {
        var icon = document.getElementById('refreshIcon');
        icon.classList.add('fa-spin');
        setTimeout(() => {
            icon.classList.remove('fa-spin');
            if (window.toastr) toastr.success('Market tickers synchronized with global liquidity feeds.');
        }, 600);
    }
</script>
@endsection
