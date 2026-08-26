<script>
    $(document).ready(function() {

        var dataTable = $('#gnrtdreports').DataTable({
            "ajax": {
                "url": reportViewRoute,
                "type": "GET",
                "data": function (d) {
                    d.status = $('select[name="status"]').val();
                    d.month = $('select[name="month"]').val();
                    d.year = $('select[name="year"]').val();
                }
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            buttons: [
                'excel', 'pdf'
            ],
            "columns": [
                {data: 'mtof_id'},
                { 
                    data: null,
                    render: function(data, type, row) {
                        var firstname = data.fname;
                        var middleInitial = data.mname ? data.mname.substr(0, 1) + '.' : '';
                        var lastNameWithExt = data.lname + (data.ext && data.ext !== 'null' ? ' ' + data.ext : '');
                        return firstname + ' ' + middleInitial + ' ' + lastNameWithExt;
                    }
                },
                {data: 'brgy'},
                {data: 'tin_no'},
                {data: 'mtof_make'},
                {data: 'mtof_color'},
                {data: 'mtof_cc'},
                {data: 'motor_no'},
                {data: 'chassis_no'},
                {data: 'plate_no'},
                {data: 'drivers_name'},
                {data: 'driver_license'},
                { 
                    data: 'date_acq',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
                    }
                },
                { 
                    data: 'valid',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'body_no'},
                {data: 'route_no'},
                {data: 'color_code'},
                { 
                    data: 'date_issued',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
                    }
                },
                { 
                    data: 'date_expired',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
                    }
                },
                { 
                    data: 'or_date',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'status1'},
                {data: 'status'},
            ],
            dom: 'Bfrtip'
        }).buttons().container().appendTo('#gnrtdreports_wrapper .col-md-6:eq(0)');
    });
</script>