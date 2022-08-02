$(document).ready(function() {
    attendanceFilter();

});

function attendanceFilter() {
    var fromdate = $('#from').val();
    var todate = $('#to').val();
    var team = $('#team').val();

    $("#employee").dataTable().fnDestroy();
    var table = $('#employee').DataTable({
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
        "sAjaxSource": window.location.origin+"/employee/attendancelistpagination",
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
                "value": team
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
                data: "team"
            },
            {
                data: "role"
            },
            {
                data: "status"
            },

        ],
    });
}