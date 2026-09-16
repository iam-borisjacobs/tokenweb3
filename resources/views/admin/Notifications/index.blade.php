@extends('layouts.app')

@section('styles')
    @parent
    <style>
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            min-height: 44px !important;
            padding: 4px 8px !important;
        }
        body.dark-only .select2-container--default .select2-selection--multiple {
            background-color: #1a202c !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: var(--theme-default, #6362e7) !important;
            box-shadow: 0 0 0 0.2rem rgba(99, 98, 231, 0.15) !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgba(99, 98, 231, 0.12) !important;
            border: 1px solid rgba(99, 98, 231, 0.3) !important;
            color: var(--theme-default, #6362e7) !important;
            border-radius: 6px !important;
            padding: 2px 8px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
        }
        body.dark-only .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgba(99, 98, 231, 0.25) !important;
            color: #c7d2fe !important;
        }
        body.dark-only .select2-dropdown {
            background-color: #1a202c !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #f1f5f9 !important;
        }
        body.dark-only .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: var(--theme-default, #6362e7) !important;
            color: #ffffff !important;
        }

        /* Type Selection Radio Cards */
        .type-radio-btn {
            display: none;
        }
        .type-radio-card {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
        }
        body.dark-only .type-radio-card {
            border-color: rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.02);
            color: #e2e8f0;
        }
        .type-radio-btn:checked + .type-radio-card.type-info {
            border-color: #3b82f6;
            background-color: rgba(59, 130, 246, 0.1);
            color: #2563eb;
        }
        .type-radio-btn:checked + .type-radio-card.type-success {
            border-color: #10b981;
            background-color: rgba(16, 185, 129, 0.1);
            color: #059669;
        }
        .type-radio-btn:checked + .type-radio-card.type-warning {
            border-color: #f59e0b;
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
        }
        .type-radio-btn:checked + .type-radio-card.type-danger {
            border-color: #ef4444;
            background-color: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        /* Stat Counter Cards */
        .stat-metric-card {
            border-radius: 12px;
            padding: 16px 20px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        body.dark-only .stat-metric-card {
            background: #1a202c;
            border-color: rgba(255, 255, 255, 0.08);
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header & Title -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-700 mb-1">
                <i class="fa-solid fa-bullhorn text-primary me-2"></i> Broadcast & Notifications
            </h3>
            <p class="text-muted mb-0 f-13">Send instant in-app alerts, trading notices, and announcements to all users or selected individuals.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12 f-w-600">
                <i class="fa-solid fa-bell me-1"></i> Live Notification Dispatcher
            </span>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-metric-card shadow-sm">
                <div>
                    <span class="text-muted f-12 f-w-600 d-block mb-1">Total Sent</span>
                    <h4 class="f-w-800 mb-0">{{ number_format($stats['total_sent']) }}</h4>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 18px;">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-metric-card shadow-sm">
                <div>
                    <span class="text-muted f-12 f-w-600 d-block mb-1">Global Broadcasts</span>
                    <h4 class="f-w-800 mb-0 text-primary">{{ number_format($stats['broadcast_count']) }}</h4>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(14, 165, 233, 0.12); color: #0284c7; font-size: 18px;">
                    <i class="fa-solid fa-broadcast-tower"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-metric-card shadow-sm">
                <div>
                    <span class="text-muted f-12 f-w-600 d-block mb-1">Direct User Alerts</span>
                    <h4 class="f-w-800 mb-0 text-success">{{ number_format($stats['user_specific_count']) }}</h4>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.12); color: #10b981; font-size: 18px;">
                    <i class="fa-solid fa-user-check"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-metric-card shadow-sm">
                <div>
                    <span class="text-muted f-12 f-w-600 d-block mb-1">Registered Users</span>
                    <h4 class="f-w-800 mb-0 text-warning">{{ number_format($users->count()) }}</h4>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(245, 158, 11, 0.12); color: #d97706; font-size: 18px;">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Composition Form -->
    <div class="card p-4 shadow-sm mb-4 border-0">
        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
            <div class="d-flex align-items-center gap-2">
                <span class="rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; background: rgba(99, 98, 231, 0.12); color: #6362e7;">
                    <i class="fa-solid fa-pen-nib"></i>
                </span>
                <h5 class="f-w-700 text-dark mb-0">Create New Notification</h5>
            </div>
            <small class="text-muted f-12">Dispatched immediately to recipient bell dropdown</small>
        </div>

        <form method="POST" action="{{ route('admin.notifications.send') }}" id="sendNotificationForm">
            @csrf

            <div class="row g-3">
                <!-- 1. Recipient Audience Selector -->
                <div class="col-12">
                    <label class="form-label f-w-600 f-13">Target Audience <span class="text-danger">*</span></label>
                    <div class="d-flex flex-wrap gap-2">
                        <div>
                            <input type="radio" class="btn-check" name="recipient_type" id="recipientAll" value="all" checked onchange="toggleRecipientType('all')">
                            <label class="btn btn-outline-primary rounded-pill px-3 py-2 f-13 f-w-600" for="recipientAll">
                                <i class="fa-solid fa-bullhorn me-1"></i> All Users (Broadcast)
                            </label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="recipient_type" id="recipientSelected" value="selected" onchange="toggleRecipientType('selected')">
                            <label class="btn btn-outline-primary rounded-pill px-3 py-2 f-13 f-w-600" for="recipientSelected">
                                <i class="fa-solid fa-user-check me-1"></i> Pick Specific User(s)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Specific Users Multi-Select Container (Initially Hidden) -->
                <div class="col-12" id="specificUsersWrapper" style="display: none;">
                    <label class="form-label f-w-600 f-13">
                        Select Recipient(s) <span class="text-danger">*</span>
                    </label>
                    <select name="users[]" id="usersSelect" class="form-control select2" multiple="multiple" style="width: 100%;" data-placeholder="Search and select one or more users...">
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">
                                {{ $u->name }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted f-11 mt-1 d-block">
                        <i class="fa-solid fa-circle-info text-info me-1"></i> You can type to search by user name or email address.
                    </small>
                </div>

                <!-- 2. Notification Category / Type -->
                <div class="col-12">
                    <label class="form-label f-w-600 f-13">Category / Priority <span class="text-danger">*</span></label>
                    <div class="row g-2">
                        <div class="col-6 col-md-3">
                            <input type="radio" name="type" id="typeInfo" value="info" class="type-radio-btn" checked>
                            <label for="typeInfo" class="type-radio-card type-info">
                                <i class="fa-solid fa-circle-info f-16 text-primary"></i>
                                <span>Information</span>
                            </label>
                        </div>
                        <div class="col-6 col-md-3">
                            <input type="radio" name="type" id="typeSuccess" value="success" class="type-radio-btn">
                            <label for="typeSuccess" class="type-radio-card type-success">
                                <i class="fa-solid fa-circle-check f-16 text-success"></i>
                                <span>Success / Notice</span>
                            </label>
                        </div>
                        <div class="col-6 col-md-3">
                            <input type="radio" name="type" id="typeWarning" value="warning" class="type-radio-btn">
                            <label for="typeWarning" class="type-radio-card type-warning">
                                <i class="fa-solid fa-triangle-exclamation f-16 text-warning"></i>
                                <span>Action Needed</span>
                            </label>
                        </div>
                        <div class="col-6 col-md-3">
                            <input type="radio" name="type" id="typeDanger" value="danger" class="type-radio-btn">
                            <label for="typeDanger" class="type-radio-card type-danger">
                                <i class="fa-solid fa-circle-exclamation f-16 text-danger"></i>
                                <span>Urgent / Alert</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 3. Notification Title -->
                <div class="col-md-7">
                    <label class="form-label f-w-600 f-13">Notification Title / Heading <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fa-solid fa-heading text-muted"></i>
                        </span>
                        <input type="text" name="title" class="form-control border-start-0" placeholder="e.g. Market Surge: New BTC Trading Pair Live" required>
                    </div>
                </div>

                <!-- 4. Optional Action Link -->
                <div class="col-md-5">
                    <label class="form-label f-w-600 f-13">Target Link / URL <small class="text-muted">(Optional)</small></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fa-solid fa-link text-muted"></i>
                        </span>
                        <input type="text" name="action_url" class="form-control border-start-0" placeholder="e.g. /dashboard/deposits or /dashboard/connect-wallet">
                    </div>
                </div>

                <!-- 5. Message Content -->
                <div class="col-12">
                    <label class="form-label f-w-600 f-13">Notification Message Body <span class="text-danger">*</span></label>
                    <textarea name="message" class="form-control" rows="4" placeholder="Enter clear, concise notification content for the recipient..." required></textarea>
                </div>

                <!-- 6. Options: Email Mirror -->
                <div class="col-12">
                    <div class="form-check form-switch d-inline-flex align-items-center gap-2 ps-0">
                        <input class="form-check-input ms-0 me-2" type="checkbox" name="send_email" id="sendEmailSwitch" value="1">
                        <label class="form-check-label f-13 f-w-600 cursor-pointer" for="sendEmailSwitch">
                            <i class="fa-solid fa-envelope text-primary me-1"></i> Also deliver an email copy to recipient(s)
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12 text-end pt-2">
                    <button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm" id="submitNotifBtn" onclick="confirmSendNotification()">
                        <i class="fa-solid fa-paper-plane me-1"></i> Send Notification Now
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Notification History Table -->
    <div class="card p-4 shadow-sm border-0">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">
                <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> Sent Notification History
            </h5>
            <span class="text-muted f-12">Latest {{ $notifications->total() }} dispatched alerts</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Date & Time</th>
                        <th class="f-12 f-w-700">Recipient</th>
                        <th class="f-12 f-w-700">Type</th>
                        <th class="f-12 f-w-700">Title & Message</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notifications as $notif)
                        <tr>
                            <td class="f-12 text-muted text-nowrap">
                                <div>{{ $notif->created_at->format('M d, Y') }}</div>
                                <small class="text-muted">{{ $notif->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                @if($notif->user)
                                    <a href="{{ route('viewuser', $notif->user->id) }}" class="text-decoration-none f-w-600 f-13">
                                        <i class="fa-solid fa-user me-1 text-primary"></i> {{ $notif->user->name }}
                                    </a>
                                    <small class="text-muted d-block f-11">{{ $notif->user->email }}</small>
                                @else
                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill f-11 f-w-600">
                                        <i class="fa-solid fa-bullhorn me-1"></i> All Users
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $notif->getTypeBadgeClass() }} px-2 py-1 rounded-pill f-11 f-w-600 text-capitalize">
                                    <i class="fa-solid {{ $notif->getTypeIcon() }} me-1"></i> {{ $notif->type ?? 'info' }}
                                </span>
                            </td>
                            <td>
                                <div class="f-w-700 f-13 text-dark mb-1">{{ $notif->title ?? 'Notification' }}</div>
                                <p class="text-muted f-12 mb-0" style="max-width: 420px;">
                                    {{ Str::limit($notif->message, 110) }}
                                </p>
                                @if(!empty($notif->action_url))
                                    <small class="text-primary f-11 mt-1 d-inline-block">
                                        <i class="fa-solid fa-link me-1"></i> {{ $notif->action_url }}
                                    </small>
                                @endif
                            </td>
                            <td>
                                @if($notif->is_read)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill f-11">
                                        <i class="fa-solid fa-check-double me-1"></i> Read
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill f-11">
                                        <i class="fa-solid fa-envelope me-1"></i> Unread
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.notifications.delete', $notif->id) }}" class="btn btn-outline-danger btn-sm rounded-pill px-2 py-1" onclick="return confirm('Are you sure you want to delete this notification record?');" title="Delete notification">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-inbox f-32 mb-2 d-block text-muted opacity-50"></i>
                                No notifications dispatched yet. Use the form above to send your first broadcast or user alert.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-end">
            {{ $notifications->links() }}
        </div>
    </div>
</div>

<script>
    function toggleRecipientType(type) {
        var wrapper = document.getElementById('specificUsersWrapper');
        if (type === 'selected') {
            wrapper.style.display = 'block';
            if (typeof $ !== 'undefined' && $('#usersSelect').length) {
                $('#usersSelect').select2({
                    placeholder: 'Search and select one or more users...',
                    width: '100%'
                });
            }
        } else {
            wrapper.style.display = 'none';
        }
    }

    function confirmSendNotification() {
        var form = document.getElementById('sendNotificationForm');
        var title = form.querySelector('[name="title"]').value.trim();
        var message = form.querySelector('[name="message"]').value.trim();
        var isSelected = document.getElementById('recipientSelected').checked;

        if (!title) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Title',
                text: 'Please enter a notification title.',
                confirmButtonColor: '#6362e7'
            });
            return;
        }

        if (!message) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Message',
                text: 'Please enter the notification message body.',
                confirmButtonColor: '#6362e7'
            });
            return;
        }

        if (isSelected) {
            var selectedUsers = $('#usersSelect').val();
            if (!selectedUsers || selectedUsers.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Recipients Selected',
                    text: 'Please select at least one user from the list.',
                    confirmButtonColor: '#6362e7'
                });
                return;
            }
        }

        var audienceText = isSelected ? 'selected user(s)' : 'ALL registered users (Broadcast)';

        Swal.fire({
            title: 'Send Notification?',
            text: 'This notification will be dispatched immediately to ' + audienceText + '.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6362e7',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Yes, Send Now'
        }).then(function(result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof $ !== 'undefined' && $('#usersSelect').length) {
            $('#usersSelect').select2({
                placeholder: 'Search and select one or more users...',
                width: '100%'
            });
        }
    });
</script>
@endsection
