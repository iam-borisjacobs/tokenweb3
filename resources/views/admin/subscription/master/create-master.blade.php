<!-- Submit MT4 Master Account Modal -->
<div id="masterModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title f-w-700 text-dark">
                    <i class="fa-solid fa-plus text-primary me-2"></i> Create Master Account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('create.master') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Login*:</label>
                            <input class="form-control" type="text" name="login" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Account Password*:</label>
                            <input class="form-control" type="text" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Account Name*:</label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Server*:</label>
                            <input class="form-control" placeholder="E.g. HantecGlobal-live" type="text" name="serverName" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Account Type:</label>
                            <input class="form-control" placeholder="E.g. Standard" type="text" name="acntype" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label f-w-600 f-12">Leverage:</label>
                            <input class="form-control" placeholder="E.g. 1:500" type="text" name="leverage" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label f-w-600 f-12">Currency:</label>
                            <input class="form-control" placeholder="E.g. USD" type="text" name="currency" required>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3 mt-4 px-0 pb-0">
                        <button type="button" class="btn btn-light rounded-pill px-3 py-2 f-13" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 f-13 f-w-700 shadow-sm">
                            <i class="fa-solid fa-server me-1"></i> Add Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
