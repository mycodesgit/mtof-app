@extends('layouts.app')

@section('title')
    MTOF - User's List
@endsection

@section('body')
    <div class="row ">
        <div class="col-md-12">
            <div class="mb-6">
                <h1 class="fs-5 mb-4">Users</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="ti ti-users"></i> List of Users
                                </h6>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                    <i class="ti ti-user-plus"></i> Add New
                                </button>
                                <table id="UserlistTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Date Created</th>
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

    <div class="modal fade mt-6" id="addUserModal" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addsignatureModalLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUserForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label>First Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="fname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter First Name" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-4">
                                    <label>Middle Name: </label>
                                    <input type="text" name="mname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Middle Name" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-4">
                                    <label>Last Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="lname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Last Name" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label>Ext.: </label>
                                    <select class="form-control form-control-sm" name="ext">
                                        <option value="">N/A</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <label>Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" placeholder="Enter Username" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-4">
                                    <label>Password: <span class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <input type="password" name="password" class="form-control form-control-sm" id="passwordInput" placeholder="••••••••">
                                        <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted p-1" id="togglePassword">
                                            <i class="ti ti-eye fs-5" id="passwordIcon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
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

    <div class="modal fade mt-6" id="editUserModal" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editsignatureModalLabel">Edit Signatory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm">
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

    <div class="modal fade" id="edituserModal" tabindex="-1" aria-modal="true" role="dialog" aria-labelledby="edituserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edituserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="edituserForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edituserId">

                        <!-- Name Information Section -->
                        <div class="mb-3">
                            <h6 class="text-muted fw-bold mb-2">Personal Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="fname" id="edituserfname" 
                                        oninput="capitalizeWords(this)" 
                                        placeholder="Enter First Name" 
                                        class="form-control form-control-sm">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" name="mname" id="editusermname" 
                                        oninput="capitalizeWords(this)" 
                                        placeholder="Enter Middle Name" 
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="lname" id="edituserlname" 
                                        oninput="capitalizeWords(this)" 
                                        placeholder="Enter Last Name" 
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ext.</label>
                                    <select class="form-control form-control-sm" name="ext" id="edituserext">
                                        <option value="">N/A</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Account & Additional Details Section -->
                        <div class="mb-2 mt-3">
                            <h6 class="text-muted fw-bold mb-2">Account Credential</h6>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" id="editusername" 
                                        placeholder="Enter Username" 
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edituserPassModal" tabindex="-1" aria-modal="true" role="dialog" aria-labelledby="edituserPassModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edituserPassModalLabel">Change User Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="edituserPassForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edituserPassId">

                        <div class="form-group">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label>New Password: <span class="text-danger">*</span></label>
                                    <input type="text" name="password" id="edituserpass" placeholder="Enter New Password" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edituserDeactModal" tabindex="-1" aria-modal="true" role="dialog" aria-labelledby="edituserDeactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edituserDeactModalLabel">Change User Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="edituserDeactForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edituserDeactId">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Name: <span class="text-danger">*</span></label>
                                    <input type="text" id="edituserDeactfullname"  class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Change User Status: <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control form-control-sm" id="edituserDeactStat">
                                        <option disabled selected> --Select-- </option>
                                        <option value="1">Enable</option>
                                        <option value="2">Disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Password Show/Hide Toggle Logic
        const togglePasswordBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const passwordIcon = document.getElementById('passwordIcon');

        if (togglePasswordBtn && passwordInput && passwordIcon) {
            togglePasswordBtn.addEventListener('click', function (e) {
                e.preventDefault();
                
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                if (isPassword) {
                    passwordIcon.classList.remove('ti-eye');
                    passwordIcon.classList.add('ti-eye-off');
                } else {
                    passwordIcon.classList.remove('ti-eye-off');
                    passwordIcon.classList.add('ti-eye');
                }
            });
        }

        var usersReadRoute = "{{ route('users.show') }}";
        var usersCreateRoute = "{{ route('users.create') }}";
        var usersUpdateRoute = "{{ route('users.update', ['id' => ':id']) }}";
        var userpassUpdateRoute = "{{ route('userPassUpdate', ['id' => ':id']) }}";
        var userDeactRoute = "{{ route('userStatusUpdate', ['id' => ':id']) }}";
    </script>
@endsection
 