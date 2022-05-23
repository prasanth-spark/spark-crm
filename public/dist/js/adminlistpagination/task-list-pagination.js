$(document).ready(function() {

    taskFilter();

});

function taskFilter() {
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
        "searching": true,
        "ordering": false,
        "info": true,
        "lengthChange": true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": window.location.origin+"/admin/task-list-pagination",
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
                data: "date"
            },
            {
                data: "name"
            },
            {
                data: "role"
            },
            {
                data: "team"
            },
            {
                data: "project_name"
            },
            {
                data: "leave_status"
            },
            {
                data: "action"
            },
            
        ],
    });
}