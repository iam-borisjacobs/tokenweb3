@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('signals') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 f-12">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Signals
                </a>
            </div>
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-sliders text-primary me-2"></i> Trade Signal Configuration
            </h3>
            <p class="text-muted mb-0 f-13">Configure subscriber pricing tiers and automated Telegram broadcast integration.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <a href="{{ route('subscribers') }}" class="btn btn-light rounded-pill px-3 py-2 f-13 f-w-600 shadow-sm">
                <i class="fa-solid fa-users me-1"></i> View Subscribers
            </a>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 col-xl-7">
            <div class="card p-4 p-md-5 shadow-sm border-0 rounded-3">
                <div class="d-flex align-items-center gap-3 pb-3 mb-4 border-bottom">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 18px;">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                    <div>
                        <h5 class="f-w-700 text-dark mb-0">Subscription Fees & Telegram Bot</h5>
                        <small class="text-muted">Pricing plans and API credentials</small>
                    </div>
                </div>

                <form action="{{ route('save.settings') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-13">Monthly Fee ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" value="{{ $signalSettings->signal_monthly_fee }}" name="monthly" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-13">Quarterly Fee ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" value="{{ $signalSettings->signal_quartly_fee }}" name="quaterly" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label f-w-600 f-13">Yearly Fee ({{ $settings->currency }}) <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" value="{{ $signalSettings->signal_yearly_fee }}" name="yearly" required>
                        </div>

                        <!-- Telegram Section Divider -->
                        <div class="col-12 pt-3">
                            <div class="d-flex align-items-center gap-2 pb-2 border-bottom">
                                <i class="fa-brands fa-telegram text-info f-18"></i>
                                <h6 class="f-w-700 text-dark mb-0">Telegram Channel Broadcast Integration</h6>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <label class="form-label f-w-600 f-13 mb-0">Telegram Channel Chat ID</label>
                                @if (empty($signalSettings->chat_id))
                                    <a href="{{ route('chat.id') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-0 f-11">
                                        <i class="fa-solid fa-download me-1"></i> Retrieve Chat ID
                                    </a>
                                @else
                                    <a href="{{ route('delete.id') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-0 f-11" onclick="return confirm('Disconnect this Telegram Chat ID?');">
                                        <i class="fa-solid fa-trash-can me-1"></i> Disconnect Chat ID
                                    </a>
                                @endif
                            </div>
                            <input type="text" value="{{ $signalSettings->chat_id }}" class="form-control font-monospace" name="chat_id" readonly placeholder="Auto-retrieved from bot webhook">
                            @if (empty($signalSettings->chat_id))
                                <small class="text-muted f-11 mt-1 d-block">
                                    <i class="fa-solid fa-circle-info text-info me-1"></i> Ensure your bot has been added as an admin to your private channel and sent at least one message before retrieving.
                                </small>
                            @endif
                        </div>

                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Telegram Bot API Token</label>
                            <input type="text" value="{{ $signalSettings->telegram_bot_api }}" class="form-control font-monospace" name="telegram_bot_api" placeholder="e.g. 123456789:ABCdefGhIJKlmNoPQRsTUVwxyZ">
                            <small class="text-muted f-11 mt-1 d-block">
                                Create a bot using <a href="https://t.me/BotFather" target="_blank" class="text-primary f-w-600">@BotFather</a> on Telegram to obtain an API token.
                            </small>
                        </div>

                        <div class="col-12 pt-3 text-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Save Signal Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
