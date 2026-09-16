@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-regular fa-calendar-days text-primary me-2"></i> Calendar & Task Schedule
            </h3>
            <p class="text-muted mb-0 f-13">Manage appointments, reminders, and daily administrative agenda.</p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card p-4 shadow-sm border-0 rounded-3">
                <div class="table-responsive">
                    <script src="//localendar.com/public/Victory33404?current_only=Y&include=Y&dynamic=Y"></script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
