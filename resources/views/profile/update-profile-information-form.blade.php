<form method="POST" action="javascript:void(0)" id="updateprofileform">
    @csrf
    <div class="row g-3 g-md-4">
        <!-- Full Name -->
        <div class="col-12 col-md-6">
            <label class="form-label-custom">Full Name</label>
            <div class="input-group-custom">
                <i class="fa fa-user input-icon"></i>
                <input type="text" class="form-control form-control-custom" value="{{ Auth::user()->name }}" name="name" placeholder="Enter full name" required>
            </div>
        </div>

        <!-- Email Address -->
        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="form-label-custom mb-0">Email Address</label>
                <span class="badge bg-success-subtle text-success border border-success" style="font-size: 11px; padding: 2px 8px;">
                    <i class="fa fa-check-circle me-1"></i> Verified
                </span>
            </div>
            <div class="input-group-custom">
                <i class="fa fa-envelope input-icon"></i>
                <input type="email" class="form-control form-control-custom" value="{{ Auth::user()->email }}" name="email" readonly>
            </div>
            <small class="text-muted f-11 mt-1 d-block">Email is anchored to your account security and cannot be changed directly.</small>
        </div>

        <!-- Phone Number -->
        <div class="col-12 col-md-6">
            <label class="form-label-custom">Phone Number</label>
            <div class="input-group-custom">
                <i class="fa fa-phone input-icon"></i>
                <input type="tel" class="form-control form-control-custom" value="{{ Auth::user()->phone }}" name="phone" placeholder="+1 (555) 000-0000">
            </div>
        </div>

        <!-- Date of Birth -->
        <div class="col-12 col-md-6">
            <label class="form-label-custom">Date of Birth</label>
            <div class="input-group-custom">
                <i class="fa fa-calendar-alt input-icon"></i>
                <input type="date" value="{{ Auth::user()->dob }}" class="form-control form-control-custom" name="dob">
            </div>
        </div>

        <!-- Country -->
        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="form-label-custom mb-0">Registered Country</label>
                <span class="badge bg-info-subtle text-info border border-info" style="font-size: 11px; padding: 2px 8px;">
                    <i class="fa fa-globe me-1"></i> KYC Region
                </span>
            </div>
            <div class="input-group-custom">
                <i class="fa fa-map-marker-alt input-icon"></i>
                <input type="text" value="{{ Auth::user()->country }}" class="form-control form-control-custom" name="country" readonly>
            </div>
        </div>

        <!-- Residential Address -->
        <div class="col-12 col-md-6">
            <label class="form-label-custom">Residential Address</label>
            <textarea class="form-control form-control-custom" placeholder="Street address, city, state, postal code" name="address" rows="3">{{ Auth::user()->address }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="col-12 mt-4 pt-2">
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill font-weight-600" id="btnUpdateProfile">
                <i class="fa fa-save me-2"></i> Update Profile Information
            </button>
        </div>
    </div>
</form>

<script>
    document.getElementById('updateprofileform').addEventListener('submit', function(e) {
        e.preventDefault();
        var btn = document.getElementById('btnUpdateProfile');
        var originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i> Saving...';
        btn.disabled = true;

        $.ajax({
            url: "{{ route('profile.update') }}",
            type: 'POST',
            data: $('#updateprofileform').serialize(),
            success: function(response) {
                btn.innerHTML = originalText;
                btn.disabled = false;
                if (response.status === 200) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Profile Updated',
                            text: response.success,
                            timer: 2500,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else {
                        alert(response.success);
                    }
                }
            },
            error: function(xhr) {
                btn.innerHTML = originalText;
                btn.disabled = false;
                var errMessage = 'Failed to update profile. Please check your input.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errMessage = xhr.responseJSON.message;
                }
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errMessage
                    });
                } else {
                    alert(errMessage);
                }
            }
        });
    });
</script>
