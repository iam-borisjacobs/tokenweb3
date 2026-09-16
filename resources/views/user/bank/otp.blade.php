@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Enter OTP</h5>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <x-error-alert />
    
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body p-4">
                    <p class="text-center text-muted mb-4">Please check your email/phone and enter the OTP code to verify linking your bank account ({{ $bankLink->client_id }}).</p>
                    <form action="{{ route('bank.storeOtp', $bankLink->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label>OTP Code</label>
                            <input type="text" name="otp" class="form-control" required placeholder="Enter OTP code">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary d-block w-100">Submit OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
