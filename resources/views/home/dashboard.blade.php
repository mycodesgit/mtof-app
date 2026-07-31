@extends('layouts.app')

@section('title')
    MTOF - Dashboard
@endsection

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-5 mb-4">Dashboard</h1>
                <div class="row g-4 mb-5">
                    <div class="col-lg-3 col-12">
                        <div class="card card-animate">
                            <div class="card-body p-6">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>
                                        <h3 id="facultyCount" class="fw-bold h1">{{ $appcount }}</h3>
                                        <span>MTOF Applicant's Registered</span>
                                    </div>
                                    <div>
                                        <i class="ti ti-users fs-1 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="card card-animate">
                            <div class="card-body p-6">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>
                                        <h3 id="facultyCount" class="fw-bold h1">0</h3>
                                        <span>Personnel Signatories</span>
                                    </div>
                                    <div>
                                        <i class="ti ti-signature fs-1 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="card card-animate">
                            <div class="card-body p-6">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>
                                        <h3 id="facultyCount" class="fw-bold h1">0</h3>
                                        <span>Clearance & Documents</span>
                                    </div>
                                    <div>
                                        <i class="ti ti-file fs-1 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="card card-animate">
                            <div class="card-body p-6">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>
                                        <h3 id="facultyCount" class="fw-bold h1">0</h3>
                                        <span>Users</span>
                                    </div>
                                    <div>
                                        <i class="ti ti-users-group fs-1 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
