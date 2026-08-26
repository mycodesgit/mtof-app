@extends('layouts.app')

@section('title')
    MTOF - Position's List
@endsection

@section('body')
    <div class="row g-4">
        <!-- Page Header & Global Controls -->
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h1 class="h4 fw-bold mb-1">Positions</h1>
                <p class="text-muted small mb-0">List of official MTOF positions, permit details, and compliance records.</p>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-6">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="ti ti-plus"></i> Add New Position
                                </h6>
                            </div>
                            <div class="card-body">
                                <form id="addPositionCardForm" action="#" method="POST">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="name" placeholder="Enter Position" required>
                                        @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-outline-success">
                                            <i class="ti ti-check"></i> Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="ti ti-file"></i> List of Positions
                                </h6>
                            </div>
                            <div class="card-body">
                                <table id="positionlistTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Postion Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
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
    
    <div class="modal fade" id="editPositionModal" tabindex="-1" role="dialog" aria-labelledby="editPositionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editPositionModalLabel">Edit Document Title</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPositionForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editPositionId">
                        <div class="col-md-12 mb-3">
                            <label for="editPositionName">Position Title: <span class="text-danger">*</span></label>
                            <input name="name" id="editPositionName" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editPositionStatus">Status: <span class="text-danger">*</span></label>
                            <select id="editPositionStatus" name="status" class="form-control"style="width: 100%;">
                                <option value="">-- Select --</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var positionViewRoute = "{{ route('position.show') }}";
        var positionStoreRoute = "{{ route('position.store') }}";
        var positionStoreRoute = "{{ route('position.store') }}";
        var positionUpdateRoute = "{{ route('position.update', ['id' => ':id']) }}";
        var positionDeleteRoute = "{{ route('position.destroy', ['id' => ':id']) }}";
    </script>
@endsection
