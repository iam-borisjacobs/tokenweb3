@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-tasks text-primary me-2"></i> Administrative Task Board
            </h3>
            <p class="text-muted mb-0 f-13">Monitor, update, and manage delegation across administrative personnel.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <a href="{{ route('task') }}" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                <i class="fa-solid fa-plus me-1"></i> Create New Task
            </a>
        </div>
    </div>

    <!-- Tasks Table Card -->
    <div class="card p-4 shadow-sm border-0 rounded-3 mb-5">
        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <h5 class="f-w-700 text-dark mb-0">System Tasks Directory</h5>
            <span class="badge bg-light-primary text-primary rounded-pill px-3 py-1 f-12 f-w-600">
                {{ count($tasks) }} Total Task{{ count($tasks) === 1 ? '' : 's' }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="f-12 f-w-700">Task Title</th>
                        <th class="f-12 f-w-700">Assigned To</th>
                        <th class="f-12 f-w-700">Timeline</th>
                        <th class="f-12 f-w-700">Priority</th>
                        <th class="f-12 f-w-700">Status</th>
                        <th class="f-12 f-w-700">Created On</th>
                        <th class="f-12 f-w-700 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td>
                                <div class="f-w-700 text-dark f-14 mb-0">{{ $task->title }}</div>
                                <small class="text-muted f-11" title="{{ $task->note }}">
                                    {{ Str::limit($task->note, 40) }}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-weight: 700; font-size: 12px;">
                                        {{ strtoupper(substr($task->tuser->firstName ?? 'A', 0, 1)) }}
                                    </div>
                                    <div class="f-13 f-w-600 text-dark">
                                        {{ $task->tuser->firstName ?? 'Staff' }} {{ $task->tuser->lastName ?? '' }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="f-12 text-muted">
                                    <span>{{ $task->start_date }}</span>
                                    <span class="mx-1">→</span>
                                    <span class="f-w-600 text-dark">{{ $task->end_date }}</span>
                                </div>
                            </td>
                            <td>
                                @if($task->priority == 'Immediately' || $task->priority == 'High')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        {{ $task->priority }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        {{ $task->priority ?? 'Medium' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($task->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 f-11 f-w-600">
                                        <i class="fa-solid fa-clock me-1"></i> Pending
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
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    @if ($task->status == 'Pending')
                                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-2 py-1 f-11" data-bs-toggle="modal" data-bs-target="#edittaskModal{{ $task->id }}">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                        </button>
                                    @endif

                                    <a href="{{ url('admin/dashboard/deltask') }}/{{ $task->id }}" class="btn btn-outline-danger btn-sm rounded-pill px-2 py-1 f-11" onclick="return confirm('Permanently delete this task?');" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>

                                <!-- Edit Task Modal -->
                                <div class="modal fade text-start" id="edittaskModal{{ $task->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-header border-bottom pb-3">
                                                <h5 class="modal-title f-w-700 text-dark">
                                                    <i class="fa-solid fa-pen-to-square text-primary me-2"></i> Edit Task: {{ $task->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('updatetask') }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $task->id }}">
                                                <div class="modal-body p-4">
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label f-w-600 f-12">Task Title <span class="text-danger">*</span></label>
                                                            <input type="text" name="tasktitle" value="{{ $task->title }}" class="form-control" required>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label f-w-600 f-12">Delegation <span class="text-danger">*</span></label>
                                                            <select class="form-select form-control" name="delegation" required>
                                                                @foreach ($admin as $user)
                                                                    <option value="{{ $user->id }}" {{ $user->id == $task->designation ? 'selected' : '' }}>
                                                                        {{ $user->firstName }} {{ $user->lastName }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label f-w-600 f-12">Start Date <span class="text-danger">*</span></label>
                                                            <input type="date" name="start_date" value="{{ $task->start_date }}" class="form-control" required>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label f-w-600 f-12">Due Date <span class="text-danger">*</span></label>
                                                            <input type="date" name="end_date" value="{{ $task->end_date }}" class="form-control" required>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label f-w-600 f-12">Priority <span class="text-danger">*</span></label>
                                                            <select class="form-select form-control" name="priority" required>
                                                                <option value="Immediately" {{ $task->priority == 'Immediately' ? 'selected' : '' }}>Immediately</option>
                                                                <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
                                                                <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                                                                <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label f-w-600 f-12">Instructions / Notes <span class="text-danger">*</span></label>
                                                            <textarea name="note" rows="4" class="form-control" required>{{ $task->note }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-top pt-3">
                                                    <button type="button" class="btn btn-light rounded-pill px-3 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                                                        Apply Changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-list-check f-32 mb-2 d-block text-muted opacity-50"></i>
                                No administrative tasks recorded. Click "Create New Task" above.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
