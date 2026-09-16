<!-- Delete master account Modal -->
<div class="modal fade" id="deleteModal{{ $item['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg text-center p-3">
            <div class="modal-body pt-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; background: rgba(239, 68, 68, 0.12); color: #ef4444; font-size: 24px;">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h5 class="f-w-700 text-dark mb-2">Delete Account?</h5>
                <p class="text-muted f-13 mb-4">
                    Are you sure you want to delete master trading account <strong>#{{ $item['login'] }}</strong>?
                </p>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-light rounded-pill w-100 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('del.master', ['id' => $item['id']]) }}" class="btn btn-danger rounded-pill w-100 py-2 f-13 f-w-700">
                        Yes Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
