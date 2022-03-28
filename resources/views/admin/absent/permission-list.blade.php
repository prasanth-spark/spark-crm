@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Permission List</title>
<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <form>
        <div class="grid grid-cols-12 gap-6 mt-4">
            <div class="col-span-12 md:col-span-4">
                <div>
                    <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                        From Date
                    </label>
                    <input id="from" class="form-control" type="tel" maxlength="10" placeholder="dd/mm/yyyy" oninput="this.value = DDMMYYYY(this.value, event)" name="from_date" required>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <div>
                    <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                        To Date
                    </label>
                    <input id="to" type="tel" class="form-control" maxlength="10" placeholder="dd/mm/yyyy" oninput="this.value = DDMMYYYY(this.value, event)" name="to_date" required>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <div>
                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Team</label>

                    <select placeholder="Team Name" type="text" class="tom-select w-full" id="team_name">
                        <option value="Select a Team" selected disabled>Select a Team</option>
                        @foreach($teamList as $t)
                        <option value="{{$t->id}}"> {{$t->team}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-primary mt-5" onclick="permissionFilter()">Filter</button>
        </div>
</div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table id="employeelist" class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">SI.NO</th>
                <th class="whitespace-nowrap">DATE</th>
                <th class="whitespace-nowrap">NAME</th>
                <th class="whitespace-nowrap">TEAM</th>
                <th class="whitespace-nowrap">ROLE</th>
                <th class="whitespace-nowrap">LEAVE TYPE</th>
                <th class="whitespace-nowrap">STATUS</th>
                <th class="whitespace-nowrap">HOURS FROM</th>
                <th class="whitespace-nowrap">HOURS TO</th>
                <th class="whitespace-nowrap">HOURS</th>
            </tr>
        </thead>
    </table>
</div>


<!-- END: Data List -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {

        permissionFilter();

    });

    function permissionFilter() {
        var fromdate = $('#from').val();
        var todate = $('#to').val();
        var teamName = $('#team_name').val();

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
            "sAjaxSource": "{{route('permission-list-pagination')}}",
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
    function DDMMYYYY(value, event) {
        let newValue = value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');

        const dayOrMonth = (index) => index % 2 === 1 && index < 4;

        // on delete key.  
        if (!event.data) {
            return value;
        }

        return newValue.split('').map((v, i) => dayOrMonth(i) ? v + '/' : v).join('');;
    }
</script>


@endsection