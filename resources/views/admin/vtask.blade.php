@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-clipboard-check text-primary me-2"></i> My Assigned Tasks
            </h3>
            <p class="text-muted mb-0 f-13">View personal operational deliverables, instructions, and mark them as resolved.</p>
        </div>
        <div class="col-md-auto">
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-2 f-12 f-w-600">
                <i class="fa-solid fa-list-check me-1"></i> {{ count($tasks) }} Assigned Task{{ count($tasks) === 1 ? '' : 's' }}
            </span>
        </div>
    </div>

    <!-- Tasks Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">My Assignments Queue</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Task Title</th>
                        <th class="f-12 f-w-700">Instructions / Notes</th>
                        <th class="f-12 f-w-700">Timeline</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700">Assigned On</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td>
                                <div class="f-w-700 text-dark f-14 mb-0">{{ $task->title }}</div>
                            </td>
                            <td>
                                <p class="text-muted f-13 mb-0" style="max-width: 320px;">
                                    {{ $task->note }}
                                </p>
                            </td>
                            <td>
                                <div class="f-12 text-muted">
                                    <span>{{ $task->start_date }}</span>
                                    <span class="mx-1">→</span>
                                    <span class="f-w-600 text-dark">{{ $task->end_date }}</span>
                                </div>
                            </td>
                            <td>
                                @if ($task->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-clock me-1"></i> In Progress
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-circle-check me-1"></i> Completed
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted f-12 text-nowrap">
                                {{ $task->created_at ? $task->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="text-end">
                                @if ($task->status == 'Pending')
                                    <a href="{{ url('admin/dashboard/markdone') }}/{{ $task->id }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-1 f-12 f-w-600" onclick="return confirm('Mark this task as completed?');">
                                        <i class="fa-solid fa-check me-1"></i> Mark as Done
                                    </a>
                                @else
                                    <span class="text-muted f-12"><i class="fa-solid fa-check-double text-success me-1"></i> Resolved</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-check-circle f-32 mb-2 d-block text-muted opacity-50"></i>
                                You have no outstanding tasks assigned to you right now.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
