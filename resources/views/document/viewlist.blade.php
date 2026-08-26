@extends('layouts.app')

@section('title')
    MTOF - Document's List
@endsection

@section('body')
    <div class="row g-4">
        <!-- Page Header & Global Controls -->
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h1 class="h4 fw-bold mb-1">Documents</h1>
                <p class="text-muted small mb-0">List of official MTOF Documents for application records.</p>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-6">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="ti ti-plus"></i> Add New Documents
                                </h6>
                            </div>
                            <div class="card-body">
                                <form id="addDocumentCardForm" action="#" method="POST">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Document Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter document title" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-outline-success">
                                            <i class="ti ti-check"></i> Save Document
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
                                    <i class="ti ti-file"></i> List of Documents
                                </h6>
                            </div>
                            <div class="card-body">
                                <table id="documentlistTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Document Name</th>
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
    
    <div class="modal fade" id="editDocumentModal" tabindex="-1" role="dialog" aria-labelledby="editDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editDocumentModalLabel">Edit Document Title</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editDocumentForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editDocumentId">
                        <div class="col-md-12 mb-3">
                            <label for="editDocumentName">Document Title: <span class="text-danger">*</span></label>
                            <input name="title" id="editDocumentName" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editDocumentStatus">Status: <span class="text-danger">*</span></label>
                            <select id="editDocumentStatus" name="status" class="form-control"style="width: 100%;">
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
        var documentViewRoute = "{{ route('document.show') }}";
        var documentStoreRoute = "{{ route('document.store') }}";
        var documentStoreRoute = "{{ route('document.store') }}";
        var documentUpdateRoute = "{{ route('document.update', ['id' => ':id']) }}";
        var documentDeleteRoute = "{{ route('document.destroy', ['id' => ':id']) }}";
    </script>
@endsection
