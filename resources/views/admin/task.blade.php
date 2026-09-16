@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('mtask') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 f-12">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to All Tasks
                </a>
            </div>
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-list-check text-primary me-2"></i> Create New Task
            </h3>
            <p class="text-muted mb-0 f-13">Delegate administrative assignments and responsibilities to staff members.</p>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 col-xl-7">
            <div class="card p-4 p-md-5 shadow-sm border-0 rounded-3">
                <div class="d-flex align-items-center gap-3 pb-3 mb-4 border-bottom">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 18px;">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                    <div>
                        <h5 class="f-w-700 text-dark mb-0">Task Specification</h5>
                        <small class="text-muted">Fill in assignment details and delegation timeline</small>
                    </div>
                </div>

                <form method="POST" action="{{ route('addtask') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth('admin')->User()->id }}">

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Task Title <span class="text-danger">*</span></label>
                            <input type="text" name="tasktitle" class="form-control" placeholder="e.g. Audit Pending KYC Documents" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Delegated Assignee <span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="delegation" required>
                                <option value="" disabled selected>Choose administrator...</option>
                                @foreach ($admin as $user)
                                    <option value="{{ $user->id }}">{{ $user->firstName }} {{ $user->lastName }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-13">Due / Deadline Date <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Priority Level <span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="priority" required>
                                <option value="Immediately">Immediately (Urgent)</option>
                                <option value="High">High</option>
                                <option value="Medium" selected>Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label f-w-600 f-13">Task Description & Instructions <span class="text-danger">*</span></label>
                            <textarea name="note" rows="4" class="form-control" placeholder="Provide full context, instructions, or deliverables expected..." required></textarea>
                        </div>

                        <div class="col-12 pt-3 text-end">
                            <a href="{{ route('mtask') }}" class="btn btn-light rounded-pill px-4 py-2 f-13 me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                                <i class="fa-solid fa-paper-plane me-1"></i> Assign Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
