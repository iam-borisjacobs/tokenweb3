
<div class="security-card danger-zone">
    <div class="security-card-header">
        <div class="d-flex align-items-center gap-3">
            <div class="security-card-icon" style="background: rgba(239, 68, 68, 0.12); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.25);">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h5 class="security-card-title text-danger mb-0">{{ __('Danger Zone: Delete Account') }}</h5>
                <div class="text-muted small">{{ __('Permanently remove your account and all associated records.') }}</div>
            </div>
        </div>
        <div>
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-2">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> {{ __('Irreversible Action') }}
            </span>
        </div>
    </div>

    <div class="security-card-desc mb-4">
        <p class="text-muted small mb-0">
            {{ __('Once your account is deleted, all of its portfolio records, investment history, wallet balances, and user data will be permanently purged from our servers. Before deleting your account, please ensure you have downloaded any transaction records or account statements you may require.') }}
        </p>
    </div>

    <div class="pt-2">
        <button type="button" class="btn btn-danger rounded-pill px-4 py-2 fw-semibold" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
            <i class="fa-solid fa-trash-can me-2"></i> {{ __('Delete Account') }}
        </button>
    </div>

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            <h5 class="fw-bold mb-0 text-danger">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ __('Permanently Delete Account') }}
            </h5>
        </x-slot>

        <x-slot name="content">
            <p class="text-muted small mb-3">
                {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to proceed.') }}
            </p>

            <div class="mt-3" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <x-jet-input type="password" class="form-control form-control-custom"
                                placeholder="{{ __('Enter your account password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />
                </div>
                <x-jet-input-error for="password" class="mt-2 text-danger small" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="d-flex align-items-center justify-content-end gap-2 w-100">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-3 py-2 fw-semibold" wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </button>

                <button type="button" class="btn btn-danger rounded-pill px-4 py-2 fw-semibold text-white" wire:click="deleteUser" wire:loading.attr="disabled">
                    <i class="fa-solid fa-trash-can me-1"></i> {{ __('Permanently Delete') }}
                </button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
