@extends('layouts.app')

@section('title')
    MTOF - Settings
@endsection

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fs-5 mb-0">System Settings</h1>
                </div>

                <div class="card card-animate">
                    <div class="card-header pt-3 bg-light border-bottom">
                        {{-- Navigation Tabs --}}
                        <ul class="nav nav-tabs card-header-tabs" id="settingsTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="branding-tab" data-bs-toggle="tab" data-bs-target="#branding" type="button" role="tab">
                                    <i class="ti ti-photo me-1"></i> Branding & Logo
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                                    <i class="ti ti-settings me-1"></i> General Config
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="maintenance-tab" data-bs-toggle="tab" data-bs-target="#maintenance" type="button" role="tab">
                                    <i class="ti ti-tool me-1"></i> Maintenance Mode
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="logs-tab" data-bs-toggle="tab" data-bs-target="#logs" type="button" role="tab">
                                    <i class="ti ti-file-text me-1"></i> Activity Logs
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="settingsTabContent">

                            {{-- 1. BRANDING & LOGO --}}
                            <div class="tab-pane fade show active" id="branding" role="tabpanel">
                                <div class="row g-4">
                                    {{-- Primary System Logo --}}
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 text-center">
                                            <label class="form-label fw-bold d-block">System Main Logo</label>
                                            
                                            <div class="mb-3 d-flex justify-content-center align-items-center border rounded" style="height: 140px;">
                                                <i class="ti ti-photo fs-1 text-muted"></i>
                                            </div>

                                            <div class="input-group">
                                                <input type="file" class="form-control" accept="image/png, image/jpeg, image/svg+xml">
                                                <label class="input-group-text"><i class="ti ti-upload"></i></label>
                                            </div>
                                            <small class="text-muted d-block mt-2">Recommended size: 250x80px. PNG or SVG preferred.</small>
                                        </div>
                                    </div>

                                    {{-- Favicon --}}
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 text-center">
                                            <label class="form-label fw-bold d-block">Favicon</label>
                                            
                                            <div class="mb-3 d-flex justify-content-center align-items-center border rounded" style="height: 140px;">
                                                <i class="ti ti-world fs-1 text-muted"></i>
                                            </div>

                                            <div class="input-group">
                                                <input type="file" class="form-control" accept="image/x-icon, image/png">
                                                <label class="input-group-text"><i class="ti ti-upload"></i></label>
                                            </div>
                                            <small class="text-muted d-block mt-2">Square format (32x32px or 64x64px). .ico or .png format.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Save Branding Settings
                                    </button>
                                </div>
                            </div>

                            {{-- 2. GENERAL CONFIGURATION --}}
                            <div class="tab-pane fade" id="general" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">System Header Name: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter System Header name">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">System Full Name: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter System full name">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">System Description: <span class="text-danger">*</span></label>
                                        <textarea name="" id="" class="form-control form-control-sm" cols="30" rows="5"></textarea>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">System About us:</label>
                                        <input type="email" class="form-control form-control-sm" placeholder="About">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">System Category:</label>
                                        <select name="" id="" class="form-control form-control-sm">
                                            <option value=""> ---Select--- </option>
                                            <option value="LOCAL GOVERNMENT UNIT">LOCAL GOVERNMENT UNIT</option>
                                            <option value="PRIVATE UNIT">PRIVATE UNIT</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">System Email:</label>
                                        <input type="email" class="form-control form-control-sm" placeholder="admin@example.com">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">System Contact No.:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="09xxxxxxxxx">
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Save General Settings
                                    </button>
                                </div>
                            </div>

                            {{-- 3. MAINTENANCE MODE --}}
                            <div class="tab-pane fade" id="maintenance" role="tabpanel">
                                <div class="alert alert-warning border-start border-4 border-warning" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-alert-triangle fs-3 me-2"></i>
                                        <div>
                                            <strong>Caution:</strong> Activating maintenance mode will prevent regular users from accessing the system.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check form-switch form-switch-lg mb-4">
                                    <input class="form-check-input" type="checkbox" role="switch" id="maintenanceSwitch">
                                    <label class="form-check-label fw-bold ms-2" for="maintenanceSwitch">Enable System Maintenance Mode</label>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Maintenance Announcement Message</label>
                                    <textarea class="form-control" rows="3" placeholder="We are currently undergoing scheduled maintenance. Please check back soon."></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Allowed IP Addresses (Bypass list)</label>
                                    <input type="text" class="form-control" placeholder="e.g. 192.168.1.1, 127.0.0.1">
                                    <small class="text-muted">Comma-separated IP addresses allowed to access the system during maintenance.</small>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Update Maintenance Settings
                                    </button>
                                </div>
                            </div>

                            {{-- 4. SYSTEM LOGS & AUDIT TRAIL --}}
                            <div class="tab-pane fade" id="logs" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0 fw-bold">Recent Audit Logs</h6>
                                    <div>
                                        <button class="btn btn-sm btn-outline-secondary me-1">
                                            <i class="ti ti-refresh"></i> Refresh
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="ti ti-trash"></i> Clear Logs
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Timestamp</th>
                                                <th>User</th>
                                                <th>Action</th>
                                                <th>IP Address</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><small class="text-muted">YYYY-MM-DD HH:MM:SS</small></td>
                                                <td>Admin User</td>
                                                <td><span class="badge bg-primary-subtle text-primary">Updated Settings</span></td>
                                                <td><code>127.0.0.1</code></td>
                                                <td><span class="badge bg-success">Success</span></td>
                                            </tr>
                                            <tr>
                                                <td><small class="text-muted">YYYY-MM-DD HH:MM:SS</small></td>
                                                <td>John Doe</td>
                                                <td><span class="badge bg-info-subtle text-info">User Login</span></td>
                                                <td><code>192.168.1.45</code></td>
                                                <td><span class="badge bg-success">Success</span></td>
                                            </tr>
                                            <tr>
                                                <td><small class="text-muted">YYYY-MM-DD HH:MM:SS</small></td>
                                                <td>Unknown</td>
                                                <td><span class="badge bg-danger-subtle text-danger">Failed Login Attempt</span></td>
                                                <td><code>112.198.40.12</code></td>
                                                <td><span class="badge bg-danger">Failed</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div> {{-- End tab-content --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection