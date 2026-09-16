@extends('layouts.dash')
@section('title', $title)

@section('content')
<div class="container-fluid mb-4">
    <!-- Header Row -->
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col-sm-auto d-flex align-items-center gap-3">
            <a href="{{ route('user.courses') }}" class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" title="Back to Courses">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h3 class="f-w-800 text-dark mb-1" style="letter-spacing: -0.02em;">
                    {{ $course->course_title }}
                </h3>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light-primary text-primary px-2 py-1 rounded-pill f-11">
                        {{ $course->category }}
                    </span>
                    <span class="text-muted f-12">&bull;</span>
                    <span class="text-muted f-12">Updated {{ \Carbon\Carbon::parse($course->updated_at)->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <x-danger-alert />
    <x-success-alert />

    <div class="row g-4">
        <!-- Left Column: Course Details & Lessons -->
        <div class="col-lg-8">
            <!-- Course Overview Card -->
            <div class="card p-4 shadow-sm border-0 mb-4">
                <h5 class="f-w-700 text-dark mb-3 pb-2 border-bottom">
                    <i class="fa-solid fa-book-open text-primary me-2"></i> About this Academy Course
                </h5>
                <p class="text-muted f-14 mb-4" style="line-height: 1.7;">
                    {{ $course->description }}
                </p>

                <div class="row g-3">
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block f-11 mb-1">INSTRUCTOR</small>
                            <span class="f-w-700 text-dark f-13">{{ $settings->site_name }} Master Analysts</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block f-11 mb-1">TOTAL CHAPTERS</small>
                            <span class="f-w-700 text-dark f-13">{{ count($lessons) }} Lessons</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block f-11 mb-1">ACCESS LEVEL</small>
                            <span class="f-w-700 text-dark f-13">{{ !$course->amount ? 'Free Access' : 'Premium Course' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Curriculum / Lessons -->
            <div class="card p-4 shadow-sm border-0">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                    <h5 class="f-w-700 text-dark mb-0">
                        <i class="fa-solid fa-list-ol text-primary me-2"></i> Course Curriculum
                    </h5>
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill f-11">
                        {{ count($lessons) }} Lesson(s)
                    </span>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse ($lessons as $lesson)
                        <div class="p-3 border rounded-3 bg-white d-flex align-items-center justify-content-between gap-3 flex-wrap">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 16px;">
                                    <i class="fa-solid fa-play"></i>
                                </div>
                                <div>
                                    <h6 class="f-w-700 text-dark mb-1 f-14">{{ $lesson->title }}</h6>
                                    @if($lesson->description)
                                        <small class="text-muted d-block f-12 mb-1">{{ Str::limit($lesson->description, 75) }}</small>
                                    @endif
                                    <span class="text-muted f-11">
                                        <i class="fa-regular fa-clock me-1"></i> {{ $lesson->length ?? '10m' }}
                                    </span>
                                </div>
                            </div>

                            <div>
                                @if ($lesson->locked == 'true')
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                        data-bs-toggle="modal" data-bs-target="#preview{{ $lesson->id }}">
                                        <i class="fa-solid fa-eye me-1"></i> Free Preview
                                    </button>
                                @else
                                    <span class="badge bg-light-secondary text-muted px-3 py-2 rounded-pill f-11">
                                        <i class="fa-solid fa-lock me-1"></i> Enrolled Only
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Video Preview Modal -->
                        @if ($lesson->locked == 'true')
                            <div class="modal fade" id="preview{{ $lesson->id }}" tabindex="-1" aria-labelledby="previewModalLabel{{ $lesson->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header">
                                            <h6 class="modal-title f-w-700 text-dark" id="previewModalLabel{{ $lesson->id }}">
                                                <i class="fa-solid fa-video text-primary me-2"></i> {{ $lesson->title }}
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="ratio ratio-16x9">
                                                <iframe src="{{ $lesson->video_link }}" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="fa-solid fa-film f-32 mb-2 d-block opacity-50"></i>
                            No lessons uploaded for this course yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column: Course Purchase Card -->
        <div class="col-lg-4">
            <div class="card p-4 shadow-sm border-0 position-sticky" style="top: 90px;">
                <div class="rounded-3 overflow-hidden mb-3 border">
                    <img src="{{ str_starts_with($course->course_image, 'http') ? $course->course_image : asset('storage/' . $course->course_image) }}"
                        class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="{{ $course->course_title }}">
                </div>

                <div class="mb-3">
                    <span class="text-muted f-12 d-block mb-1">Course Tuition</span>
                    <h3 class="f-w-800 text-primary mb-0">
                        {{ !$course->amount ? 'Free' : $settings->currency . number_format($course->amount, 2) }}
                    </h3>
                </div>

                <div class="d-grid mb-3">
                    <button type="button" class="btn btn-primary rounded-pill py-2 f-w-700 shadow-sm"
                        data-bs-toggle="modal" data-bs-target="#buyModal">
                        <i class="fa-solid fa-graduation-cap me-1"></i> Enroll in Course
                    </button>
                </div>

                <div class="d-flex flex-column gap-2 text-muted f-12 pt-2 border-top">
                    <div><i class="fa-solid fa-circle-check text-success me-2"></i> Lifetime access to all video modules</div>
                    <div><i class="fa-solid fa-circle-check text-success me-2"></i> Stream anytime on desktop & mobile</div>
                    <div><i class="fa-solid fa-circle-check text-success me-2"></i> Official completion certificate</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Purchase Course Modal -->
<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title f-w-700" id="buyModalLabel">
                    <i class="fa-solid fa-cart-shopping text-primary me-2"></i> Confirm Course Enrollment
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="rounded-circle bg-light-primary text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px; font-size: 24px;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h5 class="f-w-800 text-dark mb-2">{{ $course->course_title }}</h5>
                <p class="text-muted f-13 mb-3">
                    <strong>{{ !$course->amount ? $settings->currency . '0.00' : $settings->currency . number_format($course->amount, 2) }}</strong>
                    will be deducted from your account balance to unlock full access.
                </p>
                <form action="{{ route('user.buycourse') }}" method="post">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $course->amount }}">
                    <input type="hidden" name="course" value="{{ $course->id }}">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill py-2 f-w-600 shadow-sm">
                            <i class="fa-solid fa-check me-1"></i> Confirm Purchase & Start Learning
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill py-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
