<div class="security-card">
    <div class="security-card-header">
        <div class="d-flex align-items-center gap-3">
            <div class="security-card-icon metric-icon-circle primary">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
                <h5 class="security-card-title text-dark mb-0">{{ __('Two Factor Authentication') }}</h5>
                <div class="text-muted small">{{ __('Add an extra layer of security using Google Authenticator or another TOTP app.') }}</div>
            </div>
        </div>
        <div>
            @if ($this->enabled)
                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2">
                    <i class="fa-solid fa-circle-check me-1"></i> {{ __('Enabled & Protected') }}
                </span>
            @else
                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> {{ __('Not Enabled') }}
                </span>
            @endif
        </div>
    </div>

    <div class="security-card-desc mb-3">
        <p class="mb-2">
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>
    </div>

    @if ($this->enabled)
        @if ($showingQrCode)
            <div class="p-3 mb-4 rounded-3 border bg-light-subtle">
                <p class="fw-semibold text-dark mb-2">
                    <i class="fa-solid fa-qrcode me-1"></i> {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application:') }}
                </p>
                <div class="d-inline-block p-3 bg-white rounded-3 shadow-sm my-2">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            </div>
        @endif

        @if ($showingRecoveryCodes)
            <div class="p-3 mb-4 rounded-3 border bg-light-subtle">
                <p class="fw-semibold text-dark mb-2">
                    <i class="fa-solid fa-key me-1"></i> {{ __('Store these recovery codes in a secure password manager:') }}
                </p>
                <p class="text-muted small mb-2">
                    {{ __('They can be used to recover access to your account if your two factor authentication device is lost.') }}
                </p>
                <div class="p-3 bg-dark text-light rounded-3 font-monospace small" style="letter-spacing: 1px;">
                    <div class="row g-2">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div class="col-6 col-sm-4 col-md-3">{{ $code }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif

    <div class="pt-2 d-flex align-items-center flex-wrap gap-2">
        @if (! $this->enabled)
            <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                <x-jet-button type="button" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold text-white" wire:loading.attr="disabled">
                    <i class="fa-solid fa-shield-halved me-1"></i> {{ __('Enable Two-Factor Authentication') }}
                </x-jet-button>
            </x-jet-confirms-password>
        @else
            @if ($showingRecoveryCodes)
                <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                    <x-jet-secondary-button class="btn btn-outline-info rounded-pill px-3 py-2 fw-semibold">
                        <i class="fa-solid fa-arrows-rotate me-1"></i> {{ __('Regenerate Recovery Codes') }}
                    </x-jet-secondary-button>
                </x-jet-confirms-password>
            @else
                <x-jet-confirms-password wire:then="showRecoveryCodes">
                    <x-jet-secondary-button class="btn btn-outline-secondary rounded-pill px-3 py-2 fw-semibold">
                        <i class="fa-solid fa-eye me-1"></i> {{ __('Show Recovery Codes') }}
                    </x-jet-secondary-button>
                </x-jet-confirms-password>
            @endif

            <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                <x-jet-danger-button wire:loading.attr="disabled" class="btn btn-outline-danger rounded-pill px-3 py-2 fw-semibold">
                    <i class="fa-solid fa-lock-open me-1"></i> {{ __('Disable 2FA') }}
                </x-jet-danger-button>
            </x-jet-confirms-password>
        @endif
    </div>
</div>