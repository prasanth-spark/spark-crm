$(document).ready(function() {

    permissionFilter();

});

function permissionFilter() {
    var fromdate = $('#from').val();
    var todate = $('#to').val();
    var teamName = $('#team_name').val();

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
        //pageLength: 10,
        "searching": true,
        "ordering": false,
        "info": true,
        "lengthChange": true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": window.location.origin+"/admin/permission-list-pagination",
        "bScrollInfinite": true,
        "fnServerParams": function(aoData) {
            aoData.push({
                "name": "from_date",
                "value": fromdate
            }, {
                "name": "to_date",
                "value": todate
            }, {
                "name": "team_name",
                "value": teamName
            });
        },

        columns: [{
                data: "id"
            },
            {
                data: "created_at"
            },
            {
                data: "name"
            },
            {
                data: "team"
            },
            {
                data: "role"
            },
            {
                data: "leave_type"
            },
            {
                data: "permission_status"
            },
            {
                data: "permission_hours_from"
            },
            {
                data: "permission_hours_to"
            },
            {
                data: "permission_hours"
            },


        ],
    });
}