@extends('../employee/layout/components/' . $layout)


@section('subhead')
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
      <tbody>
        @foreach($teamabsentList as $absent)
                <tr>  

                    <td>{{$absent->leaverequestUser->name}}</td>
                    <td>{{$absent->leaveToUserDetails->teamToUserDetails->team}}</td>
                    <td>{{$absent->leaverequestUser->roleToUser->role}}</td>
                    <td>{{$absent->leaverequest->leave_type}}</td>
                    <td>
                            @switch($absent->leave_status)
                                @case($absent->leave_status==1)
                                pending
                                @break

                                @case($absent->leave_status==2)
                                    approved
                                @break

                                @default
                                    rejected
                            @endswitch
                    </td>
                    <td>{{$absent->start_date}}</td>
                    <td>{{$absent->end_date}}</td>

                </tr>
            @endforeach
        </tbody> 
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