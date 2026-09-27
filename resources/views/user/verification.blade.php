@extends('layouts.dash')
@section('title', $title)
@section('content')
@php
    $user = Auth::user();
    $nameParts = explode(' ', $user->name ?? '', 2);
    $defaultFirstName = $nameParts[0] ?? '';
    $defaultLastName = $nameParts[1] ?? ($user->l_name ?? '');
@endphp

<div class="container-fluid py-4" id="kyc-verification-wrapper">
    <!-- Header & Navigation -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="f-w-800 kyc-title mb-1">Identity Verification</h3>
            <p class="kyc-subtitle f-13 mb-0">Submit legal identification for international KYC / AML regulatory compliance</p>
        </div>
        <div>
            <a href="{{ route('account.verify') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-12 f-w-600">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Verification Status
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    <x-danger-alert />
    <x-success-alert />
    <x-error-alert />

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center mb-2">
                <i class="fa-solid fa-triangle-exclamation me-2 f-18"></i>
                <h6 class="f-w-700 mb-0">Please resolve the following issues:</h6>
            </div>
            <ul class="mb-0 ps-3 f-13">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9 col-12">
            <div class="card kyc-card mb-5">
                <div class="card-body p-4 p-md-5">

                    <!-- Intro Hero Banner -->
                    <div class="text-center mb-4 pb-4 border-bottom kyc-divider-bottom">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 kyc-hero-icon-circle">
                            <i class="fa-solid fa-shield-halved f-28"></i>
                        </div>
                        <h4 class="f-w-800 kyc-title mb-2">Identity & AML Verification</h4>
                        <p class="kyc-subtitle f-13 mx-auto mb-3" style="max-width: 580px;">
                            To prevent financial fraud and comply with international regulations, all account holders must verify their identity. Verification unlocks unlimited deposits, automated withdrawals, and tier-2 investment limits.
                        </p>

                        <!-- Step indicator pills -->
                        <div class="d-inline-flex flex-wrap justify-content-center gap-2 pt-1">
                            <span class="badge kyc-pill-badge">
                                <i class="fa-solid fa-user me-1 text-primary"></i> 1. Personal Details
                            </span>
                            <span class="badge kyc-pill-badge">
                                <i class="fa-solid fa-location-dot me-1 text-primary"></i> 2. Address
                            </span>
                            <span class="badge kyc-pill-badge">
                                <i class="fa-solid fa-id-card me-1 text-primary"></i> 3. Document Photos
                            </span>
                        </div>
                    </div>

                    <form action="{{ route('kycsubmit') }}" method="POST" enctype="multipart/form-data" id="kycSubmissionForm">
                        @csrf

                        <!-- Section 1: Personal Details -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="kyc-step-badge">1</span>
                                <h5 class="kyc-section-heading mb-0 f-16">Personal Details</h5>
                            </div>
                            <p class="kyc-subtitle f-12 mb-3">Please ensure your details match your government-issued ID card exactly.</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="kyc-label">First Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="kyc-input-icon"><i class="fa-solid fa-user f-12"></i></span>
                                        <input type="text" name="first_name" class="form-control kyc-input kyc-input-with-icon" value="{{ old('first_name', $defaultFirstName) }}" placeholder="e.g. John" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="kyc-label">Last Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="kyc-input-icon"><i class="fa-solid fa-user f-12"></i></span>
                                        <input type="text" name="last_name" class="form-control kyc-input kyc-input-with-icon" value="{{ old('last_name', $defaultLastName) }}" placeholder="e.g. Doe" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="kyc-label">Email Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="kyc-input-icon"><i class="fa-solid fa-envelope f-12"></i></span>
                                        <input type="email" name="email" class="form-control kyc-input kyc-input-with-icon" value="{{ old('email', $user->email ?? '') }}" placeholder="name@example.com" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="kyc-label">Phone Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="kyc-input-icon"><i class="fa-solid fa-phone f-12"></i></span>
                                        <input type="text" name="phone_number" class="form-control kyc-input kyc-input-with-icon" value="{{ old('phone_number', $user->phone ?? '') }}" placeholder="+1 234 567 8900" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="kyc-label">Date of Birth <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="kyc-input-icon"><i class="fa-solid fa-calendar-days f-12"></i></span>
                                        <input type="date" name="dob" class="form-control kyc-input kyc-input-with-icon" value="{{ old('dob') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="kyc-label">Social Media Profile / Handle</label>
                                    <div class="input-group">
                                        <span class="kyc-input-icon"><i class="fa-brands fa-x-twitter f-12"></i></span>
                                        <input type="text" name="social_media" class="form-control kyc-input kyc-input-with-icon" value="{{ old('social_media') }}" placeholder="Twitter, Telegram, or LinkedIn handle">
                                    </div>
                                    <small class="kyc-subtitle f-11 mt-1 d-block">Optional, expedites manual compliance clearance</small>
                                </div>
                            </div>
                        </div>

                        <div class="kyc-divider"></div>

                        <!-- Section 2: Residential Address -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="kyc-step-badge">2</span>
                                <h5 class="kyc-section-heading mb-0 f-16">Residential Address</h5>
                            </div>
                            <p class="kyc-subtitle f-12 mb-3">Provide your official residential location as shown on your legal documents.</p>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="kyc-label">Street Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="kyc-input-icon"><i class="fa-solid fa-location-dot f-12"></i></span>
                                        <input type="text" name="address" class="form-control kyc-input kyc-input-with-icon" value="{{ old('address') }}" placeholder="Street address, apartment or suite" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="kyc-label">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control kyc-input" value="{{ old('city') }}" placeholder="e.g. London" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="kyc-label">State / Province <span class="text-danger">*</span></label>
                                    <input type="text" name="state" class="form-control kyc-input" value="{{ old('state') }}" placeholder="e.g. Greater London" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="kyc-label">Nationality / Country <span class="text-danger">*</span></label>
                                    <input type="text" name="country" class="form-control kyc-input" value="{{ old('country', $user->country ?? '') }}" placeholder="e.g. United Kingdom" required>
                                </div>
                            </div>
                        </div>

                        <div class="kyc-divider"></div>

                        <!-- Section 3: Document Type & Uploads -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="kyc-step-badge">3</span>
                                <h5 class="kyc-section-heading mb-0 f-16">Document Upload</h5>
                            </div>
                            <p class="kyc-subtitle f-12 mb-3">Select the identification document type you will provide.</p>

                            <!-- Modern Document Type Selector Cards -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="doc-type-btn" for="doc_passport">
                                        <input type="radio" name="document_type" id="doc_passport" value="Int'l Passport" class="d-none doc-type-radio" {{ old('document_type', "Int'l Passport") == "Int'l Passport" ? 'checked' : '' }}>
                                        <div class="doc-icon-circle mb-2">
                                            <i class="fa-solid fa-passport f-22 text-primary"></i>
                                        </div>
                                        <span class="doc-title">Int'l Passport</span>
                                        <small class="kyc-subtitle f-11 mt-1">Official passport page</small>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="doc-type-btn" for="doc_nid">
                                        <input type="radio" name="document_type" id="doc_nid" value="National ID" class="d-none doc-type-radio" {{ old('document_type') == 'National ID' ? 'checked' : '' }}>
                                        <div class="doc-icon-circle mb-2">
                                            <i class="fa-solid fa-id-card f-22 text-primary"></i>
                                        </div>
                                        <span class="doc-title">National ID Card</span>
                                        <small class="kyc-subtitle f-11 mt-1">Both sides required</small>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="doc-type-btn" for="doc_dl">
                                        <input type="radio" name="document_type" id="doc_dl" value="Drivers License" class="d-none doc-type-radio" {{ old('document_type') == 'Drivers License' ? 'checked' : '' }}>
                                        <div class="doc-icon-circle mb-2">
                                            <i class="fa-solid fa-address-card f-22 text-primary"></i>
                                        </div>
                                        <span class="doc-title">Driver's License</span>
                                        <small class="kyc-subtitle f-11 mt-1">Both sides required</small>
                                    </label>
                                </div>
                            </div>

                            <!-- Quality Guidance Note -->
                            <div class="kyc-criteria-box mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fa-solid fa-circle-check text-success f-14"></i>
                                    <span class="f-w-700 kyc-section-heading f-12 text-uppercase" style="letter-spacing: 0.04em;">
                                        Document Requirements for Fast Approval
                                    </span>
                                </div>
                                <div class="row g-2 f-12 kyc-subtitle">
                                    <div class="col-sm-6 d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-check text-primary f-10"></i> Document must be valid and not expired
                                    </div>
                                    <div class="col-sm-6 d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-check text-primary f-10"></i> All 4 corners and borders clearly visible
                                    </div>
                                    <div class="col-sm-6 d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-check text-primary f-10"></i> Avoid direct camera glare or blurry shadows
                                    </div>
                                    <div class="col-sm-6 d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-check text-primary f-10"></i> JPG, PNG, WEBP, or PDF (Auto-optimized)
                                    </div>
                                </div>
                            </div>

                            <!-- Document Upload Zones (Front & Back) -->
                            <div class="row g-4">
                                <!-- FRONT SIDE -->
                                <div class="col-md-6">
                                    <label class="kyc-label d-flex align-items-center justify-content-between mb-2">
                                        <span>Front Side of Document <span class="text-danger">*</span></span>
                                        <span class="badge bg-light-primary text-primary rounded-pill px-2.5 py-1 f-10">Front Side</span>
                                    </label>

                                    <div class="kyc-dropzone" id="frontDropzone" onclick="triggerUpload('front');">
                                        <input type="file" name="frontimg" id="frontimgInput" accept="image/jpeg,image/png,image/jpg,image/webp,application/pdf" class="d-none" required>

                                        <!-- Empty State -->
                                        <div id="frontEmptyState" class="w-100 py-3">
                                            <div class="kyc-upload-icon-circle mb-3">
                                                <i class="fa-solid fa-cloud-arrow-up f-22 text-primary"></i>
                                            </div>
                                            <h6 class="f-w-700 kyc-title f-14 mb-1">Click or drag & drop front document</h6>
                                            <p class="kyc-subtitle f-11 mb-3">Take a photo or choose from device (Max 25MB)</p>
                                            <span class="btn btn-sm btn-primary rounded-pill px-3 py-1.5 f-12 f-w-600 shadow-sm pointer-events-none">
                                                <i class="fa-solid fa-camera me-1"></i> Choose Front Photo
                                            </span>
                                        </div>

                                        <!-- Preview State -->
                                        <div id="frontPreviewState" class="w-100 d-none text-center" onclick="event.stopPropagation();">
                                            <div class="position-relative d-inline-block mb-3">
                                                <img id="frontThumb" src="" alt="Front ID Preview" class="img-fluid rounded-3 border shadow-sm" style="max-height: 150px; object-fit: contain;">
                                                <div id="frontPdfBadge" class="d-none p-3 rounded-3 border shadow-sm kyc-card">
                                                    <i class="fa-solid fa-file-pdf text-danger f-38 mb-2"></i>
                                                    <div class="f-12 f-w-700 kyc-title">PDF Document Attached</div>
                                                </div>
                                            </div>
                                            <div class="f-w-700 kyc-title f-13 text-truncate px-2 mb-1" id="frontFileName"></div>
                                            <div class="badge bg-light-success text-success rounded-pill px-3 py-1 f-11 mb-2" id="frontFileSize"></div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 f-12 me-1" onclick="triggerUpload('front');">
                                                    <i class="fa-solid fa-arrow-rotate-left me-1"></i> Change
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 f-12" onclick="clearUpload('front');">
                                                    <i class="fa-solid fa-trash me-1"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- BACK SIDE -->
                                <div class="col-md-6">
                                    <label class="kyc-label d-flex align-items-center justify-content-between mb-2">
                                        <span>Back Side of Document <span class="text-danger">*</span></span>
                                        <span class="badge bg-light-primary text-primary rounded-pill px-2.5 py-1 f-10">Back Side</span>
                                    </label>

                                    <div class="kyc-dropzone" id="backDropzone" onclick="triggerUpload('back');">
                                        <input type="file" name="backimg" id="backimgInput" accept="image/jpeg,image/png,image/jpg,image/webp,application/pdf" class="d-none" required>

                                        <!-- Empty State -->
                                        <div id="backEmptyState" class="w-100 py-3">
                                            <div class="kyc-upload-icon-circle mb-3">
                                                <i class="fa-solid fa-cloud-arrow-up f-22 text-primary"></i>
                                            </div>
                                            <h6 class="f-w-700 kyc-title f-14 mb-1">Click or drag & drop back document</h6>
                                            <p class="kyc-subtitle f-11 mb-3">Take a photo or choose from device (Max 25MB)</p>
                                            <span class="btn btn-sm btn-primary rounded-pill px-3 py-1.5 f-12 f-w-600 shadow-sm pointer-events-none">
                                                <i class="fa-solid fa-camera me-1"></i> Choose Back Photo
                                            </span>
                                        </div>

                                        <!-- Preview State -->
                                        <div id="backPreviewState" class="w-100 d-none text-center" onclick="event.stopPropagation();">
                                            <div class="position-relative d-inline-block mb-3">
                                                <img id="backThumb" src="" alt="Back ID Preview" class="img-fluid rounded-3 border shadow-sm" style="max-height: 150px; object-fit: contain;">
                                                <div id="backPdfBadge" class="d-none p-3 rounded-3 border shadow-sm kyc-card">
                                                    <i class="fa-solid fa-file-pdf text-danger f-38 mb-2"></i>
                                                    <div class="f-12 f-w-700 kyc-title">PDF Document Attached</div>
                                                </div>
                                            </div>
                                            <div class="f-w-700 kyc-title f-13 text-truncate px-2 mb-1" id="backFileName"></div>
                                            <div class="badge bg-light-success text-success rounded-pill px-3 py-1 f-11 mb-2" id="backFileSize"></div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 f-12 me-1" onclick="triggerUpload('back');">
                                                    <i class="fa-solid fa-arrow-rotate-left me-1"></i> Change
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 f-12" onclick="clearUpload('back');">
                                                    <i class="fa-solid fa-trash me-1"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kyc-divider"></div>

                        <!-- Consent Checkbox & Submit Action -->
                        <div class="mb-2">
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="1" id="consentCheck" required style="cursor: pointer; width: 18px; height: 18px;">
                                <label class="form-check-label kyc-check-text ms-2" for="consentCheck" style="cursor: pointer; line-height: 1.5;">
                                    I certify that all details submitted are correct and the uploaded credentials are legal, unexpired documents issued to my identity.
                                </label>
                            </div>

                            @if (Auth::user()->account_verify == 'Under review')
                                <div class="alert alert-warning d-flex align-items-center rounded-3 p-3 mb-3">
                                    <i class="fa-solid fa-clock-rotate-left me-2 f-18"></i>
                                    <div class="f-13">
                                        Your previous verification application is currently under review by compliance. You do not need to resubmit.
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary rounded-pill px-5 py-2.5 f-14 f-w-700" disabled>
                                    <i class="fa-solid fa-clock me-1"></i> Application Currently Under Review
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 f-14 f-w-700 shadow-sm" id="submitKycBtn">
                                    <i class="fa-solid fa-shield-check me-2"></i> Submit Verification Application
                                </button>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* -------------------------------------------------------------
   KYC Verification Light & Dark Mode Theming (Admiro Compatible)
   ------------------------------------------------------------- */

/* Main Card */
.kyc-card {
    background: #ffffff;
    border: 1px solid #e8ecf2 !important;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
}
body.dark-only .kyc-card {
    background: #222736 !important;
    border-color: rgba(255, 255, 255, 0.08) !important;
    box-shadow: 0 12px 36px rgba(0, 0, 0, 0.35) !important;
}

/* Titles and Text */
.kyc-title {
    color: #0f172a !important;
}
body.dark-only .kyc-title {
    color: #f8fafc !important;
}

.kyc-subtitle {
    color: #64748b !important;
}
body.dark-only .kyc-subtitle {
    color: #94a3b8 !important;
}

.kyc-section-heading {
    color: #1e293b !important;
}
body.dark-only .kyc-section-heading {
    color: #f1f5f9 !important;
}

/* Form Labels */
.kyc-label {
    color: #334155 !important;
    font-weight: 600;
    font-size: 13px;
    display: block;
}
body.dark-only .kyc-label {
    color: #cbd5e1 !important;
}

/* Form Inputs */
.kyc-input {
    background-color: #ffffff !important;
    border: 1.5px solid #d1d5db !important;
    color: #0f172a !important;
    border-radius: 10px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    transition: all 0.2s ease;
}
.kyc-input:focus {
    border-color: #6366f1 !important;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.18) !important;
    outline: none !important;
}
.kyc-input::placeholder {
    color: #9ca3af !important;
}
body.dark-only .kyc-input {
    background-color: #1a1e2b !important;
    border-color: #334155 !important;
    color: #f8fafc !important;
}
body.dark-only .kyc-input:focus {
    border-color: #818cf8 !important;
    box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.25) !important;
}
body.dark-only .kyc-input::placeholder {
    color: #64748b !important;
}
body.dark-only input[type="date"].kyc-input {
    color-scheme: dark;
}

/* Input Group Icon */
.kyc-input-icon {
    background-color: #f8fafc;
    border: 1.5px solid #d1d5db;
    border-right: none;
    color: #64748b;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    padding: 0 14px;
    display: flex;
    align-items: center;
}
body.dark-only .kyc-input-icon {
    background-color: #151824;
    border-color: #334155;
    color: #94a3b8;
}
.kyc-input-with-icon {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
}

/* Dividers & Borders */
.kyc-divider {
    border-top: 1px solid #e8ecf2;
    margin: 28px 0;
}
body.dark-only .kyc-divider {
    border-top: 1px solid rgba(255, 255, 255, 0.08);
}
.kyc-divider-bottom {
    border-bottom-color: #e8ecf2 !important;
}
body.dark-only .kyc-divider-bottom {
    border-bottom-color: rgba(255, 255, 255, 0.08) !important;
}

/* Hero Icons & Badges */
.kyc-hero-icon-circle {
    width: 68px;
    height: 68px;
    background: rgba(99, 102, 241, 0.12);
    color: #6366f1;
    border: 1px solid rgba(99, 102, 241, 0.2);
}
body.dark-only .kyc-hero-icon-circle {
    background: rgba(99, 102, 241, 0.22);
    color: #818cf8;
    border-color: rgba(129, 140, 248, 0.35);
}

.kyc-pill-badge {
    background-color: #f1f5f9 !important;
    color: #334155 !important;
    border: 1px solid #e2e8f0 !important;
    font-size: 12px;
    padding: 6px 14px;
    border-radius: 50px;
    font-weight: 600;
}
body.dark-only .kyc-pill-badge {
    background-color: #1a1e2b !important;
    color: #cbd5e1 !important;
    border-color: #334155 !important;
}

.kyc-step-badge {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
    background: rgba(99, 102, 241, 0.12);
    color: #6366f1;
}
body.dark-only .kyc-step-badge {
    background: rgba(99, 102, 241, 0.25);
    color: #a5b4fc;
}

/* Document Type Selection Cards */
.doc-type-btn {
    border: 2px solid #e2e8f0;
    background: #ffffff;
    border-radius: 14px;
    padding: 16px 12px;
    text-align: center;
    cursor: pointer;
    transition: all 0.25s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.doc-type-btn:hover {
    border-color: #6366f1;
    transform: translateY(-2px);
}
.doc-type-btn.active {
    border-color: #6366f1 !important;
    background: rgba(99, 102, 241, 0.06) !important;
    box-shadow: 0 4px 14px rgba(99, 102, 241, 0.15);
}
body.dark-only .doc-type-btn {
    border-color: #334155;
    background: #1a1e2b;
}
body.dark-only .doc-type-btn:hover {
    border-color: #818cf8;
}
body.dark-only .doc-type-btn.active {
    border-color: #818cf8 !important;
    background: rgba(99, 102, 241, 0.2) !important;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
}
.doc-icon-circle {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: rgba(99, 102, 241, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
}
body.dark-only .doc-icon-circle {
    background: rgba(99, 102, 241, 0.18);
}
.doc-type-btn .doc-title {
    color: #0f172a;
    font-weight: 700;
    font-size: 13px;
}
body.dark-only .doc-type-btn .doc-title {
    color: #f8fafc !important;
}

/* Criteria Guidance Box */
.kyc-criteria-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 16px 20px;
}
body.dark-only .kyc-criteria-box {
    background: rgba(255, 255, 255, 0.03);
    border-color: rgba(255, 255, 255, 0.08);
}

/* Upload Dropzones */
.kyc-dropzone {
    border: 2px dashed #cbd5e1;
    border-radius: 14px;
    background: #f8fafc;
    padding: 24px 16px;
    text-align: center;
    transition: all 0.25s ease;
    cursor: pointer;
    min-height: 220px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.kyc-dropzone:hover {
    border-color: #6366f1;
    background: #f1f5f9;
}
body.dark-only .kyc-dropzone {
    border-color: #334155;
    background: #1a1e2b;
}
body.dark-only .kyc-dropzone:hover {
    border-color: #818cf8;
    background: #202637;
}
.kyc-upload-icon-circle {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: rgba(99, 102, 241, 0.1);
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
body.dark-only .kyc-upload-icon-circle {
    background: rgba(99, 102, 241, 0.2);
}

/* Checkbox Text */
.kyc-check-text {
    color: #334155 !important;
}
body.dark-only .kyc-check-text {
    color: #cbd5e1 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Document Type Radio Highlight
    const radios = document.querySelectorAll('.doc-type-radio');
    function updateRadioStyles() {
        document.querySelectorAll('.doc-type-btn').forEach(card => card.classList.remove('active'));
        radios.forEach(radio => {
            if (radio.checked) {
                radio.closest('.doc-type-btn').classList.add('active');
            }
        });
    }
    radios.forEach(radio => {
        radio.addEventListener('change', updateRadioStyles);
    });
    updateRadioStyles();

    // Setup Upload Handlers for Front & Back
    setupFileUploader('frontimgInput', 'frontDropzone', 'frontEmptyState', 'frontPreviewState', 'frontThumb', 'frontPdfBadge', 'frontFileName', 'frontFileSize');
    setupFileUploader('backimgInput', 'backDropzone', 'backEmptyState', 'backPreviewState', 'backThumb', 'backPdfBadge', 'backFileName', 'backFileSize');

    // Prevent Double Submissions & Show Loading State
    const form = document.getElementById('kycSubmissionForm');
    const submitBtn = document.getElementById('submitKycBtn');
    if (form && submitBtn) {
        form.addEventListener('submit', function (e) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Optimizing & Submitting...';
        });
    }
});

function triggerUpload(type) {
    const input = document.getElementById(type + 'imgInput');
    if (input) input.click();
}

function formatBytes(bytes, decimals = 1) {
    if (!+bytes) return '0 B';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['B', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
}

// Client-Side Canvas Image Compression
function compressImageFile(file, maxWidth = 1600, maxHeight = 1600, quality = 0.85) {
    return new Promise((resolve) => {
        if (!file.type.match(/image\/(jpeg|jpg|png|webp)/i)) {
            return resolve(file);
        }
        if (file.size < 1024 * 1024) {
            return resolve(file);
        }

        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (event) {
            const img = new Image();
            img.src = event.target.result;
            img.onload = function () {
                let width = img.width;
                let height = img.height;

                if (width > height) {
                    if (width > maxWidth) {
                        height = Math.round((height * maxWidth) / width);
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width = Math.round((width * maxHeight) / height);
                        height = maxHeight;
                    }
                }

                const canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);

                canvas.toBlob(
                    (blob) => {
                        if (!blob || blob.size >= file.size) {
                            return resolve(file);
                        }
                        const compressedFile = new File([blob], file.name.replace(/\.[^/.]+$/, "") + ".jpg", {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        });
                        resolve(compressedFile);
                    },
                    'image/jpeg',
                    quality
                );
            };
            img.onerror = function () {
                resolve(file);
            };
        };
        reader.onerror = function () {
            resolve(file);
        };
    });
}

function setupFileUploader(inputId, dropzoneId, emptyId, previewId, thumbId, pdfBadgeId, nameId, sizeId) {
    const input = document.getElementById(inputId);
    const dropzone = document.getElementById(dropzoneId);
    const emptyState = document.getElementById(emptyId);
    const previewState = document.getElementById(previewId);
    const thumb = document.getElementById(thumbId);
    const pdfBadge = document.getElementById(pdfBadgeId);
    const nameEl = document.getElementById(nameId);
    const sizeEl = document.getElementById(sizeId);

    if (!input || !dropzone) return;

    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.style.borderColor = '#6366f1';
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.style.borderColor = '';
        }, false);
    });

    dropzone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length) {
            handleFileSelect(files[0]);
        }
    });

    input.addEventListener('change', function () {
        if (this.files && this.files.length) {
            handleFileSelect(this.files[0]);
        }
    });

    async function handleFileSelect(rawFile) {
        if (!rawFile) return;

        const origSize = rawFile.size;
        sizeEl.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Optimizing photo...';
        emptyState.classList.add('d-none');
        previewState.classList.remove('d-none');
        nameEl.innerText = rawFile.name;

        const processedFile = await compressImageFile(rawFile);

        try {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(processedFile);
            input.files = dataTransfer.files;
        } catch (e) {
            console.warn('DataTransfer not supported by browser, original file will be sent', e);
        }

        if (processedFile.type === 'application/pdf') {
            thumb.classList.add('d-none');
            pdfBadge.classList.remove('d-none');
            sizeEl.innerText = `${formatBytes(processedFile.size)}`;
        } else {
            pdfBadge.classList.add('d-none');
            thumb.classList.remove('d-none');
            const reader = new FileReader();
            reader.onload = function (e) {
                thumb.src = e.target.result;
            };
            reader.readAsDataURL(processedFile);

            if (processedFile.size < origSize) {
                sizeEl.innerText = `Optimized: ${formatBytes(processedFile.size)} (reduced from ${formatBytes(origSize)})`;
            } else {
                sizeEl.innerText = `Size: ${formatBytes(processedFile.size)}`;
            }
        }
    }
}

function clearUpload(type) {
    const input = document.getElementById(type + 'imgInput');
    const emptyState = document.getElementById(type + 'EmptyState');
    const previewState = document.getElementById(type + 'PreviewState');
    const thumb = document.getElementById(type + 'Thumb');

    if (input) input.value = '';
    if (thumb) thumb.src = '';
    if (emptyState) emptyState.classList.remove('d-none');
    if (previewState) previewState.classList.add('d-none');
}
</script>
@endsection
