@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header & Breadcrumb -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('madmin') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 f-12">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Managers
                </a>
            </div>
            <h3 class="f-w-800 text-dark mb-1">Add New Manager</h3>
            <p class="text-muted mb-0 f-13">Create a new administrative user and grant system access privileges.</p>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 col-xl-7">
            <div class="card p-4 p-md-5 shadow-sm border-0 rounded-3">
                <div class="d-flex align-items-center gap-3 pb-3 mb-4 border-bottom">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 18px;">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <h5 class="f-w-700 text-dark mb-0">Manager Account Details</h5>
                        <small class="text-muted">Fill in the required information to provision this user</small>
                    </div>
                </div>

                <form method="POST" action="{{ url('admin/dashboard/saveadmin') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" placeholder="e.g. John" required>
                            @error('fname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('l_name') is-invalid @enderror" name="l_name" value="{{ old('l_name') }}" placeholder="e.g. Doe" required>
                            @error('l_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-regular fa-envelope text-muted"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="manager@example.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Phone Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-phone text-muted"></i></span>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Administrative Role / Type <span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="type" required>
                                <option value="Super Admin" {{ old('type') === 'Super Admin' ? 'selected' : '' }}>Super Admin — Full system access & settings</option>
                                <option value="Admin" {{ old('type') === 'Admin' ? 'selected' : '' }}>Admin — User & transaction management</option>
                                <option value="Conversion Agent" {{ old('type') === 'Conversion Agent' ? 'selected' : '' }}>Conversion Agent — Support & user lead tracking</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="adminPassword" placeholder="Minimum 6 characters" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassVisibility('adminPassword', this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Confirm Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password_confirmation" id="adminPasswordConfirm" placeholder="Re-enter password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassVisibility('adminPasswordConfirm', this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-12 pt-3 text-end">
                            <a href="{{ route('madmin') }}" class="btn btn-light rounded-pill px-4 py-2 f-13 me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                                <i class="fa-solid fa-user-plus me-1"></i> Create Manager Account
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassVisibility(inputId, btn) {
        var input = document.getElementById(inputId);
        if (!input) return;
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            if (icon) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        } else {
            input.type = 'password';
            if (icon) {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    }
</script>
@endsection
