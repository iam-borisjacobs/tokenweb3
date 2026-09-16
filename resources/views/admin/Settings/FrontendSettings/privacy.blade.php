@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">Terms of Service & Privacy Policy</h3>
                <p class="text-muted mb-0 f-14">Draft and maintain regulatory compliance notices, risk disclosures, terms of use, and privacy commitments.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-shield-alt me-1"></i> Legal & Compliance
                </span>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-12">
            <div class="card p-4 p-md-5 shadow-sm border">
                <form method="POST" action="{{ route('savetermspolicy') }}">
                    @csrf

                    <!-- Activation Switch -->
                    <div class="p-3 bg-light bg-opacity-50 border rounded-3 mb-4">
                        <label class="form-label f-w-600 f-13 d-block mb-2">Enforce Terms & Privacy Acceptance on Registration</label>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" name="terms" id="termsyes" value="yes" class="selectgroup-input" {{ $terms->useterms == 'yes' ? 'checked' : '' }}>
                                <span class="selectgroup-button"><i class="fa fa-check me-1"></i> Required (Yes)</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="terms" id="termsno" value="no" class="selectgroup-input" {{ $terms->useterms != 'yes' ? 'checked' : '' }}>
                                <span class="selectgroup-button"><i class="fa fa-times me-1"></i> Optional (No)</span>
                            </label>
                        </div>
                        <small class="text-muted d-block mt-2 f-11">When enabled, newly registering investors must check an agreement box accepting these terms before account creation.</small>
                    </div>

                    <!-- Policy Editor -->
                    <div class="mb-4">
                        <label class="form-label f-w-600 f-13">Terms and Privacy Policy Document Body</label>
                        <textarea class="ckeditor form-control" name="termsprivacy" rows="12">{{ $terms->description }}</textarea>
                    </div>

                    <div class="pt-3 border-top text-end">
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill f-w-600 shadow-sm">
                            <i class="fa fa-save me-1"></i> Save Legal Documents
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if ($('.ckeditor').length) {
            $('.ckeditor').ckeditor();
        }
    });
</script>
@endsection
