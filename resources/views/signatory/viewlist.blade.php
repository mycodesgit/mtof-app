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
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editStudFeeId">
                        <div class="form-group">
                            <label for="editFname">First Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter First name" id="addFname" name="sigfname">
                        </div>
                        <div class="form-group mt-3">
                            <label for="addMname">Middle Name:</label>
                            <input type="text" class="form-control" placeholder="Enter middle name" id="addMname" name="sigfname">
                        </div>
                        <div class="form-group mt-3">
                            <label for="addLname">Last Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Last name" id="addLname" name="sigfname">
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
                                <option value="Secretary to Sanguniang Bayan">Secretary to Sanguniang Bayan</option>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editsignatureModalLabel">Edit Signatory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSignatoryForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editsigId">
                        <div class="form-group">
                            <label for="editFname">First Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" id="editFname" name="sigfname">
                        </div>
                        <div class="form-group mt-3">
                            <label for="editMname">Middle Name:</label>
                            <input type="text" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" id="editMname" name="sigmname">
                        </div>
                        <div class="form-group mt-3">
                            <label for="editLname">Last Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" id="editLname" name="siglname">
                        </div>
                        <div class="form-group mt-3">
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
                        <div class="form-group mt-3">
                            <label for="editPosition">Position: <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" id="editPosition" name="sigposition">
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

    <script>
        var signatoryReadRoute = "{{ route('signatory.show') }}";
        var signatoryStoreRoute = "{{ route('signatory.store') }}";
        var signatoryUpdateRoute = "{{ route('signatory.update', ['id' => ':id']) }}";
    </script>
@endsection
 