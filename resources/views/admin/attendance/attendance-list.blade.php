@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Employee List</title>

<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <form>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 md:col-span-4">
                <div>
                    <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                        From Date
                    </label>
                    <input id="from" type="date" class="form-control" placeholder="From Date" name="from_date" required>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <div>
                    <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                        To Date
                    </label>
                    <input id="to" type="date" class="form-control" placeholder="To Date" name="to_date" required>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <div>
                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Team</label>

                    <select placeholder="Team Name" type="text" class="tom-select w-full" id="team" name='team_name'>
                        <option value selected="selected" disabled="disabled"></option>
                        @foreach($teamList as $t)
                        <option value="{{$t->id}}">{{$t->team}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-primary mt-5" onclick="attendanceFilter()">Filter</button>
        </div>
</div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table id="employeelist" class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">SI.No</th>
                <th class="whitespace-nowrap">DATE</th>
                <th class="whitespace-nowrap">NAME</th>
                <th class="whitespace-nowrap">TEAM</th>
                <th class="whitespace-nowrap">ROLE</th>
                <th class="whitespace-nowrap">ATTENDANCE STATUS</th>
            </tr>
        </thead>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>




<script>
    $(document).ready(function() {
        attendanceFilter();

    });

    function attendanceFilter() {
        var fromdate = $('#from').val();
        var todate = $('#to').val();
        var team=$('#team').val();
        
        $("#employeelist").dataTable().fnDestroy();
        var table = $('#employeelist').DataTable({
            dom: "lBfrtip",
            buttons: [{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A3',

                    customize: function(doc) {
                        doc.defaultStyle.fontSize = 7.2;
                        doc.styles.tableHeader.fontSize = 10;
                    }

                },
                'excel', 'csv', 'print', 'copy',
            ],
            paging: true,
            //pageLength: 10,
            "searching": true,
            "ordering": false,
            "info": true,
            "lengthChange": true,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "{{route('attendance-list-pagination')}}",
            "bScrollInfinite": true,
            "fnServerParams": function(aoData) {
                aoData.push({
                    "name": "from_date",
                    "value": fromdate
                }, {
                    "name": "to_date",
                    "value": todate
                },{
                    "name":"team_name",
                    "value":team
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
</script>


@endsection