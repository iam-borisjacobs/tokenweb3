@extends('layouts.app')

@section('styles')
    @parent
    <style>
        .proof-viewer-wrapper {
            background: #0f172a;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            position: relative;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .proof-image-element {
            max-height: 600px;
            width: auto;
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            transition: transform 0.2s ease;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('mdeposits') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 f-12">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Deposits
                </a>
                @if($deposit->status == 'Processed')
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill f-12 f-w-600">
                        <i class="fa-solid fa-circle-check me-1"></i> Confirmed & Credited
                    </span>
                @else
                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1 rounded-pill f-12 f-w-600">
                        <i class="fa-solid fa-clock me-1"></i> Pending Verification
                    </span>
                @endif
            </div>
            <h3 class="f-w-800 text-dark mb-1">Verify Deposit Proof</h3>
            <p class="text-muted mb-0 f-13">Inspect transaction receipt screenshot, verify amount and credit account.</p>
        </div>

        <div class="col-md-auto d-flex align-items-center gap-2">
            @php
                $user = $deposit->duser ?? \App\Models\User::find($deposit->user);
            @endphp
            @if($user)
                <a href="{{ route('viewuser', $user->id) }}" class="btn btn-light rounded-pill px-3 py-2 f-12 f-w-600 shadow-sm">
                    <i class="fa-solid fa-user me-1 text-primary"></i> View User Profile
                </a>
            @endif
        </div>
    </div>

    @php
        $proofUrl = asset('storage/app/public/' . $deposit->proof);
    @endphp

    <div class="row g-4 mb-5">
        <!-- Left Column: Transaction Metadata & Actions -->
        <div class="col-lg-4 col-xl-4">
            <div class="card p-4 shadow-sm border-0 rounded-3 mb-4">
                <div class="d-flex align-items-center gap-3 pb-3 mb-3 border-bottom">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 18px; font-weight: 700;">
                        {{ strtoupper(substr($user->name ?? 'User', 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="f-w-700 text-dark mb-0">{{ $user->name ?? 'User #' . $deposit->user }}</h6>
                        <small class="text-muted">{{ $user->email ?? 'N/A' }}</small>
                    </div>
                </div>

                <div class="d-flex flex-column gap-3">
                    <div class="p-3 bg-light rounded-3">
                        <span class="text-muted f-11 f-w-600 text-uppercase d-block mb-1">Deposit Amount</span>
                        <h3 class="f-w-800 text-primary mb-0">{{ $settings->currency }}{{ number_format($deposit->amount, 2) }}</h3>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted f-13">Payment Mode:</span>
                        <span class="f-w-700 text-dark f-13">{{ $deposit->payment_mode }}</span>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted f-13">Transaction ID:</span>
                        <span class="f-w-700 font-monospace text-dark f-13">#DEP-{{ $deposit->id }}</span>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted f-13">Date Submitted:</span>
                        <span class="f-w-600 text-dark f-12">{{ $deposit->created_at ? $deposit->created_at->format('M d, Y • h:i A') : 'N/A' }}</span>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted f-13">Current Status:</span>
                        <div>
                            @if ($deposit->status == 'Processed')
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11">
                                    Processed
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 f-11">
                                    {{ $deposit->status ?? 'Pending' }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 pt-2 d-flex flex-column gap-2">
                    @if ($deposit->status != 'Processed')
                        <a href="{{ route('pdeposit', $deposit->id) }}" class="btn btn-primary rounded-pill py-2 f-13 f-w-700 shadow-sm text-center" onclick="return confirm('Are you sure you want to approve and credit this deposit of {{ $settings->currency }}{{ number_format($deposit->amount, 2) }}?');">
                            <i class="fa-solid fa-circle-check me-1"></i> Confirm & Credit Deposit
                        </a>
                    @endif

                    <a href="{{ route('deldeposit', $deposit->id) }}" class="btn btn-outline-danger rounded-pill py-2 f-13 f-w-600 text-center" onclick="return confirm('Are you sure you want to delete this deposit record and screenshot?');">
                        <i class="fa-solid fa-trash-can me-1"></i> Delete Deposit
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column: Full Proof Viewer -->
        <div class="col-lg-8 col-xl-8">
            <div class="card p-4 shadow-sm border-0 rounded-3">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 pb-3 mb-3 border-bottom">
                    <h5 class="f-w-700 text-dark mb-0">
                        <i class="fa-solid fa-image text-primary me-2"></i> Payment Receipt Screenshot
                    </h5>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ $proofUrl }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1 f-12" title="Open original screenshot in new browser tab">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Open Full View
                        </a>
                        <a href="{{ $proofUrl }}" download class="btn btn-light btn-sm rounded-pill px-3 py-1 f-12" title="Download screenshot">
                            <i class="fa-solid fa-download me-1"></i> Download
                        </a>
                    </div>
                </div>

                <div class="proof-viewer-wrapper">
                    @if(!empty($deposit->proof))
                        <a href="{{ $proofUrl }}" target="_blank">
                            <img src="{{ $proofUrl }}" alt="Deposit Proof" class="proof-image-element" onerror="this.onerror=null; this.src='{{ asset('storage/' . $deposit->proof) }}';">
                        </a>
                    @else
                        <div class="text-white text-center py-5">
                            <i class="fa-solid fa-image-slash f-36 mb-2 d-block opacity-50"></i>
                            <h6 class="text-white">No screenshot attached to this deposit.</h6>
                        </div>
                    @endif
                </div>

                <small class="text-muted f-11 text-center d-block mt-3">
                    <i class="fa-solid fa-circle-info text-info me-1"></i> Click on the image or use the "Open Full View" button to inspect at 100% native resolution.
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
