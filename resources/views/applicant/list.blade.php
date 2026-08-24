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
                                <button type="button" class="btn btn-outline-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addApplicantModal">
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

    <div class="modal fade" id="addApplicantModal" tabindex="-1" aria-labelledby="addApplicantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addApplicantModalLabel">Add New Applicant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="#" method="post" id="addApplicant"> 
                    @csrf
                    <div class="modal-body">
                        
                        <!-- SECTION 1: Personal Information -->
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-user me-1"></i> Personal Information
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="fname" placeholder="First Name" class="form-control form-control-sm text-capitalize" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" name="mname" placeholder="Middle Name" class="form-control form-control-sm text-capitalize">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lname" placeholder="Last Name" class="form-control form-control-sm text-capitalize" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Ext.</label>
                                        <select class="form-select form-select-sm" name="ext">
                                            <option value="">N/A</option>
                                            <option value="Jr." {{ old('ext') == "Jr." ? 'selected' : '' }}>Jr.</option>
                                            <option value="Sr." {{ old('ext') == "Sr." ? 'selected' : '' }}>Sr.</option>
                                            <option value="III" {{ old('ext') == "III" ? 'selected' : '' }}>III</option>
                                            <option value="IV" {{ old('ext') == "IV" ? 'selected' : '' }}>IV</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Barangay <span class="text-danger">*</span></label>
                                        <input type="text" name="brgy" placeholder="Enter Barangay" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">TIN No. <span class="text-danger">*</span></label>
                                        <input type="text" name="tin_no" placeholder="Enter TIN No." class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: Vehicle Information -->
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-motorcycle me-1"></i> Vehicle Specifications
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Make <span class="text-danger">*</span></label>
                                        <input type="text" name="mtof_make" placeholder="e.g. Honda" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Color <span class="text-danger">*</span></label>
                                        <input type="text" name="mtof_color" placeholder="Enter Color" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Displacement (CC) <span class="text-danger">*</span></label>
                                        <input type="text" name="mtof_cc" placeholder="e.g. 125cc" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Engine No. <span class="text-danger">*</span></label>
                                        <input type="text" name="motor_no" placeholder="Enter Engine No." class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Chassis No. <span class="text-danger">*</span></label>
                                        <input type="text" name="chassis_no" placeholder="Enter Chassis No." class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Plate No. <span class="text-danger">*</span></label>
                                        <input type="text" name="plate_no" placeholder="Enter Plate No." class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">CR No. <span class="text-danger">*</span></label>
                                        <input type="text" name="cr_no" placeholder="Enter CR No." class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Date Acquired <span class="text-danger">*</span></label>
                                        <input type="date" name="date_acq" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: Driver Details -->
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-id-card me-1"></i> Driver Information
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Driver's Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="drivers_name" placeholder="Enter Full Name" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Driver's License No. <span class="text-danger">*</span></label>
                                        <input type="text" name="driver_license" placeholder="Enter License No." class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">DL Expiry Date <span class="text-danger">*</span></label>
                                        <input type="date" name="valid" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 4: Franchise & Registration -->
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-file-invoice me-1"></i> Franchise & Registration Details
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Body No. <span class="text-danger">*</span></label>
                                        <input type="text" name="body_no" placeholder="Enter Body No." class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Route No. <span class="text-danger">*</span></label>
                                        <input type="text" name="route_no" placeholder="Enter Route No." class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Color Code <span class="text-danger">*</span></label>
                                        <input type="text" name="color_code" placeholder="Enter Color Code" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">OR Date <span class="text-danger">*</span></label>
                                        <input type="date" name="or_date" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">OR No. <span class="text-danger">*</span></label>
                                        <input type="text" name="or_no" placeholder="Enter OR No." class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Save Applicant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editApplicantModal" tabindex="-1" aria-labelledby="editApplicantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editApplicantModalLabel">Edit Applicant Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form method="POST" id="editApplicant"> 
                    @csrf
                    <div class="modal-body">
                        
                        <!-- SECTION 1: Personal Information -->
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-user me-1"></i> Personal Information
                                </h6>
                                <input type="hidden" name="id" class="form-control form-control-sm" id="editappID">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="fname" placeholder="First Name" id="editAppfname" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm text-capitalize" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" name="mname" placeholder="Middle Name" id="editAppmname" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm text-capitalize">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lname" placeholder="Last Name" id="editApplname" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm text-capitalize" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Ext.</label>
                                        <select class="form-select form-select-sm" name="ext" id="editAppext">
                                            <option value="">N/A</option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Barangay <span class="text-danger">*</span></label>
                                        <input type="text" name="brgy" placeholder="Enter Barangay" id="editAppbgry" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">TIN No. <span class="text-danger">*</span></label>
                                        <input type="text" name="tin_no" placeholder="Enter TIN No." id="editApptinid" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: Vehicle Information -->
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-motorcycle me-1"></i> Vehicle Specifications
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Make <span class="text-danger">*</span></label>
                                        <input type="text" name="mtof_make" placeholder="e.g. Honda" id="editAppmtofmake" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Color <span class="text-danger">*</span></label>
                                        <input type="text" name="mtof_color" placeholder="Enter Color" id="editAppmtofcolor" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Displacement (CC) <span class="text-danger">*</span></label>
                                        <input type="text" name="mtof_cc" placeholder="e.g. 125cc" id="editAppmtofcc" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Engine No. <span class="text-danger">*</span></label>
                                        <input type="text" name="motor_no" placeholder="Enter Engine No." id="editAppmotorno" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Chassis No. <span class="text-danger">*</span></label>
                                        <input type="text" name="chassis_no" placeholder="Enter Chassis No." id="editAppchassisno" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Plate No. <span class="text-danger">*</span></label>
                                        <input type="text" name="plate_no" placeholder="Enter Plate No." id="editAppplateno" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">CR No. <span class="text-danger">*</span></label>
                                        <input type="text" name="cr_no" placeholder="Enter CR No." id="editAppcrno" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Date Acquired <span class="text-danger">*</span></label>
                                        <input type="date" name="date_acq" id="editAppdateacq" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">OR No. <span class="text-danger">*</span></label>
                                        <input type="text" name="or_no" placeholder="Enter OR No." id="editApporno" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: Driver Details -->
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-id-card me-1"></i> Driver Information
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Driver's Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="drivers_name" placeholder="Enter Full Name" id="editAppdriversname" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Driver's License No. <span class="text-danger">*</span></label>
                                        <input type="text" name="driver_license" placeholder="Enter License No." id="editAppdriverlicense" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">DL Expiry Date <span class="text-danger">*</span></label>
                                        <input type="date" name="valid" id="editAppvalid" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 4: Franchise & Registration -->
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-file-invoice me-1"></i> Franchise & Registration Details
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Body No. <span class="text-danger">*</span></label>
                                        <input type="text" name="body_no" placeholder="Enter Body No." id="editAppbodyno" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Route No. <span class="text-danger">*</span></label>
                                        <input type="text" name="route_no" placeholder="Enter Route No." id="editApprouteno" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Color Code <span class="text-danger">*</span></label>
                                        <input type="text" name="color_code" placeholder="Enter Color Code" id="editAppcolorcode" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">OR Date <span class="text-danger">*</span></label>
                                        <input type="date" name="or_date" id="editAppordate" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Save Applicant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewFormOneModal" tabindex="-1" role="dialog" aria-labelledby="viewFormOneModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="viewFormOneModalLabel">View Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <div class="text-center">Loading...</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="viewDocumentModal" tabindex="-1" role="dialog" aria-labelledby="viewDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="viewDocumentModalLabel">Select Documents</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <div class="table-responsive p-2">
                        <table class="table table-hover" id="doclist" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th>Document Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="documentList">
                                <!-- Document list will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="saveApplicantDocsBtn">
                        <i class="ti ti-check me-1"></i> Save Selections
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        var applicantReadRoute = "{{ route('applicant.show') }}";
        var applicantViewRoute = "{{ route('applicant.view', '') }}";
        var applicantDocSelectRoute = "{{ route('applicant.docs.get', '') }}";
        var applicantDocSaveRoute = "{{ route('applicant.docs.store') }}";
        var applicantUpdateRoute = "{{ route('applicant.update', ['id' => ':id']) }}";
        var applicantDeleteRoute = "{{ route('applicant.destroy', ['id' => ':id']) }}";
    </script>
@endsection
