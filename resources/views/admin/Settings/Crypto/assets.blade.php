@php
    $cryptoList = [
        ['name' => 'Bitcoin', 'symbol' => 'BTC', 'key' => 'btc', 'icon' => 'fab fa-bitcoin', 'color' => '#f7931a'],
        ['name' => 'Ethereum', 'symbol' => 'ETH', 'key' => 'eth', 'icon' => 'fab fa-ethereum', 'color' => '#627eea'],
        ['name' => 'Litecoin', 'symbol' => 'LTC', 'key' => 'ltc', 'icon' => 'fa fa-coins', 'color' => '#345d9d'],
        ['name' => 'Chainlink', 'symbol' => 'LINK', 'key' => 'link', 'icon' => 'fa fa-link', 'color' => '#375bd2'],
        ['name' => 'Binance Coin', 'symbol' => 'BNB', 'key' => 'bnb', 'icon' => 'fa fa-coins', 'color' => '#f3ba2f'],
        ['name' => 'Aave', 'symbol' => 'AAVE', 'key' => 'aave', 'icon' => 'fa fa-ghost', 'color' => '#b6509e'],
        ['name' => 'Tether', 'symbol' => 'USDT', 'key' => 'usdt', 'icon' => 'fa fa-dollar-sign', 'color' => '#26a17b'],
        ['name' => 'Bitcoin Cash', 'symbol' => 'BCH', 'key' => 'bch', 'icon' => 'fab fa-btc', 'color' => '#8dc351'],
        ['name' => 'Ripple', 'symbol' => 'XRP', 'key' => 'xrp', 'icon' => 'fa fa-water', 'color' => '#23292f'],
        ['name' => 'Stellar', 'symbol' => 'XLM', 'key' => 'xlm', 'icon' => 'fa fa-rocket', 'color' => '#14b6eb'],
        ['name' => 'Cardano', 'symbol' => 'ADA', 'key' => 'ada', 'icon' => 'fa fa-circle-nodes', 'color' => '#0033ad'],
    ];
@endphp

@foreach ($cryptoList as $c)
    @php
        $statusKey = $c['key'];
        $isEnabled = ($moresettings->$statusKey == 'enabled');
    @endphp
    <tr>
        <td>
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 28px; height: 28px; background-color: {{ $c['color'] }}; font-size: 13px;">
                    <i class="{{ $c['icon'] }}"></i>
                </div>
                <span class="f-w-600">{{ $c['name'] }}</span>
            </div>
        </td>
        <td>
            <span class="badge bg-light text-dark rounded-pill px-2 py-1 f-12 border">{{ $c['symbol'] }}</span>
        </td>
        <td>
            @if ($isEnabled)
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
            @if ($isEnabled)
                <a href="{{ route('setassetstatus', ['asset' => $c['key'], 'status' => 'disabled']) }}" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                    <i class="fa fa-ban me-1"></i> Disable
                </a>
            @else
                <a href="{{ route('setassetstatus', ['asset' => $c['key'], 'status' => 'enabled']) }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
                    <i class="fa fa-check me-1"></i> Enable
                </a>
            @endif
        </td>
    </tr>
@endforeach