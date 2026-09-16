@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Top Header -->
    <div class="row mb-4 align-items-center justify-content-between g-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('courses') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1 f-12">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Courses
                </a>
            </div>
            <h3 class="f-w-800 text-dark mb-1">
                <i class="fa-solid fa-book-open text-primary me-2"></i> {{ $course->course_title }}
            </h3>
            <p class="text-muted mb-0 f-13">Manage lesson chapters, video streams, and preview permissions for this course.</p>
        </div>
        <div class="col-md-auto d-flex align-items-center gap-2">
            <button class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm" type="button" data-bs-toggle="modal" data-bs-target="#newLessonModal">
                <i class="fa-solid fa-plus me-1"></i> Add New Lesson
            </button>
        </div>
    </div>

    <!-- Lessons Grid -->
    <div class="row g-4 mb-5">
        @forelse ($lessons as $less)
            @php
                $thumbSrc = str_starts_with($less->thumbnail, 'http') ? $less->thumbnail : asset('storage/' . $less->thumbnail);
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden d-flex flex-column">
                    <div style="height: 160px; overflow: hidden; background: #0f172a;" class="position-relative">
                        <img src="{{ $thumbSrc }}" class="w-100 h-100 object-fit-cover" alt="{{ $less->title }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&auto=format&fit=crop&q=80';">
                        <div class="position-absolute top-0 start-0 p-2">
                            <span class="badge bg-dark bg-opacity-75 rounded-pill px-2 py-1 f-11">
                                Chapter {{ $loop->iteration }}
                            </span>
                        </div>
                        <div class="position-absolute bottom-0 end-0 p-2">
                            <span class="badge bg-primary rounded-pill px-2 py-1 f-11 shadow">
                                <i class="fa-regular fa-clock me-1"></i> {{ $less->length }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-4 d-flex flex-column justify-content-between flex-grow-1">
                        <div>
                            <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                <h6 class="f-w-700 text-dark mb-0">{{ $less->title }}</h6>
                                @if($less->locked == 'true')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 f-10">
                                        Free Preview
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1 f-10">
                                        Locked
                                    </span>
                                @endif
                            </div>
                            <p class="text-muted f-13 mb-3" style="line-height: 1.5;">
                                {{ Str::limit(strip_tags($less->description), 80) }}
                            </p>
                        </div>

                        <div class="pt-3 border-top d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill w-100 py-1 f-12" data-bs-toggle="modal" data-bs-target="#editLessonModal{{ $less->id }}">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit Lesson
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 f-12" data-bs-toggle="modal" data-bs-target="#deleteLessonModal{{ $less->id }}" title="Delete Lesson">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Lesson Modal -->
            <div class="modal fade text-start" id="editLessonModal{{ $less->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header border-bottom pb-3">
                            <h5 class="modal-title f-w-700 text-dark">
                                <i class="fa-solid fa-pen-to-square text-primary me-2"></i> Edit Lesson: {{ $less->title }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('updatedlesson') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="lesson_id" value="{{ $less->id }}">
                            <div class="modal-body p-4">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label f-w-600 f-12">Lesson Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" value="{{ $less->title }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label f-w-600 f-12">Description <span class="text-danger">*</span></label>
                                        <textarea name="desc" rows="4" class="form-control" required>{{ $less->description }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label f-w-600 f-12">Video Stream URL (Vimeo, YouTube, etc.) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="videolink" value="{{ $less->video_link }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label f-w-600 f-12">Video Duration <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="length" value="{{ $less->length }}" placeholder="e.g. 15m 30s" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label f-w-600 f-12">Preview Access</label>
                                        <select name="preview" class="form-select form-control">
                                            <option value="true" {{ $less->locked == 'true' ? 'selected' : '' }}>Allow Preview (Free)</option>
                                            <option value="false" {{ $less->locked == 'false' ? 'selected' : '' }}>Requires Purchase</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label f-w-600 f-12">Replace Thumbnail (File)</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label f-w-600 f-12">Or Thumbnail URL</label>
                                        <input type="text" class="form-control" name="image_url" value="{{ $less->thumbnail }}">
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

            <!-- Delete Lesson Modal -->
            <div class="modal fade" id="deleteLessonModal{{ $less->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm text-center">
                    <div class="modal-content border-0 shadow-lg p-3">
                        <div class="modal-body pt-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; background: rgba(239, 68, 68, 0.12); color: #ef4444; font-size: 24px;">
                                <i class="fa-solid fa-trash-can"></i>
                            </div>
                            <h5 class="f-w-700 text-dark mb-2">Delete Lesson?</h5>
                            <p class="text-muted f-13 mb-4">
                                Are you sure you want to delete chapter <strong>{{ $less->title }}</strong>?
                            </p>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-light rounded-pill w-100 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                                <a href="{{ route('deletelesson', $less->id) }}" class="btn btn-danger rounded-pill w-100 py-2 f-13 f-w-700">
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
                        <i class="fa-solid fa-film"></i>
                    </div>
                    <h5 class="f-w-700 text-dark mb-1">No Lessons Added Yet</h5>
                    <p class="text-muted f-13 mb-4">Upload or link your first video chapter for {{ $course->course_title }}.</p>
                    <button class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm mx-auto" type="button" data-bs-toggle="modal" data-bs-target="#newLessonModal">
                        <i class="fa-solid fa-plus me-1"></i> Add First Lesson
                    </button>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- New Lesson Modal -->
<div class="modal fade" id="newLessonModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title f-w-700 text-dark">
                    <i class="fa-solid fa-plus text-primary me-2"></i> Add Lesson to {{ $course->course_title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('addlesson') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label f-w-600 f-12">Lesson Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="e.g. Chapter 1: Introduction to Candlestick Formations" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label f-w-600 f-12">Lesson Overview & Key Takeaways <span class="text-danger">*</span></label>
                            <textarea name="desc" rows="4" class="form-control" placeholder="Detailed lesson syllabus..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Video Link / Stream URL <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="videolink" placeholder="https://player.vimeo.com/video/..." required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label f-w-600 f-12">Video Duration <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="length" placeholder="e.g. 18m 45s" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label f-w-600 f-12">Preview Setting</label>
                            <select name="preview" class="form-select form-control">
                                <option value="false">Requires Purchase</option>
                                <option value="true">Allow Free Preview</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Lesson Thumbnail (File)</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Or Thumbnail URL</label>
                            <input type="text" class="form-control" name="image_url" placeholder="https://example.com/thumb.jpg">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-light rounded-pill px-3 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                        <i class="fa-solid fa-check me-1"></i> Save Lesson
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
