@extends('layouts.app')

@section('title')
    MTOF - Applicant's List
@endsection

@section('body')
    <div class="row ">
        <div class="col-md-12">
            <div class="mb-6">
                <h1 class="fs-5 mb-4">Applicants</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="ti ti-users"></i> List of Applicants
                                </h6>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                    <i class="ti ti-user-plus"></i> Add New
                                </button>
                                <table id="applicantlistTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>MTOF ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Status</th>
                                            <th width="10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var applicantReadRoute = "{{ route('applicant.show') }}";
    </script>
@endsection
