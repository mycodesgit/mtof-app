<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left"
    };

    var selectedAppId = null;
    var docTable = null;

    $(document).ready(function() {
        // 1. Add User Submit
        $('#addUser').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: userCreateRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        $(document).trigger('applicantAdded');
                        $('#addUserModal').modal('hide');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                    toastr.error(errorMessage);
                }
            });
        });

        // 2. Main Applicant Table
        var dataTable = $('#applicantlistTable').DataTable({
            "ajax": {
                "url": applicantReadRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {data: 'mtof_id'},
                {
                    data: null,
                    render: function(data, type, row) {
                        var firstname = data.fname || '';
                        var middleInitial = data.mname ? data.mname.substr(0, 1) + '.' : '';
                        var lastNameWithExt = data.lname || '';

                        if (data.ext && data.ext !== 'N/A' && data.ext !== null) {
                            lastNameWithExt += ' ' + data.ext;
                        }

                        return (firstname + ' ' + middleInitial + ' ' + lastNameWithExt).trim();
                    }
                },
                {data: 'status1'},
                {data: 'status'},
                {
                    data: 'id',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<button type="button" class="btn btn-sm btn-warning btn-formsview mr-1" data-id="' + row.id + '" data-toggle="tooltip" data-placement="top" title="View Forms"><i class="fas fa-file-pdf"></i></button>&nbsp;';
                            buttons += '<button type="button" class="btn btn-sm btn-info btn-docsview mr-1" data-id="' + row.id + '" data-toggle="tooltip" data-placement="top" title="View Clearances & Documents"><i class="ti ti-file-type-doc"></i></button>&nbsp;';
                            var dropdown = '<div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="More Options">' +
                                '<button type="button" class="btn btn-success btn-sm btn-light" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>' +
                                '<div class="dropdown-menu">' +
                                '<a href="#" class="dropdown-item btn-appedit" data-toggle="tooltip" data-placement="top" title="Edit Applicant Info" data-id="' + row.id + '" data-fname="' + row.fname + '" data-mname="' + row.mname + '" data-lname="' + row.lname + '" data-brgy="' + row.brgy + '" data-tin_no="' + row.tin_no + '" data-mtof_make="' + row.mtof_make + '" data-mtof_color="' + row.mtof_color + '" data-mtof_cc="' + row.mtof_cc + '" data-motor_no="' + row.motor_no + '" data-chassis_no="' + row.chassis_no + '" data-plate_no="' + row.plate_no + '" data-body_no="' + row.body_no + '" data-route_no="' + row.route_no + '" data-color_code="' + row.color_code + '" data-cr_no="' + row.cr_no + '" data-or_no="' + row.or_no + '" data-or_date="' + row.or_date + '" data-date_acq="' + row.date_acq + '" data-valid="' + row.valid + '" data-drivers_name="' + row.drivers_name + '" data-driver_license="' + row.driver_license + '" data-mtof_id="' + row.mtof_id + '" data-p_name="' + row.p_name + '" data-status="' + row.status + '" data-status1="' + row.status1 + '" data-date_issued="' + row.date_issued + '" data-date_expired="' + row.date_expired + '"><i class="fas fa-pen"></i> Edit Information</a>' +
                                '<a href="#" class="dropdown-item btn-ustatusedit" data-toggle="tooltip" data-placement="top" title="Applicant Document Status" data-id="' + row.id + '" data-status="' + row.status + '" data-status1="' + row.status1 + '"><i class="fas fa-toggle-on"></i> Document Status</a>' +
                                '<button type="button" data-toggle="tooltip" data-placement="top" title="Delete Applicant Info" value="' + data + '" class="dropdown-item applcnt-delete"><i class="fas fa-trash"></i> Delete</button>' +
                                '</div></div>';
                            return buttons + dropdown;
                        } else {
                            return data;
                        }
                    },
                },
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.id); 
            }
        });

        dataTable.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).on('applicantAdded', function() {
            dataTable.ajax.reload();
        });

        // 3. Document Modal DataTable (Empty default data array)
        docTable = $('#doclist').DataTable({
            data: [],
            destroy: true,
            info: false,
            responsive: true,
            lengthChange: false,
            searching: false,
            paging: false,
            "columns": [
                {data: 'title'},
                {
                    data: 'id',
                    className: 'text-center align-middle',
                    render: function (data, type, row) {
                        var isChecked = row.is_selected ? 'checked' : '';
                        return `
                            <div class="form-check form-switch d-flex justify-content-center align-items-center m-0 p-0">
                                <input class="form-check-input doc-checkbox doc-switch-success m-0" 
                                    type="checkbox" 
                                    value="${row.id}" 
                                    ${isChecked}>
                            </div>`;
                    }
                }
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.id); 
            }
        });

        // 4. Save Button Handler
        $('#saveApplicantDocsBtn').on('click', function() {
            var selectedDocIds = [];
            $('.doc-checkbox:checked').each(function() {
                selectedDocIds.push($(this).val());
            });

            $.ajax({
                url: applicantDocSaveRoute,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    appID: selectedAppId,
                    docIDs: selectedDocIds
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        $('#viewDocumentModal').modal('hide');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('Failed to save document choices.');
                }
            });
        });
    });

    // 5. Open Forms Modal
    $(document).on('click', '.btn-formsview', function () {
        var id = $(this).data('id');

        $('#viewFormOneModal').modal('show');
        $('#modalContent').html('<div class="text-center">Loading...</div>');

        $.ajax({
            url: applicantViewRoute + '/' + id,
            type: 'GET',
            success: function (response) {
                $('#modalContent').html(response);
            },
            error: function () {
                $('#modalContent').html('<div class="alert alert-danger">Failed to load data.</div>');
            }
        });
    });

    // 6. Open Documents Modal & Load Applicant Options
    $(document).on('click', '.btn-docsview', function () {
        selectedAppId = $(this).data('id');
        $('#viewDocumentModal').modal('show');

        // Calls GET /applicant/get-docs/{id}
        docTable.ajax.url(applicantDocSelectRoute + '/' + selectedAppId).load();
    });

    // 7. Open Applicant Information Modal 
    $(document).on('click', '.btn-appedit', function() {
        var id = $(this).data('id');
        var fName = $(this).data('fname');
        var mName = $(this).data('mname');
        var lName = $(this).data('lname');
        var extName = $(this).data('ext');
        var brgyName = $(this).data('brgy');
        var tinName = $(this).data('tin_no');
        
        var mtofmakeName = $(this).data('mtof_make');
        var mtofcolorName = $(this).data('mtof_color');
        var mtofccName = $(this).data('mtof_cc');
        var motorNo = $(this).data('motor_no');
        var chassisNo = $(this).data('chassis_no');
        var plateNo = $(this).data('plate_no');
        var crNo = $(this).data('cr_no');
        var dateAcq = $(this).data('date_acq');

        var driversName = $(this).data('drivers_name');
        var driverLicense = $(this).data('driver_license');
        var validDate = $(this).data('valid');

        var bodyNo = $(this).data('body_no');
        var routeNo = $(this).data('route_no');
        var colorCode = $(this).data('color_code');
        var orDate = $(this).data('or_date');
        var orNo = $(this).data('or_no');

        // Section 1: Personal Information
        $('#editappID').val(id);
        $('#editAppfname').val(fName);
        $('#editAppmname').val(mName);
        $('#editApplname').val(lName);
        $('#editAppext').val(extName);
        $('#editAppbgry').val(brgyName);
        $('#editApptinid').val(tinName);

        // Section 2: Vehicle Information
        $('#editAppmtofmake').val(mtofmakeName);
        $('#editAppmtofcolor').val(mtofcolorName);
        $('#editAppmtofcc').val(mtofccName);
        $('#editAppmotorno').val(motorNo);
        $('#editAppchassisno').val(chassisNo);
        $('#editAppplateno').val(plateNo);
        $('#editAppcrno').val(crNo);
        $('#editAppdateacq').val(dateAcq);

        // Section 3: Driver Information
        $('#editAppdriversname').val(driversName);
        $('#editAppdriverlicense').val(driverLicense);
        $('#editAppvalid').val(validDate);

        // Section 4: Franchise & Registration
        $('#editAppbodyno').val(bodyNo);
        $('#editApprouteno').val(routeNo);
        $('#editAppcolorcode').val(colorCode);
        $('#editAppordate').val(orDate);
        $('#editApporno').val(orNo);

        $('#editApplicantModal').modal('show');
    });

    $('#editApplicant').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: applicantUpdateRoute,
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editApplicantModal').modal('hide');
                    $(document).trigger('applicantAdded');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error, message) {
                var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                toastr.error(errorMessage);
            }
        });
    });

    // 7. Open Applicant Document Status Modal 
    $(document).on('click', '.btn-ustatusedit', function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var statusOne = $(this).data('status1');

        $('#editAppStatusId').val(id);
        $('#editAppStatus').prop('checked', statusOne === 'Released');
        $('#editAppStatus1').val(status);

        $('#viewAppStatusModal').modal('show');
    });

    $(document).on('click', '.applcnt-delete', function(e) {
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to recover this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: applicantDeleteRoute.replace(':id', id),
                    success: function(response) {
                        $("#tr-" + id).delay(1000).fadeOut();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Successfully Deleted!',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if(response.success) {
                            toastr.success(response.message);
                            console.log(response);
                        }
                    }
                });
            }
        })
    });
</script>