<!-- Top Up Modal -->
<div id="topupModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600">Credit/Debit {{ $user->name }} Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('topup') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label f-w-600">Amount</label>
                        <input class="form-control" placeholder="Enter amount" type="number" step="any" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Select where to Credit/Debit</label>
                        <select class="form-select" name="type" required>
                            <option value="" selected disabled>Select Column</option>
                            <option value="Bonus">Bonus</option>
                            <option value="Profit">Profit</option>
                            <option value="Ref_Bonus">Ref_Bonus</option>
                            <option value="balance">Account Balance</option>
                            <option value="Deposit">Deposit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Select credit to add, debit to subtract</label>
                        <select class="form-select" name="t_type" required>
                            <option value="">Select type</option>
                            <option value="Credit">Credit (Add)</option>
                            <option value="Debit">Debit (Subtract)</option>
                        </select>
                        <small class="text-muted d-block mt-1"><b>NOTE:</b> You cannot debit deposit</small>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /deposit for a plan Modal -->

<!-- send a single user email Modal-->
<div id="sendmailtooneuserModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600">Send Email to {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" method="post" action="{{ route('sendmailtooneuser') }}">
                @csrf
                <div class="modal-body">
                    <p class="text-muted f-13 mb-3">This message will be sent directly to {{ $user->name }} ({{ $user->email }}).</p>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Message</label>
                        <textarea placeholder="Type your message here..." class="form-control" name="message" rows="6" required></textarea>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Send Email</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /send a single user email Modal -->

<!-- Send in-app notification to single user Modal -->
<div id="sendNotifToOneUserModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">
                    <i class="fa-solid fa-bell text-primary me-2"></i> Send Notification to {{ $user->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" method="post" action="{{ route('admin.notifications.send') }}">
                @csrf
                <input type="hidden" name="recipient_type" value="selected">
                <input type="hidden" name="users[]" value="{{ $user->id }}">

                <div class="modal-body">
                    <p class="text-muted f-13 mb-3">This in-app notification will appear directly on <strong>{{ $user->name }}'s</strong> dashboard notification bell.</p>
                    
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Category / Type</label>
                        <select name="type" class="form-select" required>
                            <option value="info">Info (Blue)</option>
                            <option value="success">Success / Credit (Green)</option>
                            <option value="warning">Warning / Action Needed (Yellow)</option>
                            <option value="danger">Urgent / Alert (Red)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Notification Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Account Clearance Update" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Message Body <span class="text-danger">*</span></label>
                        <textarea placeholder="Type notification message..." class="form-control" name="message" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Action Link <small class="text-muted">(Optional)</small></label>
                        <input type="text" name="action_url" class="form-control" placeholder="e.g. /dashboard/deposits">
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="send_email" id="sendEmailSingleSwitch" value="1">
                        <label class="form-check-label f-13 f-w-600 cursor-pointer" for="sendEmailSingleSwitch">
                            Also send email copy to {{ $user->email }}
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-paper-plane me-1"></i> Dispatch Notification
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Send in-app notification to single user Modal -->

<!-- Trading History Modal -->
<div id="TradingModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600">Add Trading History for {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" method="post" action="{{ route('addhistory') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label f-w-600">Select Investment Plan</label>
                        <select class="form-select" name="plan">
                            <option value="" selected disabled>Select Plan</option>
                            @foreach ($pl as $plns)
                                <option value="{{ $plns->name }}">{{ $plns->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Amount</label>
                        <input type="number" step="any" name="amount" class="form-control" placeholder="Enter amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Type</label>
                        <select class="form-select" name="type" required>
                            <option value="" selected disabled>Select type</option>
                            <option value="Bonus">Bonus</option>
                            <option value="ROI">ROI</option>
                        </select>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Add History</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Trading History Modal -->

<!-- Edit user Modal -->
<div id="edituser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600">Edit {{ $user->name }} Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" method="post" action="{{ route('edituser') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label f-w-600">Username</label>
                        <input class="form-control" id="input1" value="{{ $user->username }}" type="text" name="username" required>
                        <small class="text-muted">Note: same username should be used in the referral link.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Fullname</label>
                        <input class="form-control" value="{{ $user->name }}" type="text" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Email</label>
                        <input class="form-control" value="{{ $user->email }}" type="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Phone Number</label>
                        <input class="form-control" value="{{ $user->phone }}" type="text" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Country</label>
                        <input class="form-control" value="{{ $user->country }}" type="text" name="country">
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600">Referral Link</label>
                        <input class="form-control" value="{{ $user->ref_link }}" type="text" name="ref_link" required>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Update Details</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    if (window.$ && $('#input1').length) {
        $('#input1').on('keypress', function(e) {
            return e.which !== 32;
        });
    }
</script>
<!-- /Edit user Modal -->

<!-- Reset user password Modal -->
<div id="resetpswdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="rounded-circle bg-light-warning text-warning d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                    <i class="fa fa-key f-20"></i>
                </div>
                <p class="f-14 mb-2">Are you sure you want to reset password for <strong>{{ $user->name }}</strong> to:</p>
                <span class="badge bg-light-primary text-primary f-14 px-3 py-2 font-monospace">user01236</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                <a class="btn btn-warning px-4" href="{{ url('admin/dashboard/resetpswd') }}/{{ $user->id }}">Reset Now</a>
            </div>
        </div>
    </div>
</div>
<!-- /Reset user password Modal -->

<!-- Switch useraccount Modal -->
<div id="switchuserModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600">Login as {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="rounded-circle bg-light-success text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                    <i class="fa fa-sign-in f-20"></i>
                </div>
                <p class="f-14 mb-0">You are about to log in as <strong>{{ $user->name }}</strong> ({{ $user->email }}). You will be redirected to their client dashboard.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success px-4" href="{{ url('admin/dashboard/switchuser') }}/{{ $user->id }}">Proceed</a>
            </div>
        </div>
    </div>
</div>
<!-- /Switch user account Modal -->

<!-- Clear account Modal -->
<div id="clearacctModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600">Clear Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="rounded-circle bg-light-danger text-danger d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                    <i class="fa fa-eraser f-20"></i>
                </div>
                <p class="f-14 mb-0">You are about to reset all balances for <strong>{{ $user->name }}</strong> back to <strong>{{ $settings->currency }}0.00</strong>. This action cannot be reversed.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger px-4" href="{{ url('admin/dashboard/clearacct') }}/{{ $user->id }}">Proceed</a>
            </div>
        </div>
    </div>
</div>
<!-- /Clear account Modal -->

<!-- Delete user Modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600 text-danger">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="rounded-circle bg-light-danger text-danger d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                    <i class="fa fa-trash f-20"></i>
                </div>
                <p class="f-14 mb-0">Are you sure you want to permanently delete <strong>{{ $user->name }}</strong>'s account? Everything associated with this account will be lost.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger px-4" href="{{ url('admin/dashboard/delsystemuser') }}/{{ $user->id }}">Yes, I'm sure</a>
            </div>
        </div>
    </div>
</div>
<!-- /Delete user Modal -->
