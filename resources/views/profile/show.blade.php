
@extends('layouts.dash')
@section('title', $title ?? 'Security Settings')
@section('content')
    <!-- Page Header -->
    <div class="mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h4 class="mb-1 text-dark fw-bold" style="font-size: 22px;">{{ __('Security & Account Controls') }}</h4>
                <p class="text-muted mb-0 small">{{ __('Manage two-factor authentication, monitor device sessions, and handle account deletion.') }}</p>
            </div>
            <a href="{{ route('profile') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 small fw-semibold">
                <i class="fa-solid fa-arrow-left me-1"></i> {{ __('Back to Account Settings') }}
            </a>
        </div>
    </div>

    <x-danger-alert/>
    <x-success-alert/>

    <div class="row">
        <div class="col-12 col-xl-10 mx-auto">
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                @livewire('profile.two-factor-authentication-form')
            @endif

            @livewire('profile.logout-other-browser-sessions-form')

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                @livewire('profile.delete-user-form')
            @endif
        </div>
    </div>
@endsection
