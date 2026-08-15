<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left"
    };
    $(document).ready(function() {
        $('#addDocumentCardForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: documentStoreRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                        $(document).trigger('docsAdded');
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

        var dataTable = $('#documentlistTable').DataTable({
            "ajax": {
                "url": documentViewRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {data: 'title'},
                {
                    data: null,
                    render: function (data, type, row) {
                        let status = '';

                        if (row.status === 'Active') {
                            status = '<span class="badge bg-success">Active</span>';
                        } else {
                            status = '<span class="badge bg-danger">Inactive</span>';
                        } 
                        return status;
                    }
                },
                {
                    data: 'created_at',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
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
        $(document).on('docsAdded', function() {
            dataTable.ajax.reload();
        });
    });
</script>