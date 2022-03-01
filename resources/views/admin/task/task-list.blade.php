@extends('../admin/layout/components/' . $layout)

@section('subhead')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <form action="{{route('task-teamlist')}}" class="flex w-3/12 mb-3 space-x-4" method="post">
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
                <th class="whitespace-nowrap">DATE</th>
                <th class="whitespace-nowrap">NAME</th>
                <th class="whitespace-nowrap">ROLE</th>
                <th class="whitespace-nowrap">TEAM</th>
                <th class="whitespace-nowrap">PROJECT NAME</th>
                <th class="whitespace-nowrap">TASK STATUS</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($taskList as $task)
              @foreach($task->userTask as $t)
                <tr>                    
                    <td>{{$t->date}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$task->roleToUser->role}}</td>
                    <td>{{$task->userDetail->teamToUserDetails->team}}</td>
                    <td>{{$t->project_name}}</td>
                    <td>{{($t->task_status == 1) ? "pending" : "completed";}}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{url('/')}}/admin/task-details/{{$t->id}}">
                                <i data-feather="eye" class="w-4 h-4 mr-1"></i> view
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
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