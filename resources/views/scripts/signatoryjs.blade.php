<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left"
    };
    $(document).ready(function() {
        $('#addSignatoryForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: signatoryStoreRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                        $(document).trigger('signatoryAdded');
                        $('#addsignatoryModal').modal('hide');
                    } else {
                        toastr.error(response.message);
                        console.log(response);
                    }
                },
                error: function(xhr, status, error, message) {
                    var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                    toastr.error(errorMessage);
                }
            });
        });

        var dataTable = $('#signatorylistTable').DataTable({
            "ajax": {
                "url": signatoryReadRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {
                    data: null,
                    render: function(data, type, row) {
                        var firstname = data.sigfname;
                        var middleInitial = data.sigmname ? data.sigmname.substr(0, 1) + '.' : '';
                        var lastNameWithExt = data.siglname;

                        // Check if ext exists and is not 'N/A' or null
                        if (data.sigext && data.sigext !== 'N/A' && data.sigext !== null) {
                            lastNameWithExt += ' ' + data.sigext;
                        }

                        return firstname + ' ' + middleInitial + ' ' + lastNameWithExt;
                    }
                },
                {data: 'position_name'},
                {
                    data: 'formassign',
                    render: function(data, type, row) {
                        if (!data) return '<span class="text-muted">None</span>';
                        
                        // Convert array to array if passed as string
                        var forms = Array.isArray(data) ? data : (data.toString().split(','));
                        
                        // Format values as badges (e.g., f1 -> Form 1)
                        var badges = forms.map(function(form) {
                            var label = form.trim().toUpperCase().replace('F', 'Form ');
                            return '<span class="badge bg-primary me-1">' + label + '</span>';
                        });

                        return badges.join(' ') || '<span class="text-muted">None</span>';
                    }
                },
                {
                    data: 'signatory_role',
                    render: function(data, type, row) {
                        if (!data) return '<span class="text-muted">None</span>';
                        
                        var roles = Array.isArray(data) ? data : (data.toString().split(','));
                        
                        // Filter out null or empty string entries
                        var validRoles = roles.filter(function(role) {
                            return role && role.toString().trim() !== '' && role !== 'null';
                        });

                        if (validRoles.length === 0) return '<span class="text-muted">None</span>';

                        // Format roles into badges
                        var badges = validRoles.map(function(role) {
                            return '<span class="badge bg-info me-1">' + role.trim() + '</span>';
                        });

                        return badges.join(' ');
                    }
                },
                {
                    data: 'users',
                    render: function(data, type, row) {
                        var firstname = data.fname;
                        var middleInitial = data.mname ? data.mname.substr(0, 1) + '.' : '';
                        var lastNameWithExt = data.lname;

                        // Check if ext exists and is not 'N/A' or null
                        if (data.ext && data.ext !== 'N/A' && data.ext !== null) {
                            lastNameWithExt += ' ' + data.ext;
                        }

                        return firstname + ' ' + middleInitial + ' ' + lastNameWithExt;
                    }
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        let status = '';

                        if (data.status == 1) {
                            status = '<span class="badge bg-success">Enabled</span>';
                        } else {
                            status = '<span class="badge bg-danger">Disabled</span>';
                        } 
                        return status;
                    }
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        // Converts ["f1", "f2"] array into a simple string "f1,f2"
                        var formStr = Array.isArray(row.formassign) ? row.formassign.join(',') : (row.formassign || '');
                        var signatoryroleStr = Array.isArray(row.signatory_role) ? row.signatory_role.join(',') : (row.signatory_role || '');

                        if (type === 'display') {
                            var dropdown = '<div class="d-inline-block">' +
                                '<a class="btn btn-success btn-sm dropdown-toggle text-light dropdown-icon" data-bs-toggle="dropdown"></a>' +
                                '<div class="dropdown-menu">' +
                                '<a href="#" class="dropdown-item btn-signatoryedit"' +
                                ' data-id="' + row.id + '"' +
                                ' data-sigfname="' + (row.sigfname || '') + '"' +
                                ' data-sigmname="' + (row.sigmname || '') + '"' +
                                ' data-siglname="' + (row.siglname || '') + '"' +
                                ' data-sigext="' + (row.sigext || '') + '"' +
                                ' data-sigposition="' + (row.sigposition || '') + '"' +
                                ' data-signatory_role="' + signatoryroleStr + '"' +
                                ' data-formassign="' + formStr + '">' + // Changed row.formStr to formStr
                                '<i class="fas fa-pen"></i> Edit' +
                                '</a>' +
                                '<a href="#" class="dropdown-item btn-ustatusedit" data-id="' + row.id + '" data-ustatus="' + row.ustatus + '">' +
                                '<i class="fas fa-toggle-on"></i> Status' +
                                '</a>' +
                                '<button type="button" value="' + data + '" class="dropdown-item user-delete">' +
                                '<i class="fas fa-trash"></i> Delete' +
                                '</button>' +
                                '</div>' +
                                '</div>';
                            return dropdown;
                        } else {
                            return data;
                        }
                    }
                }
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.id); 
            }
        });
        $(document).on('signatoryAdded', function() {
            dataTable.ajax.reload();
        });
    });

    $(document).on('change', '.status-switch', function() {
        var labelText = $(this).closest('.form-check').find('.status-label-text');
        labelText.text(this.checked ? 'Released' : 'Not Selected');
    });

    $(document).on('click', '.btn-signatoryedit', function() {
        var $btn = $(this);
        
        $('#editsigId').val($(this).data('id'));
        $('#editFname').val($(this).data('sigfname'));
        $('#editMname').val($(this).data('sigmname'));
        $('#editLname').val($(this).data('siglname'));
        $('#editExt').val($(this).data('sigext'));
        $('#editPosition').val($(this).data('sigposition'));

        // 1. Reset all checkboxes first
        $('input[name="formassign[]"]').prop('checked', false);
        $('select[name="signatory_role[]"]').val('');

        // 2. Populate form assignment checkboxes
        var rawAssign = $(this).attr('data-formassign') || '';
        var assignedForms = rawAssign ? rawAssign.split(',') : [];

        // 3. Check matching switch inputs
        assignedForms.forEach(function(val) {
            var cleanVal = val.trim();
            if (cleanVal) {
                $('input[name="formassign[]"][value="' + cleanVal + '"]').prop('checked', true);
            }
        });

        // 3. Populate signatory roles dropdowns
        var rawRoles = $btn.attr('data-signatory_role') || '';
        var assignedRoles = rawRoles ? rawRoles.split(',') : [];

        assignedRoles.forEach(function(roleVal, index) {
            var formNum = index + 1; // Assuming roles map directly to form1, form2, etc.
            $('#editSignatoryRolef' + formNum).val(roleVal.trim());
        });

        // 4. Refresh switch text labels
        $('.status-switch').each(function() {
            var labelText = $(this).closest('.form-check').find('.status-label-text');
            labelText.text(this.checked ? 'Released' : 'Not Selected');
        });

        $('#editsignatoryModal').modal('show');
    });

    $('#editSignatoryForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: signatoryUpdateRoute,
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editsignatoryModal').modal('hide');
                    $(document).trigger('signatoryAdded');
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
</script>