@extends('layouts.app')

@section('title')
    MTOF - Account Settings
@endsection

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4 d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="fs-4 fw-bold mb-1">Account Settings</h1>
                    <p class="text-muted small mb-0">Manage your personal profile information and security preferences.</p>
                </div>
            </div>

            <div class="row g-4">
                {{-- Left Sidebar Profile Card --}}
                <div class="col-lg-4 col-xl-3">
                    <div class="card card-animate shadow-sm rounded-3">
                        <div class="card-body text-center p-4">
                            <div class="position-relative d-inline-block mb-3">
                                <div class="avatar-lg bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                    <i class="ti ti-user fs-1"></i>
                                </div>
                                <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1" title="Account Active">
                                    <span class="visually-hidden">Active</span>
                                </span>
                            </div>

                            <h5 class="fw-bold mb-1">
                                {{ auth()->user()->fname ?? 'John' }} {{ auth()->user()->lname ?? 'Doe' }} {{ auth()->user()->ext ?? '' }}
                            </h5>
                            <p class="text-muted small mb-2">@<span>{{ auth()->user()->username ?? 'johndoe' }}</span></p>

                            <div class="mb-3">
                                <span class="badge bg-success-subtle text-success text-uppercase px-3 py-2 rounded-pill fs-7 fw-semibold">
                                    <i class="ti ti-shield-check me-1"></i> {{ auth()->user()->role ?? 'Administrator' }}
                                </span>
                            </div>

                            <hr class="my-3 opacity-25">

                            <div class="text-start small text-muted">
                                <div class="d-flex justify-content-between py-1">
                                    <span>Account Status:</span>
                                    <span class="badge bg-success">{{ auth()->user()->status ?? 'Active' }}</span>
                                </div>
                                <div class="d-flex justify-content-between py-1">
                                    <span>Member Since:</span>
                                    <span class="fw-semibold text-body">Jan 2026</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Main Form Area --}}
                <div class="col-lg-8 col-xl-9">
                    <div class="card card-animate shadow-sm rounded-3">
                        <div class="card-header bg-transparent border-bottom pt-3 pb-2">
                            <ul class="nav nav-tabs card-header-tabs border-bottom-0" id="settingsTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-semibold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab">
                                        <i class="ti ti-id me-1"></i> Personal Information
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold" id="security-tab" data-bs-toggle="tab" data-bs-target="#security-tab-pane" type="button" role="tab">
                                        <i class="ti ti-lock me-1"></i> Security & Password
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content" id="settingsTabsContent">
                                
                                {{-- TAB 1: Profile Information --}}
                                <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" tabindex="0">
                                    <form action="#" method="POST" onsubmit="return false;">
                                        <h6 class="fw-bold mb-3 text-secondary"><i class="ti ti-user-check me-1"></i> Basic Details</h6>
                                        
                                        <div class="row g-3">
                                            {{-- First Name --}}
                                            <div class="col-md-5">
                                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="fname" value="{{ auth()->user()->fname ?? '' }}" placeholder="Enter first name">
                                            </div>

                                            {{-- Middle Name --}}
                                            <div class="col-md-4">
                                                <label class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" name="mname" value="{{ auth()->user()->mname ?? '' }}" placeholder="Enter middle name">
                                            </div>

                                            {{-- Extension --}}
                                            <div class="col-md-3">
                                                <label class="form-label">Extension Name</label>
                                                <select class="form-control" name="ext">
                                                    <option value="" {{ empty(auth()->user()->ext) ? 'selected' : '' }}>None</option>
                                                    <option value="Jr." {{ (auth()->user()->ext ?? '') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                                    <option value="Sr." {{ (auth()->user()->ext ?? '') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                                    <option value="II" {{ (auth()->user()->ext ?? '') == 'II' ? 'selected' : '' }}>II</option>
                                                    <option value="III" {{ (auth()->user()->ext ?? '') == 'III' ? 'selected' : '' }}>III</option>
                                                    <option value="IV" {{ (auth()->user()->ext ?? '') == 'IV' ? 'selected' : '' }}>IV</option>
                                                    <option value="V" {{ (auth()->user()->ext ?? '') == 'V' ? 'selected' : '' }}>V</option>
                                                    <option value="VI" {{ (auth()->user()->ext ?? '') == 'VI' ? 'selected' : '' }}>VI</option>
                                                </select>
                                            </div>

                                            {{-- Last Name --}}
                                            <div class="col-md-6">
                                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="lname" value="{{ auth()->user()->lname ?? '' }}" placeholder="Enter last name">
                                            </div>

                                            {{-- Username --}}
                                            <div class="col-md-6">
                                                <label class="form-label">Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" value="{{ auth()->user()->username ?? '' }}" placeholder="username">
                                            </div>
                                        </div>

                                        <hr class="my-4 opacity-25">

                                        <h6 class="fw-bold mb-3 text-secondary"><i class="ti ti-shield-lock me-1"></i> System Information</h6>
                                        <div class="row g-3 mb-4">
                                            {{-- Role (Readonly) --}}
                                            <div class="col-md-6">
                                                <label class="form-label text-muted">User Role</label>
                                                <input type="text" class="form-control bg-body-tertiary" value="{{ match((int)(auth()->user()->role ?? 1)) { 1 => 'Administrator', 2 => 'Verifier', 3 => 'Processor', 4 => 'Staff', default => 'Unknown' } }}" readonly>
                                                <div class="form-text">Role changes require Administrator approval.</div>
                                            </div>

                                            {{-- Account Status (Readonly) --}}
                                            <div class="col-md-6">
                                                <label class="form-label text-muted">Account Status</label>
                                                <input type="text" class="form-control bg-body-tertiary" value="{{ (auth()->user()->status ?? 1) == 1 ? 'Active' : 'Deactivated' }}" readonly>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-light px-4">Cancel</button>
                                            <button type="button" class="btn btn-success px-4">
                                                <i class="ti ti-device-floppy me-1"></i> Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                {{-- TAB 2: Security & Password --}}
                                <div class="tab-pane fade" id="security-tab-pane" role="tabpanel" tabindex="0">
                                    <form action="#" method="POST" onsubmit="return false;">
                                        <h6 class="fw-bold mb-3 text-secondary"><i class="ti ti-key me-1"></i> Change Password</h6>
                                        
                                        <div class="row g-3 mb-4" style="max-width: 500px;">
                                            {{-- Current Password --}}
                                            <div class="col-12">
                                                <label class="form-label fw-semibold small">Current Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control pe-5" placeholder="Enter current password">
                                                    <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted p-1">
                                                        <i class="ti ti-eye fs-5"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- New Password --}}
                                            <div class="col-12">
                                                <label class="form-label fw-semibold small">New Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control pe-5" placeholder="Enter new password">
                                                    <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted p-1">
                                                        <i class="ti ti-eye fs-5"></i>
                                                    </button>
                                                </div>
                                                <div class="form-text">Must be at least 8 characters long with letters and numbers.</div>
                                            </div>

                                            {{-- Confirm New Password --}}
                                            <div class="col-12">
                                                <label class="form-label fw-semibold small">Confirm New Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control pe-5" placeholder="Confirm new password">
                                                    <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted p-1">
                                                        <i class="ti ti-eye fs-5"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-start gap-2">
                                            <button type="button" class="btn btn-success px-4">
                                                <i class="ti ti-shield-check me-1"></i> Update Password
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection