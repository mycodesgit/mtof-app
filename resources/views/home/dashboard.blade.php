@extends('layouts.app')

@section('title')
    MTOF - Dashboard
@endsection

@section('body')
<div class="row">
    <div class="col-12">
        <div class="mb-6">
            <h1 class="fs-5 mb-4">Dashboard</h1>

            <!-- Top Level Overview Cards -->
            <div class="row g-4 mb-5">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card card-animate">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fw-bold h1 mb-0">{{ $appcount }}</h3>
                                    <span class="text-muted">Total Registered</span>
                                </div>
                                <div>
                                    <i class="ti ti-users fs-1 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card card-animate">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fw-bold h1 mb-0">{{ $validatedCount }}</h3>
                                    <span class="text-muted">Active Franchises</span>
                                </div>
                                <div>
                                    <i class="ti ti-file-check fs-1 text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card card-animate">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fw-bold h1 mb-0">{{ $signcount }}</h3>
                                    <span class="text-muted">Signatories</span>
                                </div>
                                <div>
                                    <i class="ti ti-signature fs-1 text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card card-animate">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fw-bold h1 mb-0">{{ $userCount ?? 0 }}</h3>
                                    <span class="text-muted">System Users</span>
                                </div>
                                <div>
                                    <i class="ti ti-users-group fs-1 text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Status Breakdown (Based on Selection Types) -->
            <h2 class="fs-6 mb-3">Franchise & Undertaking Statuses</h2>
            <div class="row g-3 mb-5">
                <!-- Expired OR/CR -->
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card card-animate bg-light-warning">
                        <div class="card-body p-3 text-center">
                            <h4 class="fw-bold mb-1 text-warning">{{ $expiredOrCrCount }}</h4>
                            <small class="text-muted fw-semibold">Expired OR/CR</small>
                        </div>
                    </div>
                </div>

                <!-- Private -->
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card card-animate bg-light-info">
                        <div class="card-body p-3 text-center">
                            <h4 class="fw-bold mb-1 text-info">{{ $privateCount }}</h4>
                            <small class="text-muted fw-semibold">Private</small>
                        </div>
                    </div>
                </div>

                <!-- Both -->
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card card-animate bg-light-purple">
                        <div class="card-body p-3 text-center">
                            <h4 class="fw-bold mb-1 text-purple">{{ $bothCount }}</h4>
                            <small class="text-muted fw-semibold">Both (Private & Expired)</small>
                        </div>
                    </div>
                </div>

                <!-- Released -->
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card card-animate bg-light-primary">
                        <div class="card-body p-3 text-center">
                            <h4 class="fw-bold mb-1 text-primary">{{ $releasedCount }}</h4>
                            <small class="text-muted fw-semibold">Released</small>
                        </div>
                    </div>
                </div>

                <!-- Validated -->
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card card-animate bg-light-success">
                        <div class="card-body p-3 text-center">
                            <h4 class="fw-bold mb-1 text-success">{{ $validatedCount }}</h4>
                            <small class="text-muted fw-semibold">Validated</small>
                        </div>
                    </div>
                </div>

                <!-- Revoked -->
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card card-animate bg-light-danger">
                        <div class="card-body p-3 text-center">
                            <h4 class="fw-bold mb-1 text-danger">{{ $revokedCount }}</h4>
                            <small class="text-muted fw-semibold">Revoked</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Registrations Table -->
            <div class="card">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                    <h5 class="card-title mb-0">Recent Applicants</h5>
                    <a href="{{ route('applicant.index') ?? '#' }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Barangay</th>
                                <th>Plate / Engine No.</th>
                                <th>Make / Color</th>
                                <th>Status</th>
                                <th>Date Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentApplicants as $applicant)
                                <tr>
                                    <td class="fw-bold">{{ $applicant->fname }} {{ $applicant->mname }} {{ $applicant->lname }}</td>
                                    <td>{{ $applicant->brgy }}</td>
                                    <td>
                                        <div><span class="badge bg-light text-dark border">{{ $applicant->plate_no ?? 'N/A' }}</span></div>
                                        <small class="text-muted">{{ $applicant->motor_no }}</small>
                                    </td>
                                    <td>{{ $applicant->mtof_make }} ({{ $applicant->mtof_color }})</td>
                                    <td>
                                        @switch($applicant->status)
                                            @case('Validated')
                                                <span class="badge bg-success">Validated</span>
                                                @break
                                            @case('Released')
                                                <span class="badge bg-primary">Released</span>
                                                @break
                                            @case('Expired OR/CR')
                                                <span class="badge bg-warning text-dark">Expired OR/CR</span>
                                                @break
                                            @case('Revoked')
                                                <span class="badge bg-danger">Revoked</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $applicant->status ?? 'Pending' }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $applicant->created_at ? $applicant->created_at->format('M d, Y') : 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No applicant records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection