@extends('layouts.app')

@section('title')
    MTOF - Document's List
@endsection

@section('body')
    <div class="row ">
        <div class="col-md-12">
            <div class="mb-6">
                <h1 class="fs-5 mb-4">Documents</h1>
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
    
    <script>
        var documentViewRoute = "{{ route('document.show') }}";
        var documentStoreRoute = "{{ route('document.store') }}";
    </script>
@endsection
