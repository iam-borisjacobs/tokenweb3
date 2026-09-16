<button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm" data-bs-toggle="modal" data-bs-target="#addImageModal">
    <i class="fa fa-plus-circle me-1"></i> Upload Image
</button>

<div id="addImageModal" class="modal fade" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title f-w-700" id="addImageModalLabel">
                    <i class="fa fa-image text-primary me-1"></i> Upload Gallery Image
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('saveimg') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Image Title (Optional)</label>
                        <input type="text" name="img_title" placeholder="e.g. Hero Banner, Testimonial Avatar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Image Description (Optional)</label>
                        <textarea name="img_desc" placeholder="Brief description of the image" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Select Image File <span class="text-danger">*</span></label>
                        <input name="image" class="form-control" type="file" required>
                        <small class="text-muted f-11">Supported formats: JPG, PNG, WEBP, SVG.</small>
                    </div>
                    <div class="pt-2 text-end">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa fa-upload me-1"></i> Upload Image
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
