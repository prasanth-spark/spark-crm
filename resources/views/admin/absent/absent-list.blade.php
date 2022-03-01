@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Employee List</title>
<script src="https://code.jquery.com/jquery-1.12.3.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <form action="{{route('attendance-teamlist')}}" class="flex w-3/12 mb-3 space-x-4" method="post">
        @csrf
        <select placeholder="Team Name" type="text" class="tom-select w-full" id="regular-form-4" name='team_id'>
            <option value selected="selected" disabled="disabled"></option>
            @foreach($teamList as $t)
            <option value="{{$t->id}}"> {{$t->team}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary mt-0">Submit</button>
    </form>

</div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table id="employeelist" class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">NAME</th>
                <th class="whitespace-nowrap">TEAM</th>
                <th class="whitespace-nowrap">ROLE</th>
                <th class="whitespace-nowrap">LEAVE TYPE</th>
                <th class="whitespace-nowrap">LEAVE STATUS</th>
                <th class="whitespace-nowrap">FROM DATE</th>
                <th class="whitespace-nowrap">END DATE</th>


            </tr>
        </thead>
     {{--   <tbody>
        @foreach($attendanceList as $attendance)
                <tr>  

                    <td>{{$attendance->date}}</td>
                    <td>{{$attendance->attendanceToUser->name}}</td>
                    <td>{{$attendance->attendanceToUserDetails->teamToUserDetails->team}}</td>
                    <td>{{$attendance->attendanceToUser->roleToUser->role}}</td>
                    <td>{{($attendance->attendance_status == 1) ? "present" : "absent";}}</td>
                </tr>
            @endforeach
        </tbody> --}}
    </table>
</div>


<!-- END: Data List -->
<script>
    $(document).ready(function() {
        $('#employeelist').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>


@endsection