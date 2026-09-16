<button type="button" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-600 shadow-sm" data-bs-toggle="modal" data-bs-target="#addTestimonyModal">
    <i class="fa fa-plus-circle me-1"></i> Add Testimonial
</button>

<div id="addTestimonyModal" class="modal fade" tabindex="-1" aria-labelledby="addTestimonyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title f-w-700" id="addTestimonyModalLabel">
                    <i class="fa fa-quote-left text-primary me-1"></i> Add Client Testimonial
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('savetestimony') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Client / Testifier Name <span class="text-danger">*</span></label>
                        <input type="text" name="testifier" placeholder="e.g. John Doe" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Role / Occupation</label>
                        <input type="text" name="position" placeholder="e.g. Verified Trader, Entrepreneur" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Testimonial Review <span class="text-danger">*</span></label>
                        <textarea name="said" placeholder="What the client said about your trading platform..." class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">Avatar / Photo</label>
                        <select name="picture" class="form-select">
                            <option value="">-- Choose from uploaded gallery --</option>
                            @foreach ($images as $item)
                                <option value="{{ $item->img_path }}">{{ $item->title ?? $item->img_path }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted f-11">To use a photo, upload it in the Images tab first.</small>
                    </div>
                    <div class="pt-2 text-end">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa fa-save me-1"></i> Save Testimonial
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
