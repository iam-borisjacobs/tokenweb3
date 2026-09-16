<div class="security-card">
    <div class="security-card-header">
        <div class="d-flex align-items-center gap-3">
            <div class="security-card-icon metric-icon-circle info">
                <i class="fa-solid fa-laptop-code"></i>
            </div>
            <div>
                <h5 class="security-card-title text-dark mb-0">{{ __('Active Browser Sessions') }}</h5>
                <div class="text-muted small">{{ __('Manage and terminate your authenticated sessions on other devices.') }}</div>
            </div>
        </div>
        <div>
            <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3 py-2">
                <i class="fa-solid fa-globe me-1"></i> {{ count($this->sessions) }} {{ __('Session(s)') }}
            </span>
        </div>
    </div>

    <div class="security-card-desc mb-4">
        <p class="mb-0">
            {{ __('If necessary, you may log out of all your active browser sessions across other computers, tablets, or phones. Your current active device will remain authenticated. If you suspect unauthorized access, we recommend changing your password as well.') }}
        </p>
    </div>

    @if (count($this->sessions) > 0)
        <div class="mb-4">
            @foreach ($this->sessions as $session)
                <div class="session-device-row d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="metric-icon-circle {{ $session->agent->isDesktop() ? 'primary' : 'info' }}" style="width: 44px; height: 44px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; font-size: 18px;">
                            @if ($session->agent->isDesktop())
                                <i class="fa-solid fa-desktop"></i>
                            @else
                                <i class="fa-solid fa-mobile-screen"></i>
                            @endif
                        </div>
                        <div>
                            <div class="fw-bold text-dark" style="font-size: 14.5px;">
                                {{ $session->agent->platform() ? $session->agent->platform() : 'Unknown OS' }} — {{ $session->agent->browser() ? $session->agent->browser() : 'Browser' }}
                            </div>
                            <div class="text-muted small font-monospace">
                                <i class="fa-solid fa-network-wired me-1"></i> {{ $session->ip_address }}
                            </div>
                        </div>
                    </div>

                    <div>
                        @if ($session->is_current_device)
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2">
                                <i class="fa-solid fa-circle-dot text-success me-1"></i> {{ __('This Device') }}
                            </span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3 py-2">
                                <i class="fa-regular fa-clock me-1"></i> {{ __('Last active') }} {{ $session->last_active }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="d-flex align-items-center flex-wrap gap-3 pt-2">
        <button type="button" class="btn btn-outline-danger rounded-pill px-4 py-2 fw-semibold" wire:click="confirmLogout" wire:loading.attr="disabled">
            <i class="fa-solid fa-right-from-bracket me-2"></i> {{ __('Log Out Other Browser Sessions') }}
        </button>

        <x-jet-action-message class="text-success fw-semibold" on="loggedOut">
            <i class="fa-solid fa-circle-check me-1"></i> {{ __('Done. Logged out of other sessions.') }}
        </x-jet-action-message>
    </div>

    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="confirmingLogout">
        <x-slot name="title">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-shield-halved text-primary me-2"></i> {{ __('Confirm Log Out of Other Sessions') }}
            </h5>
        </x-slot>

        <x-slot name="content">
            <p class="text-muted small mb-3">
                {{ __('Please enter your account password to confirm that you would like to log out of all other active browser sessions across your devices.') }}
            </p>

            <div class="mt-3" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <x-jet-input type="password" class="form-control form-control-custom"
                                placeholder="{{ __('Enter your account password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />
                </div>
                <x-jet-input-error for="password" class="mt-2 text-danger small" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="d-flex align-items-center justify-content-end gap-2 w-100">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-3 py-2 fw-semibold" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </button>

                <button type="button" class="btn btn-danger rounded-pill px-4 py-2 fw-semibold text-white" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> {{ __('Log Out Sessions') }}
                </button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
