@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header & Breadcrumb -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('viewuser', $user->id) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 f-12">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to {{ $user->name }}
                </a>
            </div>
            <h3 class="f-w-800 text-dark mb-1">Assign Downline Referral</h3>
            <p class="text-muted mb-0 f-13">Attach a registered client as a direct downline referral under {{ $user->name }}.</p>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 col-xl-6">
            <div class="card p-4 p-md-5 shadow-sm border-0 rounded-3">
                <div class="d-flex align-items-center gap-3 pb-3 mb-4 border-bottom">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 18px;">
                        <i class="fa-solid fa-user-tag"></i>
                    </div>
                    <div>
                        <h5 class="f-w-700 text-dark mb-0">Referral Assignment</h5>
                        <small class="text-muted">Upline Sponsor: <strong>{{ $user->name }}</strong> ({{ $user->email }})</small>
                    </div>
                </div>

                <form method="POST" action="{{ route('addref') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="mb-4">
                        <label class="form-label f-w-600 f-13">Select Referred Client (Downline) <span class="text-danger">*</span></label>
                        <select class="form-select form-control select2" name="ref_id" style="width: 100%;" required>
                            <option value="" disabled selected>Search and choose client...</option>
                            @foreach ($ref as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->email }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted f-11 mt-2 d-block">
                            <i class="fa-solid fa-circle-info text-info me-1"></i> The chosen user will receive upline tracking and commissions will route to {{ $user->name }}.
                        </small>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2">
                        <a href="{{ route('viewuser', $user->id) }}" class="btn btn-light rounded-pill px-4 py-2 f-13">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                            <i class="fa-solid fa-link me-1"></i> Save Referral Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof $ !== 'undefined' && $('.select2').length) {
            $('.select2').select2({
                placeholder: 'Search and choose client...',
                width: '100%'
            });
        }
    });
</script>
@endsection
