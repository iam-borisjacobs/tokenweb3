@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="f-w-700 mb-1">IP Address Blacklist Management</h3>
                <p class="text-muted mb-0 f-14">Protect your infrastructure by barring malicious bots, fraudsters, or suspicious IP addresses from reaching your application.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light-danger text-danger px-3 py-2 rounded-pill f-12">
                    <i class="fa fa-shield-alt me-1"></i> Security Firewall
                </span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Add IP Card -->
        <div class="col-lg-4">
            <div class="card h-100 p-4 shadow-sm border">
                <h5 class="f-w-700 mb-2 text-danger d-flex align-items-center gap-2">
                    <i class="fa fa-ban"></i> Ban IP Address
                </h5>
                <p class="text-muted f-13 mb-4">Enter an IPv4 or IPv6 address to instantly drop all incoming HTTP requests from that client.</p>

                <form method="POST" action="javascript:void(0)" id="ipform">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label f-w-600 f-13">IP Address <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa fa-network-wired text-muted"></i></span>
                            <input type="text" name="ipaddress" id="ipaddress" class="form-control form-control-lg f-w-600" placeholder="e.g. 192.168.1.1 or 2001:db8::1" required>
                        </div>
                        <small class="text-muted f-11 mt-1 d-block">Ensure correct syntax to prevent accidental administrative lockout.</small>
                    </div>

                    <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 f-w-600 w-100 shadow-sm" id="blacklistBtn">
                        <i class="fa fa-ban me-1"></i> Blacklist IP Address
                    </button>
                </form>
            </div>
        </div>

        <!-- Blacklisted IPs List -->
        <div class="col-lg-8">
            <div class="card h-100 p-4 shadow-sm border">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <div>
                        <h5 class="f-w-700 mb-1 d-flex align-items-center gap-2">
                            <i class="fa fa-list-alt text-primary"></i> Currently Blacklisted Addresses
                        </h5>
                        <p class="text-muted f-13 mb-0">Active IP bans enforced at the application middleware layer.</p>
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="getallips()">
                        <i class="fa fa-sync-alt me-1"></i> Refresh
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="f-13 f-w-700">Blocked IP Address</th>
                                <th scope="col" class="f-13 f-w-700">Date Blacklisted</th>
                                <th scope="col" class="f-13 f-w-700 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="showipaddress">
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
                                    <i class="fa fa-spinner fa-spin me-1"></i> Loading blacklisted records...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getallips();

        // Fetch all blacklisted IPs
        window.getallips = function() {
            var url = "{{ route('allipaddress') }}";
            fetch(url)
                .then(function(res) { return res.json(); })
                .then(function(response) {
                    if (response.status === 200) {
                        var tbody = document.getElementById('showipaddress');
                        if (tbody) {
                            tbody.innerHTML = response.data;
                        }
                    }
                })
                .catch(function(err) {
                    console.error('Error fetching IPs:', err);
                });
        };

        // Add IP form submit
        $('#ipform').on('submit', function(e) {
            e.preventDefault();
            var ipInput = document.getElementById('ipaddress');
            var ipVal = ipInput ? ipInput.value.trim() : '';
            if (!ipVal) return;

            var $btn = $('#blacklistBtn');
            var origHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Blacklisting...');

            $.ajax({
                url: "{{ route('addipaddress') }}",
                type: 'POST',
                data: $('#ipform').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $btn.prop('disabled', false).html(origHtml);
                    if (ipInput) ipInput.value = '';
                    getallips();

                    if (window.Swal) {
                        Swal.fire({
                            icon: 'success',
                            title: 'IP Blacklisted',
                            text: response.success || 'IP address has been blocked successfully.',
                            timer: 2200,
                            showConfirmButton: false
                        });
                    } else {
                        alert(response.success || 'IP address blacklisted.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(origHtml);
                    var msg = 'Failed to blacklist IP address.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    if (window.Swal) {
                        Swal.fire({ icon: 'error', title: 'Error', text: msg });
                    } else {
                        alert(msg);
                    }
                }
            });
        });

        // Delete IP
        window.deleteip = function(id) {
            if (window.Swal) {
                Swal.fire({
                    title: 'Remove IP Ban?',
                    text: 'Are you sure you want to remove this IP from the blacklist?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, unban IP'
                }).then((result) => {
                    if (result.isConfirmed) {
                        performDeleteIp(id);
                    }
                });
            } else {
                if (confirm('Unban this IP address?')) {
                    performDeleteIp(id);
                }
            }
        };

        function performDeleteIp(id) {
            var url = "{{ url('admin/dashboard/delete-ip') }}/" + id;
            fetch(url)
                .then(function(res) { return res.json(); })
                .then(function(response) {
                    if (response.status === 200) {
                        getallips();
                        if (window.Swal) {
                            Swal.fire({
                                icon: 'success',
                                title: 'IP Ban Removed',
                                text: response.success || 'IP address removed from blacklist.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    }
                })
                .catch(function(err) {
                    console.error('Error removing IP:', err);
                });
        }
    });
</script>
@endsection
