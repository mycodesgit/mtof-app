<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left"
    };
    $(document).ready(function() {
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
                {data: 'sigposition'},
                {data: 'postedBy'},
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
                        if (type === 'display') {
                            var dropdown = '<div class="d-inline-block">' +
                                '<a class="btn btn-success btn-sm dropdown-toggle text-light dropdown-icon" data-bs-toggle="dropdown"></a>' +
                                '<div class="dropdown-menu">' +
                                '<a href="#" class="dropdown-item btn-useredit" data-id="' + row.id + '" data-fname="' + row.fname + '" data-mname="' + row.mname + '" data-lname="' + row.lname + '" data-ext="' + row.ext + '" data-email="' + row.email + '" data-campus="' + row.campus + '" data-dept="' + row.dept + '" data-role="' + row.role + '">' +
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
                    },
                },
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.id); 
            }
        });
        $(document).on('signatoryAdded', function() {
            dataTable.ajax.reload();
        });
    });
</script>