<button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm" data-bs-toggle="modal" data-bs-target="#addContentModal">
    <i class="fa fa-plus-circle me-1"></i> Add Website Content
</button>

<div id="addContentModal" class="modal fade" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title f-w-700" id="addContentModalLabel">
                    <i class="fa fa-file-alt text-primary me-1"></i> Add General Website Content
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('savecontents') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Content Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" placeholder="e.g. Hero Headline, About Us Section" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Description / Copy <span class="text-danger">*</span></label>
                        <textarea name="content" placeholder="Enter paragraph text..." class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="pt-2 text-end">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa fa-save me-1"></i> Save Content
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
