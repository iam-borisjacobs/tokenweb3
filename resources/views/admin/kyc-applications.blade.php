@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    @php
        $applicantName = $kyc->user ? $kyc->user->name : ($kyc->first_name ? $kyc->first_name . ' ' . $kyc->last_name : 'Applicant #' . $kyc->id);
        $applicantEmail = $kyc->user ? $kyc->user->email : ($kyc->email ?? 'No email');

        $frontUrl = null;
        if (!empty($kyc->frontimg)) {
            if (str_starts_with($kyc->frontimg, 'http')) {
                $frontUrl = $kyc->frontimg;
            } elseif (file_exists(public_path('storage/' . $kyc->frontimg))) {
                $frontUrl = asset('storage/' . $kyc->frontimg);
            } else {
                $frontUrl = asset('storage/app/public/' . $kyc->frontimg);
            }
        }

        $backUrl = null;
        if (!empty($kyc->backimg)) {
            if (str_starts_with($kyc->backimg, 'http')) {
                $backUrl = $kyc->backimg;
            } elseif (file_exists(public_path('storage/' . $kyc->backimg))) {
                $backUrl = asset('storage/' . $kyc->backimg);
            } else {
                $backUrl = asset('storage/app/public/' . $kyc->backimg);
            }
        }
    @endphp

    <!-- Page Header & Action Bar -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('kyc') }}" class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;" title="Back to Applications">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <div>
                    <h3 class="f-w-700 mb-0">{{ $applicantName }}</h3>
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <span class="text-muted f-13">{{ $applicantEmail }}</span>
                        <span class="text-muted f-12">&bull;</span>
                        @if ($kyc->status == 'Verified')
                            <span class="badge bg-light-success text-success px-2 py-1 rounded-pill f-11">
                                <i class="fa fa-check-circle me-1"></i> Verified
                            </span>
                        @elseif ($kyc->status == 'Under review')
                            <span class="badge bg-light-warning text-warning px-2 py-1 rounded-pill f-11">
                                <i class="fa fa-clock-o me-1"></i> Under Review
                            </span>
                        @else
                            <span class="badge bg-light-danger text-danger px-2 py-1 rounded-pill f-11">
                                <i class="fa fa-times-circle me-1"></i> {{ $kyc->status }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('kyc') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back
                </a>
                <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 py-2 f-w-600 shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#actionModal" data-toggle="modal" data-target="#actionModal">
                    <i class="fa fa-gavel me-1"></i> Process KYC
                </button>
            </div>
        </div>
    </div>

    <!-- Application Details Grid -->
    <div class="row g-4">
        <!-- Personal Information Card -->
        <div class="col-lg-6">
            <div class="card p-4 h-100">
                <h5 class="f-w-700 text-dark mb-3 pb-2 border-bottom">
                    <i class="fa fa-user me-2 text-primary"></i> Personal Information
                </h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0 user-info-table">
                        <tbody>
                            <tr>
                                <th class="user-info-label" style="width: 180px;">First Name</th>
                                <td class="user-info-value">{{ $kyc->first_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Last Name</th>
                                <td class="user-info-value">{{ $kyc->last_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Email Address</th>
                                <td class="user-info-value">{{ $kyc->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Phone Number</th>
                                <td class="user-info-value">{{ $kyc->phone_number ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Date of Birth</th>
                                <td class="user-info-value">{{ $kyc->dob ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Social Media</th>
                                <td class="user-info-value">
                                    @if (!empty($kyc->social_media))
                                        <a href="{{ str_starts_with($kyc->social_media, 'http') ? $kyc->social_media : 'https://' . $kyc->social_media }}" target="_blank" rel="noopener noreferrer" class="text-primary">
                                            {{ $kyc->social_media }} <i class="fa fa-external-link f-11 ms-1"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">Not provided</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Address Information Card -->
        <div class="col-lg-6">
            <div class="card p-4 h-100">
                <h5 class="f-w-700 text-dark mb-3 pb-2 border-bottom">
                    <i class="fa fa-map-marker me-2 text-primary"></i> Residential Address
                </h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0 user-info-table">
                        <tbody>
                            <tr>
                                <th class="user-info-label" style="width: 180px;">Address Line</th>
                                <td class="user-info-value">{{ $kyc->address ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">City</th>
                                <td class="user-info-value">{{ $kyc->city ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">State / Province</th>
                                <td class="user-info-value">{{ $kyc->state ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Nationality / Country</th>
                                <td class="user-info-value">{{ $kyc->country ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Submission Date</th>
                                <td class="user-info-value">{{ \Carbon\Carbon::parse($kyc->created_at)->toDayDateTimeString() }}</td>
                            </tr>
                            <tr>
                                <th class="user-info-label">Linked Account</th>
                                <td class="user-info-value">
                                    @if ($kyc->user)
                                        <a href="{{ route('viewuser', $kyc->user->id) }}" class="text-primary f-w-600">
                                            {{ $kyc->user->name }} (#{{ $kyc->user->id }}) <i class="fa fa-external-link f-11 ms-1"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">User record #{{ $kyc->user_id }}</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Document Proof Images Card -->
        <div class="col-12">
            <div class="card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <h5 class="f-w-700 text-dark mb-0">
                        <i class="fa fa-id-card-o me-2 text-primary"></i> Document Verification Proofs
                    </h5>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill f-12">
                        Type: <strong>{{ $kyc->document_type ?? 'Government ID' }}</strong>
                    </span>
                </div>

                <div class="row g-4">
                    <!-- Front View Document -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded h-100 bg-light bg-opacity-25 text-center">
                            <h6 class="f-w-600 mb-2 text-dark">Front View of Document</h6>
                            @if ($frontUrl)
                                <div class="position-relative overflow-hidden rounded border bg-white mb-2" style="max-height: 380px;">
                                    <a href="{{ $frontUrl }}" target="_blank" rel="noopener noreferrer" title="Click to view full image">
                                        <img src="{{ $frontUrl }}" alt="Front ID Document" class="img-fluid rounded" style="max-height: 360px; object-fit: contain;">
                                    </a>
                                </div>
                                <a href="{{ $frontUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    <i class="fa fa-search-plus me-1"></i> View Full Image
                                </a>
                            @else
                                <div class="py-5 text-muted">
                                    <i class="fa fa-file-image-o f-36 mb-2 d-block"></i>
                                    <p class="mb-0">No front image uploaded.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Back View Document -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded h-100 bg-light bg-opacity-25 text-center">
                            <h6 class="f-w-600 mb-2 text-dark">Back View of Document</h6>
                            @if ($backUrl)
                                <div class="position-relative overflow-hidden rounded border bg-white mb-2" style="max-height: 380px;">
                                    <a href="{{ $backUrl }}" target="_blank" rel="noopener noreferrer" title="Click to view full image">
                                        <img src="{{ $backUrl }}" alt="Back ID Document" class="img-fluid rounded" style="max-height: 360px; object-fit: contain;">
                                    </a>
                                </div>
                                <a href="{{ $backUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    <i class="fa fa-search-plus me-1"></i> View Full Image
                                </a>
                            @else
                                <div class="py-5 text-muted">
                                    <i class="fa fa-file-image-o f-36 mb-2 d-block"></i>
                                    <p class="mb-0">No back image uploaded.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Process KYC Modal -->
<div id="actionModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600">
                    <i class="fa fa-gavel me-2 text-primary"></i> Process KYC Application
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('processkyc') }}" method="post" id="processKycForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label f-w-600">Verification Decision <span class="text-danger">*</span></label>
                        <select name="action" id="actionDecisionSelect" class="form-select" required>
                            <option value="Accept" selected>Accept and Verify Client</option>
                            <option value="Reject">Reject Application</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label f-w-600">Email Subject <span class="text-danger">*</span></label>
                        <input type="text" name="subject" id="decisionSubject" class="form-control"
                            value="Account Verified Successfully" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label f-w-600">Notification Message to Client <span class="text-danger">*</span></label>
                        <textarea name="message" id="decisionMessage" rows="5" class="form-control" required>This is to inform you that following the identity documents you submitted, your account has been officially verified. You can now enjoy all platform services without restrictions. Welcome aboard!</textarea>
                    </div>

                    <input type="hidden" name="kyc_id" value="{{ $kyc->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="decisionSubmitBtn" class="btn btn-primary px-4">
                        Confirm Decision
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var decisionSelect = document.getElementById('actionDecisionSelect');
        var decisionSubject = document.getElementById('decisionSubject');
        var decisionMessage = document.getElementById('decisionMessage');
        var decisionBtn = document.getElementById('decisionSubmitBtn');

        var acceptMsg = "This is to inform you that following the identity documents you submitted, your account has been officially verified. You can now enjoy all platform services without restrictions. Welcome aboard!";
        var rejectMsg = "We regret to inform you that we could not verify your identity with the documents provided. Please ensure your ID photos are clear, uncropped, and fully legible, then resubmit your KYC verification from your dashboard.";

        if (decisionSelect) {
            decisionSelect.addEventListener('change', function() {
                if (this.value === 'Accept') {
                    decisionSubject.value = "Account Verified Successfully";
                    decisionMessage.value = acceptMsg;
                    decisionBtn.className = "btn btn-success px-4";
                    decisionBtn.innerHTML = '<i class="fa fa-check-circle me-1"></i> Approve & Verify';
                } else {
                    decisionSubject.value = "KYC Verification Unsuccessful";
                    decisionMessage.value = rejectMsg;
                    decisionBtn.className = "btn btn-danger px-4";
                    decisionBtn.innerHTML = '<i class="fa fa-times-circle me-1"></i> Reject Application';
                }
            });
        }

        var form = document.getElementById('processKycForm');
        if (form) {
            form.addEventListener('submit', function() {
                if (decisionBtn) {
                    decisionBtn.disabled = true;
                    decisionBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Processing...';
                }
            });
        }
    });
</script>
@endsection
