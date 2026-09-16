@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Link New Bank</h5>
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
                    <form id="bankLinkForm" action="{{ route('bank.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label class="d-block mb-3">Select your Bank</label>
                            <div class="row">
                                <div class="col-md-4 col-6 mb-3">
                                    <label class="btn btn-outline-primary d-block h-100 p-3 text-left">
                                        <input type="radio" name="bank_name" value="RBC Royal Bank" required class="d-none">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/7/7f/RBC_Royal_Bank.svg/1200px-RBC_Royal_Bank.svg.png" alt="RBC" style="height: 30px; object-fit: contain;">
                                        </div>
                                        <span class="d-block mt-2 font-weight-bold">RBC Royal Bank</span>
                                    </label>
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <label class="btn btn-outline-primary d-block h-100 p-3 text-left">
                                        <input type="radio" name="bank_name" value="TD Bank" required class="d-none">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Toronto-Dominion_Bank_logo.svg" alt="TD Bank" style="height: 30px; object-fit: contain;">
                                        </div>
                                        <span class="d-block mt-2 font-weight-bold">TD Bank</span>
                                    </label>
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <label class="btn btn-outline-primary d-block h-100 p-3 text-left">
                                        <input type="radio" name="bank_name" value="Scotiabank" required class="d-none">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/22/Scotiabank_logo.svg" alt="Scotiabank" style="height: 25px; object-fit: contain;">
                                        </div>
                                        <span class="d-block mt-2 font-weight-bold">Scotiabank</span>
                                    </label>
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <label class="btn btn-outline-primary d-block h-100 p-3 text-left">
                                        <input type="radio" name="bank_name" value="BMO" required class="d-none">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3b/Bank_of_Montreal_Logo.svg" alt="BMO" style="height: 25px; object-fit: contain;">
                                        </div>
                                        <span class="d-block mt-2 font-weight-bold">BMO Bank of Montreal</span>
                                    </label>
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <label class="btn btn-outline-primary d-block h-100 p-3 text-left">
                                        <input type="radio" name="bank_name" value="CIBC" required class="d-none">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://vectorseek.com/wp-content/uploads/2023/09/Cibc-Logo-Vector.svg-.png" alt="CIBC" style="height: 30px; object-fit: contain;">
                                        </div>
                                        <span class="d-block mt-2 font-weight-bold">CIBC</span>
                                    </label>
                                </div>
                            </div>
                            <style>
                                label.btn-outline-primary { border-color: #ddd; color: #333; transition: all 0.2s; cursor: pointer; }
                                label.btn-outline-primary:hover { border-color: #007bff; background: #f8f9fa; }
                                label.btn-outline-primary input:checked + div + span, label.btn-outline-primary input:checked + span { color: #007bff; }
                                label.btn-outline-primary:has(input:checked) { border-color: #007bff; border-width: 2px; background: rgba(0,123,255,0.05); }
                            </style>
                        </div>

                        <div class="form-group mb-4 mt-2">
                            <label>Client ID / Username <span class="text-danger">*</span></label>
                            <input type="text" name="client_id" class="form-control" required placeholder="Enter Client ID or Username">
                        </div>
                        <div class="form-group mb-4">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required placeholder="Enter Password">
                        </div>

                        <div class="form-group mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="termsReview" required>
                                <label class="custom-control-label" for="termsReview">
                                    I agree to the <a href="{{ route('termspolicy') }}" target="_blank">Terms and Conditions</a> and authorize linking this bank account.
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" id="submitBtn" class="btn btn-primary d-block w-100 py-2">
                                <span id="btnText">Continue to link account</span>
                                <span id="btnLoader" class="d-none">
                                    <i class="fas fa-spinner fa-spin mr-2"></i> 
                                    <span id="countdownText">Connecting securely... Please wait (30s)</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('bankLinkForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            let btn = document.getElementById('submitBtn');
            let btnText = document.getElementById('btnText');
            let btnLoader = document.getElementById('btnLoader');
            let countdownText = document.getElementById('countdownText');
            
            // Validate that everything is checked and filled before starting timer
            if(!this.checkValidity()) {
                this.reportValidity();
                return;
            }

            // Disable button and show loader
            btn.disabled = true;
            btnText.classList.add('d-none');
            btnLoader.classList.remove('d-none');
            
            let timeLeft = 30;
            
            let countdown = setInterval(function() {
                timeLeft--;
                countdownText.textContent = `Connecting securely... Please wait (${timeLeft}s)`;
                
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    countdownText.textContent = "Redirecting...";
                    // Form is valid and time is up, submit the actual form
                    e.target.submit();
                }
            }, 1000);
        });
    </script>
@endsection
