@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-tags text-primary me-2"></i> Course Categories
            </h3>
            <p class="text-muted mb-0 f-13">Organize and group educational academy courses into structured modules.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <a href="{{ route('courses') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-13 f-w-600">
                <i class="fa-solid fa-graduation-cap me-1"></i> Back to Courses
            </a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Add Category Form -->
        <div class="col-lg-4">
            <div class="card p-4 shadow-sm border-0 rounded-3">
                <h5 class="f-w-700 text-dark pb-3 mb-3 border-bottom">
                    <i class="fa-solid fa-plus text-primary me-2"></i> Add New Category
                </h5>
                <form action="{{ route('addcategory') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="category" placeholder="e.g. Technical Analysis" required>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 f-13 f-w-700 shadow-sm">
                        <i class="fa-solid fa-check me-1"></i> Save Category
                    </button>
                </form>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="col-lg-8">
            <div class="card p-4 shadow-sm border-0 rounded-3">
                <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
                    <h5 class="f-w-700 text-dark mb-0">Existing Categories</h5>
                    <span class="badge bg-light-primary text-primary rounded-pill px-3 py-1 f-12 f-w-600">
                        {{ count($categories) }} Categories
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="f-12 f-w-700">Category Name</th>
                                <th class="f-12 f-w-700 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $item)
                                <tr>
                                    <td>
                                        <div class="f-w-700 text-dark f-14">
                                            <i class="fa-solid fa-folder text-warning me-2"></i> {{ $item->category->category }}
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('deletecategory', $item->category->id) }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 f-11" onclick="return confirm('Delete this category?');">
                                            <i class="fa-solid fa-trash-can me-1"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-5 text-muted">
                                        No course categories created yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
