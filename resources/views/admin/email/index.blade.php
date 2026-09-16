@extends('layouts.app')

@section('styles')
    @parent
    <style>
        /* CKEditor Clean Appearance & Warning Suppression */
        .cke_notifications_area,
        .cke_notification,
        .cke_notification_warning {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .cke {
            border-radius: 8px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: none !important;
            overflow: hidden !important;
        }
        body.dark-only .cke {
            border-color: rgba(255, 255, 255, 0.12) !important;
        }
        body.dark-only .cke_top {
            background: #1e2433 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        body.dark-only .cke_bottom {
            background: #1e2433 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        body.dark-only .cke_toolbar_separator {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        body.dark-only .cke_toolgroup {
            background: #252c3c !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* Select2 Modernization & Dark Mode */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            min-height: 42px !important;
            padding: 4px 6px !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: var(--theme-default, #6362e7) !important;
            box-shadow: 0 0 0 0.2rem rgba(99, 98, 231, 0.15) !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgba(99, 98, 231, 0.1) !important;
            border: 1px solid rgba(99, 98, 231, 0.25) !important;
            color: var(--theme-default, #6362e7) !important;
            border-radius: 6px !important;
            padding: 2px 8px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: var(--theme-default, #6362e7) !important;
            margin-right: 6px !important;
        }
        body.dark-only .select2-container--default .select2-selection--multiple {
            background-color: #1a202c !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
        }
        body.dark-only .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgba(99, 98, 231, 0.25) !important;
            border-color: rgba(99, 98, 231, 0.4) !important;
            color: #e0e7ff !important;
        }
        body.dark-only .select2-dropdown {
            background-color: #222736 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #f1f5f9 !important;
        }
        body.dark-only .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: #1a202c !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #f1f5f9 !important;
        }
        body.dark-only .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: var(--theme-default, #6362e7) !important;
            color: #ffffff !important;
        }
        body.dark-only .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">Email Services</h3>
                <p class="text-muted mb-0 f-14">Compose and deliver broadcast announcements or targeted emails to clients.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-paper-plane me-1"></i> Mail Broadcast Center
                </span>
            </div>
        </div>
    </div>

    <!-- Email Composition Form -->
    <form method="post" action="{{ route('sendmailtoall') }}" id="sendMailForm">
        @csrf
        <div class="row g-4">
            <!-- Left Column: Message Content -->
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <h5 class="f-w-700 text-dark mb-0">
                            <i class="fa fa-pencil-square-o me-2 text-primary"></i> Compose Email
                        </h5>
                        <small class="text-muted f-12">Fields marked with <span class="text-danger">*</span> are required</small>
                    </div>

                    <!-- Email Subject -->
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-14">
                            Subject <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                            <input type="text" name="subject" class="form-control border-start-0 ps-1"
                                placeholder="e.g. Important Portfolio Update & Market Announcement" required>
                        </div>
                    </div>

                    <!-- Salutation and Recipient Title -->
                    <div class="mb-4">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label f-w-600 f-14">Greeting / Salutation</label>
                                <input type="text" name="greet" id="greetInput" value="Hello" class="form-control" placeholder="e.g. Hello, Dear, Good day">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label f-w-600 f-14">Recipient Designation</label>
                                <input type="text" name="title" id="titleInput" value="Investor" class="form-control" placeholder="e.g. Investor, Trader, Member">
                            </div>
                        </div>
                        <div class="mt-2 d-flex align-items-center gap-2">
                            <span class="text-muted f-12"><i class="fa fa-eye me-1 text-primary"></i> Header Preview:</span>
                            <span id="salutationPreview" class="badge bg-light text-dark border px-2 py-1 f-12 f-w-600">Hello Investor,</span>
                        </div>
                    </div>

                    <!-- Rich Text Editor -->
                    <div class="mb-4">
                        <label class="form-label f-w-600 f-14 d-flex justify-content-between align-items-center">
                            <span>Message Body <span class="text-danger">*</span></span>
                            <span class="badge bg-light text-muted border f-11">HTML Rich Text</span>
                        </label>
                        <textarea name="message" id="messageEditor" class="form-control" rows="10" placeholder="Type your message here..." required></textarea>
                    </div>

                    <!-- Form Footer Buttons -->
                    <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                        <button type="reset" id="resetBtn" class="btn btn-outline-secondary px-3 py-2 rounded-pill f-13">
                            <i class="fa fa-undo me-1"></i> Clear Form
                        </button>
                        <button type="submit" id="submitBtn" class="btn btn-primary px-4 py-2 rounded-pill f-w-600 shadow-sm">
                            <i class="fa fa-paper-plane me-2"></i> Send Broadcast Email
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Target Audience & Delivery Details -->
            <div class="col-lg-4">
                <!-- Target Audience Card -->
                <div class="card p-4 mb-4">
                    <h5 class="f-w-700 text-dark mb-3 pb-2 border-bottom">
                        <i class="fa fa-users me-2 text-primary"></i> Target Audience
                    </h5>

                    <div class="mb-3">
                        <label class="form-label f-w-600 f-14">Recipient Category</label>
                        <select class="form-select py-2" id="category" name="category">
                            <option value="All" selected>All Registered Users</option>
                            <option value="No active plans">Users without Active Plan</option>
                            <option value="No deposit">Users without Deposit (New Leads)</option>
                            <option value="Select Users">Choose Specific Users</option>
                        </select>
                    </div>

                    <!-- Category Explanation Note -->
                    <div class="p-3 border rounded bg-light bg-opacity-50 mb-3" id="categoryInfoBox">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fa fa-info-circle text-primary mt-1 f-15"></i>
                            <p class="mb-0 f-12 text-muted" id="categoryDesc">
                                Delivers this email announcement to every registered client on the platform.
                            </p>
                        </div>
                    </div>

                    <!-- Conditional User Multi-Select -->
                    <div class="d-none" id="select-user-view">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label f-w-600 f-13 mb-0">
                                Selected: <span class="badge bg-primary text-white ms-1" id="numofusers">0</span>
                            </label>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2 f-11" id="selectAllUsers">Select All</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-2 f-11" id="clearAllUsers">Clear</button>
                            </div>
                        </div>
                        <select name="users[]" multiple class="form-control select2 w-100" id="showusers" data-placeholder="Search and choose users..."></select>
                        <div id="usersLoading" class="text-muted f-12 mt-2 d-none">
                            <i class="fa fa-spinner fa-spin me-1 text-primary"></i> Loading client list...
                        </div>
                    </div>
                </div>

                <!-- Best Practices Card -->
                <div class="card p-4">
                    <h6 class="f-w-700 mb-3 text-dark">
                        <i class="fa fa-lightbulb-o me-2 text-warning"></i> Delivery Guide
                    </h6>
                    <ul class="list-unstyled mb-0 f-13 text-muted">
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="fa fa-check text-success mt-1 f-12"></i>
                            <span><strong>Personalized Salutation:</strong> Each email will begin with the greeting word and designation you set.</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="fa fa-check text-success mt-1 f-12"></i>
                            <span><strong>Branding & Logo:</strong> Platform logos, website links, and copyright are automatically attached.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="fa fa-shield text-primary mt-1 f-12"></i>
                            <span><strong>Secure Sending:</strong> Large distribution lists are sent safely via your configured SMTP mail server.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    @parent
    <!-- CKEditor 4 with version warning suppression -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Disable CKEditor version check notification banner
            if (window.CKEDITOR) {
                CKEDITOR.config.versionCheck = false;
                CKEDITOR.replace('messageEditor', {
                    versionCheck: false,
                    height: 320,
                    removePlugins: 'about,notification',
                    toolbar: [
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
                        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight' ] },
                        { name: 'links', items: [ 'Link', 'Unlink' ] },
                        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule' ] },
                        '/',
                        { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'tools', items: [ 'Maximize', 'Source' ] }
                    ]
                });
            }

            // Real-time Greeting & Title Preview
            function updateSalutationPreview() {
                var greet = $('#greetInput').val().trim();
                var title = $('#titleInput').val().trim();
                var previewText = (greet ? greet : 'Hello') + ' ' + (title ? title : 'Investor') + ',';
                $('#salutationPreview').text(previewText);
            }
            $('#greetInput, #titleInput').on('input keyup', updateSalutationPreview);

            // Category Descriptions
            var categoryDescriptions = {
                'All': 'Delivers this email announcement to every registered client on the platform.',
                'No active plans': 'Targets registered clients who do not currently have an active investment package.',
                'No deposit': 'Targets registered clients who have not made their first deposit yet (ideal for welcome & onboarding campaigns).',
                'Select Users': 'Choose specific clients from your user database to receive this targeted message.'
            };

            var loadedUsers = null;

            function handleCategoryChange() {
                var selectedCat = $('#category').val();
                $('#categoryDesc').text(categoryDescriptions[selectedCat] || '');

                if (selectedCat === 'Select Users') {
                    $('#select-user-view').removeClass('d-none');
                    if (!loadedUsers) {
                        $('#usersLoading').removeClass('d-none');
                        fetch("{{ route('fetchusers') }}")
                            .then(function(res) { return res.json(); })
                            .then(function(data) {
                                loadedUsers = data.data || [];
                                var select = $('#showusers');
                                select.empty();
                                loadedUsers.forEach(function(u) {
                                    var opt = new Option(u.name + ' (' + u.email + ')', u.id, false, false);
                                    select.append(opt);
                                });
                                select.trigger('change');
                                $('#usersLoading').addClass('d-none');
                            })
                            .catch(function(err) {
                                $('#usersLoading').addClass('d-none');
                                console.error('Failed to load users:', err);
                            });
                    }
                } else {
                    $('#select-user-view').addClass('d-none');
                }
            }

            // Initialize Select2
            if ($.fn.select2) {
                $('#showusers').select2({
                    placeholder: 'Search and choose recipients...',
                    allowClear: true,
                    width: '100%'
                });

                $('#showusers').on('change', function() {
                    var count = $(this).val() ? $(this).val().length : 0;
                    $('#numofusers').text(count);
                });
            }

            $('#category').on('change', handleCategoryChange);
            handleCategoryChange();

            // Select All / Clear All Buttons
            $('#selectAllUsers').on('click', function() {
                $('#showusers > option').prop('selected', true);
                $('#showusers').trigger('change');
            });

            $('#clearAllUsers').on('click', function() {
                $('#showusers').val(null).trigger('change');
            });

            // Form Submit Handling: Sync CKEditor and prevent duplicate submissions
            $('#sendMailForm').on('submit', function(e) {
                if (window.CKEDITOR && CKEDITOR.instances.messageEditor) {
                    CKEDITOR.instances.messageEditor.updateElement();
                    var content = CKEDITOR.instances.messageEditor.getData().trim();
                    if (!content) {
                        e.preventDefault();
                        alert('Please enter a message content before sending.');
                        return false;
                    }
                }

                if ($('#category').val() === 'Select Users') {
                    var selected = $('#showusers').val();
                    if (!selected || selected.length === 0) {
                        e.preventDefault();
                        alert('Please select at least one recipient user.');
                        return false;
                    }
                }

                var btn = $('#submitBtn');
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-2"></i> Sending Email...');
            });

            // Reset Button handler
            $('#resetBtn').on('click', function() {
                if (window.CKEDITOR && CKEDITOR.instances.messageEditor) {
                    CKEDITOR.instances.messageEditor.setData('');
                }
                setTimeout(function() {
                    $('#category').trigger('change');
                    updateSalutationPreview();
                    $('#showusers').val(null).trigger('change');
                }, 50);
            });
        });
    </script>
@endsection
