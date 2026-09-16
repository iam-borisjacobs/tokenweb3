@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-circle-info text-primary me-2"></i> About System & Platform
            </h3>
            <p class="text-muted mb-0 f-13">System architecture, release version, and documentation resources.</p>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 col-xl-6">
            <div class="card p-5 text-center shadow-sm border-0 rounded-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 72px; height: 72px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 32px;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3 class="f-w-800 text-dark mb-1">{{ $settings->site_name }}</h3>
                <p class="text-muted f-14 mb-4">Enterprise Multi-Asset Trading & Investment Management Platform</p>

                <div class="d-inline-flex align-items-center justify-content-center gap-2 mb-4 mx-auto">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 f-12 f-w-600">
                        <i class="fa-solid fa-code-branch me-1"></i> Core Engine: v5.2 (Admiro Edition)
                    </span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 f-12 f-w-600">
                        <i class="fa-solid fa-check me-1"></i> Up to date
                    </span>
                </div>

                <div class="p-3 bg-light rounded-3 mb-4 text-start f-13 text-muted">
                    <div class="d-flex justify-content-between py-1 border-bottom">
                        <span>Environment:</span>
                        <strong class="text-dark">{{ app()->environment() }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-1 border-bottom">
                        <span>PHP Version:</span>
                        <strong class="text-dark">{{ PHP_VERSION }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>Laravel Framework:</span>
                        <strong class="text-dark">{{ app()->version() }}</strong>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('adminprofile') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm">
                        <i class="fa-solid fa-user-gear me-1"></i> Admin Account Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
