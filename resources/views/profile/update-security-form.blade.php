<div class="settings-subcard">
    <div class="settings-subcard-header">
        <h5 class="settings-subcard-title">
            <i class="fa-solid fa-bell text-primary"></i>
            {{ __('Email & Notification Preferences') }}
        </h5>
        <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3 py-1">
            <i class="fa-solid fa-envelope me-1"></i> {{ __('Alerts') }}
        </span>
    </div>

    <p class="text-muted small mb-4">
        {{ __('Customize automated email notifications and transaction confirmation alerts sent to your verified email address.') }}
    </p>

    <form method="POST" action="javascript:void(0)" id="updateemailpref">
        @csrf
        @method('PUT')

        <div class="d-flex flex-column gap-3">
            <!-- OTP on Withdrawal -->
            <div class="custom-radio-card d-flex align-items-center justify-content-between p-3 rounded-3 flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="metric-icon-circle primary" style="width: 42px; height: 42px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 14.5px;">{{ __('Withdrawal OTP Confirmation') }}</div>
                        <div class="text-muted small">{{ __('Send a one-time confirmation OTP to my email when requesting a withdrawal.') }}</div>
                    </div>
                </div>
                <div class="btn-group" role="group" aria-label="Withdrawal OTP Option">
                    <input type="radio" class="btn-check" name="otpsend" id="otpsendYes" value="Yes" autocomplete="off" {{ (Auth::user()->sendotpemail == 'Yes' || is_null(Auth::user()->sendotpemail)) ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary btn-sm px-3 fw-semibold" for="otpsendYes">{{ __('Yes') }}</label>

                    <input type="radio" class="btn-check" name="otpsend" id="otpsendNo" value="No" autocomplete="off" {{ Auth::user()->sendotpemail == 'No' ? 'checked' : '' }}>
                    <label class="btn btn-outline-secondary btn-sm px-3 fw-semibold" for="otpsendNo">{{ __('No') }}</label>
                </div>
            </div>

            <!-- Profit / ROI Email -->
            <div class="custom-radio-card d-flex align-items-center justify-content-between p-3 rounded-3 flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="metric-icon-circle success" style="width: 42px; height: 42px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 14.5px;">{{ __('Profit & ROI Notifications') }}</div>
                        <div class="text-muted small">{{ __('Send me an email alert whenever investment profits or yields are credited to my balance.') }}</div>
                    </div>
                </div>
                <div class="btn-group" role="group" aria-label="ROI Email Option">
                    <input type="radio" class="btn-check" name="roiemail" id="roiemailYes" value="Yes" autocomplete="off" {{ (Auth::user()->sendroiemail == 'Yes' || is_null(Auth::user()->sendroiemail)) ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary btn-sm px-3 fw-semibold" for="roiemailYes">{{ __('Yes') }}</label>

                    <input type="radio" class="btn-check" name="roiemail" id="roiemailNo" value="No" autocomplete="off" {{ Auth::user()->sendroiemail == 'No' ? 'checked' : '' }}>
                    <label class="btn btn-outline-secondary btn-sm px-3 fw-semibold" for="roiemailNo">{{ __('No') }}</label>
                </div>
            </div>

            <!-- Investment Plan Expiration -->
            <div class="custom-radio-card d-flex align-items-center justify-content-between p-3 rounded-3 flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="metric-icon-circle warning" style="width: 42px; height: 42px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                        <i class="fa-solid fa-hourglass-end"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 14.5px;">{{ __('Plan Expiration Alerts') }}</div>
                        <div class="text-muted small">{{ __('Send me an email notification when my active investment plans mature or expire.') }}</div>
                    </div>
                </div>
                <div class="btn-group" role="group" aria-label="Plan Expiration Option">
                    <input type="radio" class="btn-check" name="invplanemail" id="invplanemailYes" value="Yes" autocomplete="off" {{ (Auth::user()->sendinvplanemail == 'Yes' || is_null(Auth::user()->sendinvplanemail)) ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary btn-sm px-3 fw-semibold" for="invplanemailYes">{{ __('Yes') }}</label>

                    <input type="radio" class="btn-check" name="invplanemail" id="invplanemailNo" value="No" autocomplete="off" {{ Auth::user()->sendinvplanemail == 'No' ? 'checked' : '' }}>
                    <label class="btn btn-outline-secondary btn-sm px-3 fw-semibold" for="invplanemailNo">{{ __('No') }}</label>
                </div>
            </div>
        </div>

        <div class="mt-4 pt-2">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold rounded-pill" id="btnSavePreferences">
                <i class="fa-solid fa-floppy-disk me-2"></i> {{ __('Save Preferences') }}
            </button>
        </div>
    </form>
</div>

<script>
    (function() {
        var form = document.getElementById('updateemailpref');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var submitBtn = document.getElementById('btnSavePreferences');
            var originalHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Saving...';

            $.ajax({
                url: "{{ route('updateemail') }}",
                type: 'POST',
                data: $('#updateemailpref').serialize(),
                success: function(response) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHtml;
                    if (response.status === 200) {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Saved',
                                text: response.success || 'Email preferences updated successfully.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3500,
                                timerProgressBar: true
                            });
                        } else {
                            alert(response.success || 'Email preferences updated successfully.');
                        }
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Notice',
                                text: response.message || 'Unable to update preferences.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }
                    }
                },
                error: function(xhr) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHtml;
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while saving your preferences.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3500
                        });
                    } else {
                        alert('An error occurred while saving preferences.');
                    }
                }
            });
        });
    })();
</script>
