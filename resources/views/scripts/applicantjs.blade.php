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
                        $(document).trigger('userAdded');
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
                {data: 'status'},
                {data: 'status1'},
                {
                    data: 'id',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<button type="button" class="btn btn-sm btn-warning btn-formsview mr-1 text-light" data-id="' + row.id + '" data-toggle="tooltip" data-placement="top" title="View Forms"><i class="fas fa-file-pdf"></i></button>&nbsp;';
                            buttons += '<button type="button" class="btn btn-sm btn-info btn-docsview mr-1" data-id="' + row.id + '" data-toggle="tooltip" data-placement="top" title="View Clearances & Documents"><i class="ti ti-file-type-doc"></i></button>&nbsp;';
                            var dropdown = '<div class="d-inline-block">' +
                                '<a class="btn btn-success btn-sm dropdown-toggle text-light dropdown-icon" data-bs-toggle="dropdown"></a>' +
                                '<div class="dropdown-menu">' +
                                '<a href="#" class="dropdown-item btn-useredit" data-id="' + row.id + '" data-fname="' + row.fname + '" data-mname="' + row.mname + '" data-lname="' + row.lname + '" data-ext="' + row.ext + '" data-email="' + row.email + '" data-campus="' + row.campus + '" data-dept="' + row.dept + '" data-role="' + row.role + '"><i class="fas fa-pen"></i> Edit</a>' +
                                '<a href="#" class="dropdown-item btn-ustatusedit" data-id="' + row.id + '" data-ustatus="' + row.ustatus + '"><i class="fas fa-toggle-on"></i> Status</a>' +
                                '<button type="button" value="' + data + '" class="dropdown-item user-delete"><i class="fas fa-trash"></i> Delete</button>' +
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

        $(document).on('userAdded', function() {
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
</script>