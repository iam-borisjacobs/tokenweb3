@extends('layouts.dash')
@section('title', 'Notifications & Alerts')

@section('content')
<div class="container-fluid mb-4">
    <!-- Header row -->
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col-sm-auto">
            <h3 class="f-w-800 text-dark mb-1" style="letter-spacing: -0.02em;">
                <i class="fa-solid fa-bell text-primary me-2"></i> Notifications & Alerts
            </h3>
            <p class="text-muted mb-0 f-13">Stay up to date with account updates, security notices, and market announcements.</p>
        </div>
        <div class="col-sm-auto d-flex align-items-center gap-2">
            @if($unreadCount > 0)
                <button type="button" class="btn btn-outline-primary rounded-pill px-3 py-2 f-13 f-w-600 shadow-sm" onclick="markAllNotificationsRead()">
                    <i class="fa-solid fa-check-double me-1"></i> Mark All as Read
                </button>
            @endif
            <a href="{{ route('dashboard') }}" class="btn btn-light rounded-pill px-3 py-2 f-13 f-w-600 shadow-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Filter Pills -->
    <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
        <a href="{{ route('notification', ['filter' => 'all']) }}" class="btn {{ $filter === 'all' ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3 py-1 f-12 f-w-600">
            All Notifications
        </a>
        <a href="{{ route('notification', ['filter' => 'unread']) }}" class="btn {{ $filter === 'unread' ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3 py-1 f-12 f-w-600 position-relative">
            Unread
            @if($unreadCount > 0)
                <span class="badge bg-danger rounded-pill ms-1">{{ $unreadCount }}</span>
            @endif
        </a>
        <a href="{{ route('notification', ['filter' => 'read']) }}" class="btn {{ $filter === 'read' ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3 py-1 f-12 f-w-600">
            Read
        </a>
    </div>

    <!-- Notifications List -->
    <div class="row g-3">
        @forelse($notifications as $item)
            <div class="col-12" id="notif-row-{{ $item->id }}">
                <div class="card border-0 shadow-sm p-3 p-md-4 rounded-3 {{ !$item->is_read ? 'border-start border-primary border-4' : '' }}" style="{{ !$item->is_read ? 'background: rgba(99, 98, 231, 0.04);' : '' }}">
                    <div class="d-flex flex-column flex-md-row align-items-md-start justify-content-between gap-3">
                        <div class="d-flex align-items-start gap-3 flex-grow-1">
                            <!-- Icon Circle -->
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; font-size: 18px; {{ $item->type === 'success' ? 'background: rgba(16, 185, 129, 0.12); color: #10b981;' : ($item->type === 'warning' ? 'background: rgba(245, 158, 11, 0.12); color: #d97706;' : ($item->type === 'danger' ? 'background: rgba(239, 68, 68, 0.12); color: #ef4444;' : 'background: rgba(99, 98, 231, 0.12); color: #6362e7;')) }}">
                                <i class="fa-solid {{ $item->getTypeIcon() }}"></i>
                            </div>

                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                    <h6 class="f-w-700 text-dark mb-0">{{ $item->title ?? 'Account Notice' }}</h6>
                                    <span class="badge {{ $item->getTypeBadgeClass() }} rounded-pill px-2 py-1 f-10 f-w-600 text-capitalize">
                                        {{ $item->type ?? 'info' }}
                                    </span>
                                    @if(!$item->is_read)
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1 f-10 f-w-600">New</span>
                                    @endif
                                </div>
                                <p class="text-muted f-13 mb-2" style="line-height: 1.6; max-width: 780px;">
                                    {{ $item->message }}
                                </p>
                                <div class="d-flex align-items-center gap-3 text-muted f-11">
                                    <span><i class="fa-regular fa-clock me-1"></i> {{ $item->created_at->diffForHumans() }}</span>
                                    <span>•</span>
                                    <span>{{ $item->created_at->format('M d, Y h:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action buttons -->
                        <div class="d-flex align-items-center gap-2 align-self-end align-self-md-start flex-shrink-0">
                            @if(!empty($item->action_url))
                                <a href="{{ $item->action_url }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 f-12 f-w-600" onclick="markSingleRead({{ $item->id }})">
                                    View Action <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            @endif

                            @if(!$item->is_read)
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2 py-1 f-11" onclick="markSingleRead({{ $item->id }})" title="Mark as read">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            @endif

                            @if($item->user_id == Auth::id())
                                <a href="{{ route('notification.delete', $item->id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1 f-11" title="Dismiss notification" onclick="return confirm('Dismiss this notification?');">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm p-5 text-center rounded-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px; background: rgba(99, 98, 231, 0.1); color: #6362e7; font-size: 26px;">
                        <i class="fa-solid fa-bell-slash"></i>
                    </div>
                    <h5 class="f-w-700 text-dark mb-1">No Notifications Found</h5>
                    <p class="text-muted f-13 mx-auto mb-3" style="max-width: 420px;">
                        You have no {{ $filter !== 'all' ? $filter : '' }} notifications at this time. When important events or broadcasts occur, they will appear right here.
                    </p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm mx-auto">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $notifications->links() }}
        </div>
    @endif
</div>

<script>
    function markSingleRead(id) {
        fetch('{{ url("dashboard/notification/mark-read") }}/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(function(res) {
            return res.json();
        }).then(function(data) {
            if (data.success) {
                var row = document.getElementById('notif-row-' + id);
                if (row) {
                    var card = row.querySelector('.card');
                    if (card) {
                        card.classList.remove('border-start', 'border-primary', 'border-4');
                        card.style.background = '';
                        var newBadge = card.querySelector('.bg-primary-subtle');
                        if (newBadge) newBadge.remove();
                    }
                }
            }
        }).catch(function(e) {
            console.error(e);
        });
    }

    function markAllNotificationsRead() {
        fetch('{{ route("notification.markallread") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(function(res) {
            return res.json();
        }).then(function(data) {
            if (data.success) {
                window.location.reload();
            }
        }).catch(function(e) {
            console.error(e);
        });
    }
</script>
@endsection
