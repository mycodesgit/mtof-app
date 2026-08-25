@extends('layouts.app')

@section('title')
    MTOF - Signatory List
@endsection

@section('body')
    <div class="row ">
        <div class="col-md-12">
            <div class="mb-6">
                <h1 class="fs-5 mb-4">Signatory</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="ti ti-users"></i> List of Signatory
                                </h6>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addsignatoryModal">
                                    <i class="ti ti-user-plus"></i> Add New
                                </button>
                                <table id="signatorylistTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Posted by</th>
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

    <div class="modal fade mt-6" id="addsignatoryModal" role="dialog" aria-labelledby="addsignatoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addsignatureModalLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addSignatoryForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editStudFeeId">
                        <div class="form-group">
                            <label for="editFname">First Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter First name" id="addFname" oninput="this.value = this.value.toUpperCase()" name="sigfname">
                        </div>
                        <div class="form-group mt-3">
                            <label for="addMname">Middle Name:</label>
                            <input type="text" class="form-control" placeholder="Enter middle name" id="addMname" oninput="this.value = this.value.toUpperCase()" name="sigmname">
                        </div>
                        <div class="form-group mt-3">
                            <label for="addLname">Last Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Last name" id="addLname" oninput="this.value = this.value.toUpperCase()" name="siglname">
                        </div>
                        <div class="form-group mt-3">
                            <label for="addext">Extension Name: <span class="text-danger">*</span></label>
                            <select name="sigext" id="addext" class="form-control">
                                <option value=""> ---Select--- </option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                                <option value="VI">VI</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="addPosition">Position: <span class="text-danger">*</span></label>
                            <select class="form-control select2bs4" id="addPosition" name="sigposition">
                                <option disabled selected> ---Select---</option>
                                @foreach ($pos as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade mt-6" id="editsignatoryModal" role="dialog" aria-labelledby="editsignatoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editsignatureModalLabel">Edit Signatory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSignatoryForm">
                    @csrf
                    <div class="row p-4">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="hidden" name="id" id="editsigId">
                                    <label for="editFname">First Name: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" id="editFname" name="sigfname">
                                </div>
                                <div class="col-md-6">
                                    <label for="editMname">Middle Name:</label>
                                    <input type="text" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" id="editMname" name="sigmname">
                                </div>
                                <div class="col-md-6">
                                    <label for="editLname">Last Name: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" id="editLname" name="siglname">
                                </div>
                                <div class="col-md-6">
                                    <label for="editExt">Extension Name: <span class="text-danger">*</span></label>
                                    <select name="sigext" id="editExt" class="form-control form-control-sm">
                                        <option value=""> ---Select--- </option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                        <label for="editPosition">Position: <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" id="editPosition" name="sigposition">
                                            <option disabled selected> ---Select---</option>
                                            @foreach ($pos as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <table class="table table-hover" id="doclist" style="width: 100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Assignment</th>
                                                    <th class="text-center">Selection</th>
                                                    <th class="text-center">Role</th>
                                                </tr>
                                            </thead>
                                            <tbody id="positionList">
                                                <!-- Repeat for Forms 1 through 5 -->
                                                <tr>
                                                    <td class="align-middle">Form 1</td>
                                                    <td class="align-middle text-center">
                                                        <div class="form-check form-switch d-inline-flex align-items-center gap-2 ps-0">
                                                            <input class="form-check-input doc-checkbox doc-switch-success status-switch m-0" 
                                                                type="checkbox" 
                                                                name="formassign[]" 
                                                                id="editAppStatus1" 
                                                                value="f1">
                                                            <label class="form-check-label fw-medium cursor-pointer mb-0" for="editAppStatus1">
                                                                <span class="status-label-text">Not Selected</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select name="signatory_role[]" id="editSignatoryRolef1" class="form-control form-control-sm">
                                                            <option value=""> --Select-- </option>
                                                            <option value="Processed">Processed</option>
                                                            <option value="Verified">Verified</option>
                                                            <option value="Noted">Noted</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">Form 2</td>
                                                    <td class="align-middle text-center">
                                                        <div class="form-check form-switch d-inline-flex align-items-center gap-2 ps-0">
                                                            <input class="form-check-input doc-checkbox doc-switch-success status-switch m-0" 
                                                                type="checkbox" 
                                                                name="formassign[]" 
                                                                id="editAppStatus2" 
                                                                value="f2">
                                                            <label class="form-check-label fw-medium cursor-pointer mb-0" for="editAppStatus2">
                                                                <span class="status-label-text">Not Selected</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select name="signatory_role[]" id="editSignatoryRolef2" class="form-control form-control-sm">
                                                            <option value=""> --Select-- </option>
                                                            <option value="Inspected">Inspected</option>
                                                            <option value="Endorsed">Endorsed</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">Form 3</td>
                                                    <td class="align-middle text-center">
                                                        <div class="form-check form-switch d-inline-flex align-items-center gap-2 ps-0">
                                                            <input class="form-check-input doc-checkbox doc-switch-success status-switch m-0" 
                                                                type="checkbox" 
                                                                name="formassign[]" 
                                                                id="editAppStatus3" 
                                                                value="f3">
                                                            <label class="form-check-label fw-medium cursor-pointer mb-0" for="editAppStatus3">
                                                                <span class="status-label-text">Not Selected</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select name="signatory_role[]" id="editSignatoryRolef3" class="form-control form-control-sm">
                                                            <option value=""> --Select-- </option>
                                                            <option value="Recommending Approval:">Recommending Approval</option>
                                                            <option value="Approved">Approved</option>
                                                            <option value="Attested">Attested</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">Form 4</td>
                                                    <td class="align-middle text-center">
                                                        <div class="form-check form-switch d-inline-flex align-items-center gap-2 ps-0">
                                                            <input class="form-check-input doc-checkbox doc-switch-success status-switch m-0" 
                                                                type="checkbox" 
                                                                name="formassign[]" 
                                                                id="editAppStatus4" 
                                                                value="f4">
                                                            <label class="form-check-label fw-medium cursor-pointer mb-0" for="editAppStatus4">
                                                                <span class="status-label-text">Not Selected</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">Form 5</td>
                                                    <td class="align-middle text-center">
                                                        <div class="form-check form-switch d-inline-flex align-items-center gap-2 ps-0">
                                                            <input class="form-check-input doc-checkbox doc-switch-success status-switch m-0" 
                                                                type="checkbox" 
                                                                name="formassign[]" 
                                                                id="editAppStatus5" 
                                                                value="f5">
                                                            <label class="form-check-label fw-medium cursor-pointer mb-0" for="editAppStatus5">
                                                                <span class="status-label-text">Not Selected</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var signatoryReadRoute = "{{ route('signatory.show') }}";
        var signatoryStoreRoute = "{{ route('signatory.store') }}";
        var signatoryUpdateRoute = "{{ route('signatory.update', ['id' => ':id']) }}";
    </script>
@endsection
 