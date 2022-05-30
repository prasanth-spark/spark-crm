    $(document).ready(function() {
        $("#employeelist").dataTable().fnDestroy();
        var table = $('#employeelist').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
           
            paging: true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": window.location.origin+"/admin/employee-list-pagination",
            "bScrollInfinite": true,

            columns: [
                { data: 'employee_id'},
                { data: 'name'},
                { data: 'phone_number'},
                { data: 'role_id'},
                { data: 'team_id'},
                { data: 'action'},
            ],
        });
    });
    
