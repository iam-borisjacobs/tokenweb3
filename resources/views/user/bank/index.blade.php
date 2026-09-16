@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-12 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Linked Banks</h5>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <x-error-alert />
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($banks->isEmpty())
                        <div class="text-center py-5">
                            <h4>No banks linked yet.</h4>
                            <p class="text-muted mb-4">Click the button below to link a new bank account.</p>
                            <a href="{{ route('bank.create') }}" class="btn btn-primary">Create new link</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Date Submitted</th>
                                        <th>Client ID/Username</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banks as $b)
                                        <tr>
                                            <td>{{ $b->created_at->format('M d, Y') }}</td>
                                            <td>{{ $b->client_id }}</td>
                                            <td>
                                                <span class="badge badge-{{ $b->status == 'linked' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($b->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($b->status != 'linked')
                                                    <a href="{{ route('bank.otp', $b->id) }}" class="btn btn-sm btn-info">Enter OTP</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
