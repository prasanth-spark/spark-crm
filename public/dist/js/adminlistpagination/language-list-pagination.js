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
        //pageLength: 10,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": window.location.origin+"/admin/language-list-pagination",
        "bScrollInfinite": true,

        columns: [
            { data: 'id'},
            { data: 'language'},
            { data: 'action'},
        ],
    });
});