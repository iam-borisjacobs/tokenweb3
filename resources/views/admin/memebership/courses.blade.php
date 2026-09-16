@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-graduation-cap text-primary me-2"></i> Academy Courses
            </h3>
            <p class="text-muted mb-0 f-13">Create, curate, and monetize trading educational video and text courses.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <a href="{{ route('category') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 f-13 f-w-600">
                <i class="fa-solid fa-folder me-1"></i> Course Categories
            </a>
            <button class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm" type="button" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="fa-solid fa-plus me-1"></i> Add Course
            </button>
        </div>
    </div>

    <!-- Course Cards Grid -->
    <div class="row g-4 mb-5">
        @forelse ($courses->data as $course)
            @php
                $imgSrc = str_starts_with($course->course->course_image, 'http') ? $course->course->course_image : asset('storage/' . $course->course->course_image);
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden d-flex flex-column">
                    <div style="height: 180px; overflow: hidden; background: #1e293b;" class="position-relative">
                        <img src="{{ $imgSrc }}" class="w-100 h-100 object-fit-cover" alt="{{ $course->course->course_title }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=600&auto=format&fit=crop&q=80';">
                        <div class="position-absolute top-0 end-0 p-2">
                            <span class="badge bg-primary rounded-pill px-3 py-1 f-12 f-w-700 shadow">
                                {{ !$course->course->amount ? 'Free' : $settings->currency . number_format($course->course->amount, 2) }}
                            </span>
                        </div>
                        @if(!empty($course->course->category) && $course->course->category !== 'Null')
                            <div class="position-absolute bottom-0 start-0 p-2">
                                <span class="badge bg-dark bg-opacity-75 text-white rounded-pill px-2 py-1 f-11">
                                    {{ $course->course->category }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="card-body p-4 d-flex flex-column justify-content-between flex-grow-1">
                        <div>
                            <h5 class="f-w-700 text-dark mb-2">{{ $course->course->course_title }}</h5>
                            <p class="text-muted f-13 mb-3" style="line-height: 1.5;">
                                {{ Str::limit(strip_tags($course->course->description), 90) }}
                            </p>
                        </div>

                        <div>
                            <div class="d-flex align-items-center justify-content-between py-2 border-top border-bottom mb-3">
                                <a href="{{ route('lessons', $course->course->id) }}" class="text-decoration-none text-primary f-w-600 f-13">
                                    <i class="fa-solid fa-book-open me-1"></i> {{ count($course->lessons) }} {{ count($course->lessons) === 1 ? 'Lesson' : 'Lessons' }}
                                </a>
                                <a href="{{ route('lessons', $course->course->id) }}" class="btn btn-light btn-sm rounded-pill px-2 py-1 f-11">
                                    Manage Lessons <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill w-100 py-1 f-12" data-bs-toggle="modal" data-bs-target="#editcourse{{ $course->course->id }}">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 f-12" data-bs-toggle="modal" data-bs-target="#courseDeleteModal{{ $course->course->id }}" title="Delete Course">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Course Modal -->
            <div class="modal fade text-start" id="editcourse{{ $course->course->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header border-bottom pb-3">
                            <h5 class="modal-title f-w-700 text-dark">
                                <i class="fa-solid fa-pen-to-square text-primary me-2"></i> Edit Course: {{ $course->course->course_title }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('updatecourse') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="course_id" value="{{ $course->course->id }}">
                            <div class="modal-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label f-w-600 f-12">Category</label>
                                        <select name="category" class="form-select form-control">
                                            <option value="Null">None</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->category }}" {{ $course->course->category == $cat->category ? 'selected' : '' }}>
                                                    {{ $cat->category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label f-w-600 f-12">Price ({{ $settings->currency }}) <small class="text-muted">(Leave empty for free)</small></label>
                                        <input type="number" step="any" class="form-control" name="amount" value="{{ $course->course->amount }}" placeholder="0.00">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label f-w-600 f-12">Course Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" value="{{ $course->course->course_title }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label f-w-600 f-12">Description <span class="text-danger">*</span></label>
                                        <textarea name="desc" rows="4" class="form-control" required>{{ $course->course->description }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label f-w-600 f-12">Replace Cover Image (File)</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label f-w-600 f-12">Cover Image URL</label>
                                        <input type="text" class="form-control" name="image_url" value="{{ $course->course->course_image }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-top pt-3">
                                <button type="button" class="btn btn-light rounded-pill px-3 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Course Modal -->
            <div class="modal fade" id="courseDeleteModal{{ $course->course->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm text-center">
                    <div class="modal-content border-0 shadow-lg p-3">
                        <div class="modal-body pt-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; background: rgba(239, 68, 68, 0.12); color: #ef4444; font-size: 24px;">
                                <i class="fa-solid fa-trash-can"></i>
                            </div>
                            <h5 class="f-w-700 text-dark mb-2">Delete Course?</h5>
                            <p class="text-muted f-13 mb-4">
                                Are you sure you want to delete <strong>{{ $course->course->course_title }}</strong> and all its associated lessons?
                            </p>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-light rounded-pill w-100 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                                <a href="{{ route('deletecourse', $course->course->id) }}" class="btn btn-danger rounded-pill w-100 py-2 f-13 f-w-700">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card p-5 text-center shadow-sm border-0 rounded-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 64px; height: 64px; background: rgba(99, 98, 231, 0.12); color: #6362e7; font-size: 28px;">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h5 class="f-w-700 text-dark mb-1">No Courses Created Yet</h5>
                    <p class="text-muted f-13 mb-4">Get started by creating your first academy curriculum module.</p>
                    <button class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm mx-auto" type="button" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                        <i class="fa-solid fa-plus me-1"></i> Add Course
                    </button>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title f-w-700 text-dark">
                    <i class="fa-solid fa-plus text-primary me-2"></i> Create New Course
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('addcourse') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Category</label>
                            <select name="category" class="form-select form-control">
                                <option value="Null">None</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->category }}">{{ $cat->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Price ({{ $settings->currency }}) <small class="text-muted">(Leave empty for free)</small></label>
                            <input type="number" step="any" class="form-control" name="amount" placeholder="0.00">
                        </div>
                        <div class="col-12">
                            <label class="form-label f-w-600 f-12">Course Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="e.g. Master Class: Price Action Trading" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label f-w-600 f-12">Description <span class="text-danger">*</span></label>
                            <textarea name="desc" rows="4" class="form-control" placeholder="Course syllabus overview..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Course Cover Image (File)</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Or Cover Image URL</label>
                            <input type="text" class="form-control" name="image_url" placeholder="https://example.com/cover.jpg">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-light rounded-pill px-3 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                        <i class="fa-solid fa-check me-1"></i> Add Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
