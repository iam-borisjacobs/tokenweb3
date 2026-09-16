@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    @if (!empty($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li><i class="fa fa-exclamation-triangle me-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">Frontend & Landing Page Management</h3>
                <p class="text-muted mb-0 f-14">Customize marketing copy, frequently asked questions, client testimonials, and image assets.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary rounded-pill px-3 py-2 f-13 f-w-600">
                    <i class="fa fa-external-link-alt me-1"></i> Preview Live Website
                </a>
            </div>
        </div>
    </div>

    <!-- Main Card with Navigation Pills -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card p-4 shadow-sm border">
                <!-- Navigation Pills -->
                <ul class="nav nav-pills gap-2 mb-4 p-2 bg-light bg-opacity-50 rounded-3 border flex-wrap" id="frontendSettingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill px-3 py-2 f-14 f-w-600" id="faqs-tab" data-bs-toggle="pill" data-bs-target="#faqsTabPane" type="button" role="tab" aria-controls="faqsTabPane" aria-selected="true">
                            <i class="fa fa-question-circle me-1"></i> FAQs ({{ count($faqs) }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="testi-tab" data-bs-toggle="pill" data-bs-target="#testiTabPane" type="button" role="tab" aria-controls="testiTabPane" aria-selected="false">
                            <i class="fa fa-quote-left me-1"></i> Testimonials ({{ count($testimonies) }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="contents-tab" data-bs-toggle="pill" data-bs-target="#contentsTabPane" type="button" role="tab" aria-controls="contentsTabPane" aria-selected="false">
                            <i class="fa fa-file-alt me-1"></i> Website Contents ({{ count($contents) }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3 py-2 f-14 f-w-600" id="images-tab" data-bs-toggle="pill" data-bs-target="#imagesTabPane" type="button" role="tab" aria-controls="imagesTabPane" aria-selected="false">
                            <i class="fa fa-images me-1"></i> Gallery Images ({{ count($images) }})
                        </button>
                    </li>
                </ul>

                <!-- Tab Panes -->
                <div class="tab-content" id="frontendSettingsTabContent">
                    <!-- Tab 1: FAQs -->
                    <div class="tab-pane fade show active" id="faqsTabPane" role="tabpanel" aria-labelledby="faqs-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                            <div>
                                <h5 class="f-w-700 mb-0">Frequently Asked Questions</h5>
                                <small class="text-muted">Questions and answers shown on your homepage FAQ section.</small>
                            </div>
                            @include('admin.Settings.FrontendSettings.faqs')
                        </div>

                        <div class="row g-3">
                            @forelse($faqs as $faq)
                                <div class="col-md-6 col-xl-4">
                                    <div class="card h-100 border p-3 rounded-3 shadow-none bg-light bg-opacity-25 hover-card-tile">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="f-w-700 mb-0 text-primary f-14">{{ $faq->question }}</h6>
                                        </div>
                                        <p class="text-muted f-13 mb-3 flex-grow-1" style="line-height: 1.5;">
                                            {{ Str::limit($faq->answer, 140) }}
                                        </p>
                                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editfaq{{ $faq->id }}">
                                                <i class="fa fa-edit me-1"></i> Edit
                                            </button>
                                            <a href="{{ url('admin/dashboard/delfaq/' . $faq->id) }}" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Delete this FAQ?');">
                                                <i class="fa fa-trash-alt me-1"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit FAQ Modal -->
                                <div id="editfaq{{ $faq->id }}" class="modal fade" tabindex="-1" aria-labelledby="editfaqLabel{{ $faq->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header border-bottom">
                                                <h5 class="modal-title f-w-700" id="editfaqLabel{{ $faq->id }}">Edit FAQ</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="{{ route('updatefaq') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $faq->id }}">
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Question <span class="text-danger">*</span></label>
                                                        <input type="text" name="question" value="{{ $faq->question }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Answer <span class="text-danger">*</span></label>
                                                        <textarea name="answer" class="form-control" rows="5" required>{{ $faq->answer }}</textarea>
                                                    </div>
                                                    <div class="pt-2 text-end">
                                                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5 text-muted">
                                    <i class="fa fa-question-circle f-30 text-muted mb-2 d-block"></i>
                                    <h6>No FAQs Found</h6>
                                    <p class="f-13">Click "Add FAQ" above to add your first question and answer.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Tab 2: Testimonials -->
                    <div class="tab-pane fade" id="testiTabPane" role="tabpanel" aria-labelledby="testi-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                            <div>
                                <h5 class="f-w-700 mb-0">Client Testimonials & Reviews</h5>
                                <small class="text-muted">Social proof reviews featured across your landing pages.</small>
                            </div>
                            @include('admin.Settings.FrontendSettings.testimony')
                        </div>

                        <div class="row g-3">
                            @forelse ($testimonies as $t)
                                <div class="col-md-6 col-xl-4">
                                    <div class="card h-100 border p-3 rounded-3 shadow-none bg-light bg-opacity-25 hover-card-tile">
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            @if ($t->picture)
                                                <img src="{{ asset('storage/app/public/' . $t->picture) }}" alt="{{ $t->name }}" class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center f-w-700" style="width: 44px; height: 44px;">
                                                    {{ substr($t->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="f-w-700 mb-0 f-14">{{ $t->name }}</h6>
                                                <small class="text-muted f-12">{{ $t->position ?? 'Trader' }}</small>
                                            </div>
                                        </div>
                                        <p class="text-muted f-13 mb-3 fst-italic flex-grow-1" style="line-height: 1.5;">
                                            "{{ Str::limit($t->what_is_said, 140) }}"
                                        </p>
                                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#edittes{{ $t->id }}">
                                                <i class="fa fa-edit me-1"></i> Edit
                                            </button>
                                            <a href="{{ url('admin/dashboard/deltestimony/' . $t->id) }}" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Delete this testimonial?');">
                                                <i class="fa fa-trash-alt me-1"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Testimonial Modal -->
                                <div id="edittes{{ $t->id }}" class="modal fade" tabindex="-1" aria-labelledby="edittesLabel{{ $t->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header border-bottom">
                                                <h5 class="modal-title f-w-700" id="edittesLabel{{ $t->id }}">Edit Testimonial</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="{{ route('updatetestimony') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $t->id }}">
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Client Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="testifier" value="{{ $t->name }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Position / Role</label>
                                                        <input type="text" name="position" value="{{ $t->position }}" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Review Text <span class="text-danger">*</span></label>
                                                        <textarea name="said" class="form-control" rows="4" required>{{ $t->what_is_said }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Avatar Image</label>
                                                        <select name="picture" class="form-select">
                                                            <option value="{{ $t->picture }}">{{ $t->picture }} (Current)</option>
                                                            @foreach ($images as $item)
                                                                <option value="{{ $item->img_path }}">{{ $item->title ?? $item->img_path }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="pt-2 text-end">
                                                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5 text-muted">
                                    <i class="fa fa-quote-left f-30 text-muted mb-2 d-block"></i>
                                    <h6>No Testimonials Found</h6>
                                    <p class="f-13">Click "Add Testimonial" above to create client reviews.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Tab 3: Website Contents -->
                    <div class="tab-pane fade" id="contentsTabPane" role="tabpanel" aria-labelledby="contents-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                            <div>
                                <h5 class="f-w-700 mb-0">General Website Content Blocks</h5>
                                <small class="text-muted">Marketing headlines, feature highlights, and section narratives.</small>
                            </div>
                            @include('admin.Settings.FrontendSettings.content')
                        </div>

                        <div class="row g-3">
                            @forelse ($contents as $c)
                                <div class="col-md-6 col-xl-4">
                                    <div class="card h-100 border p-3 rounded-3 shadow-none bg-light bg-opacity-25 hover-card-tile">
                                        <h6 class="f-w-700 mb-2 text-primary f-14">{{ $c->title }}</h6>
                                        <p class="text-muted f-13 mb-3 flex-grow-1" style="line-height: 1.5;">
                                            {{ Str::limit($c->description, 140) }}
                                        </p>
                                        <div class="d-flex justify-content-end pt-2 border-top">
                                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editcont{{ $c->id }}">
                                                <i class="fa fa-edit me-1"></i> Edit Block
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Content Modal -->
                                <div id="editcont{{ $c->id }}" class="modal fade" tabindex="-1" aria-labelledby="editcontLabel{{ $c->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header border-bottom">
                                                <h5 class="modal-title f-w-700" id="editcontLabel{{ $c->id }}">Edit Content Block</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="{{ route('updatecontents') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $c->id }}">
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Block Title <span class="text-danger">*</span></label>
                                                        <input type="text" name="title" value="{{ $c->title }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Content Description <span class="text-danger">*</span></label>
                                                        <textarea name="content" class="form-control" rows="4" required>{{ $c->description }}</textarea>
                                                    </div>
                                                    <div class="pt-2 text-end">
                                                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5 text-muted">
                                    <i class="fa fa-file-alt f-30 text-muted mb-2 d-block"></i>
                                    <h6>No Content Blocks Found</h6>
                                    <p class="f-13">Click "Add Website Content" above to create text blocks.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Tab 4: Images -->
                    <div class="tab-pane fade" id="imagesTabPane" role="tabpanel" aria-labelledby="images-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                            <div>
                                <h5 class="f-w-700 mb-0">Frontend Media & Gallery Assets</h5>
                                <small class="text-muted">Graphic media used across banners, features, and testimonial cards.</small>
                            </div>
                            @include('admin.Settings.FrontendSettings.images')
                        </div>

                        <div class="row g-3">
                            @forelse ($images as $img)
                                <div class="col-md-6 col-xl-3">
                                    <div class="card h-100 border p-2 rounded-3 shadow-none bg-light bg-opacity-25 hover-card-tile">
                                        <div class="rounded-2 overflow-hidden border bg-white text-center mb-2" style="height: 140px;">
                                            <img src="{{ asset('storage/app/public/' . $img->img_path) }}" alt="{{ $img->title }}" class="img-fluid h-100 w-100" style="object-fit: contain;">
                                        </div>
                                        <h6 class="f-w-700 mb-1 f-13">{{ $img->title ?? 'Media Asset' }}</h6>
                                        <p class="text-muted f-12 mb-2 flex-grow-1">{{ Str::limit($img->description, 60) }}</p>
                                        <div class="pt-2 border-top text-end">
                                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editimg{{ $img->id }}">
                                                <i class="fa fa-edit me-1"></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Image Modal -->
                                <div id="editimg{{ $img->id }}" class="modal fade" tabindex="-1" aria-labelledby="editimgLabel{{ $img->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header border-bottom">
                                                <h5 class="modal-title f-w-700" id="editimgLabel{{ $img->id }}">Edit Media Asset</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="{{ route('updateimg') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $img->id }}">
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Image Title</label>
                                                        <input type="text" name="img_title" value="{{ $img->title }}" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Description</label>
                                                        <textarea name="img_desc" class="form-control" rows="2">{{ $img->description }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label f-w-600 f-13">Replace Image File</label>
                                                        <input name="image" class="form-control" type="file">
                                                    </div>
                                                    <div class="pt-2 text-end">
                                                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5 text-muted">
                                    <i class="fa fa-images f-30 text-muted mb-2 d-block"></i>
                                    <h6>No Images Uploaded</h6>
                                    <p class="f-13">Click "Upload Image" above to add media assets to your gallery.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
