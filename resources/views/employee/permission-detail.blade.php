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
                <th class="whitespace-nowrap">NO</th>
                <th class="whitespace-nowrap">NAME</th>
                <th class="whitespace-nowrap">TEAM</th>
                <th class="whitespace-nowrap">ROLE</th>
                <th class="whitespace-nowrap">REQUEST<br>DATE</th>
                <th class="whitespace-nowrap">REQUEST<br>STATUS</th>
                <th class="whitespace-nowrap">FROM<br>DATE</th>
                <th class="whitespace-nowrap">TO<br>DATE</th>
                <th class="whitespace-nowrap">LEAVE<br>COUNT</th>
                <th class="whitespace-nowrap">PERMISSION<br>HOURS </th>
                <th class="whitespace-nowrap">ACTION</th>
            </tr>
        </thead>
      <tbody>
      @foreach($PermissionLists as $key => $permission)
                <tr>  
                    <td>{{$loop->index+1}}</td>
                    <td>{{$permission->leaverequestUser->name}}</td>
                    <td>{{$permission->leaverequestUser->teamToUser->team}}</td>
                    <td>{{$permission->leaverequestUser->roleToUser->name}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{date('d-m-Y', strtotime($permission->created_at));}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$permission->leave_type_id == 1 ? 'Permission' : 'Leave'}}</td>
                    <td>{{date('d-m-Y', strtotime($permission->start_date));}}</td>
                    <td>{{date('d-m-Y', strtotime($permission->end_date));}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$permission->leave_counts == null ? '-' : $permission->leave_counts}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$permission->permissionType == null ? '-' : $permission->permissionType->permission_hours}}</td>
                    <input type="hidden"  name="user_id" id="user_id_{{$key}}" value="{{$permission->user_id}}">                  
                   <input type="hidden"  name="type" id="type_id_{{$key}}" value="{{$permission->leave_type_id}}">
                   <input type="hidden"  name="id" id="id_{{$key}}" value="{{$permission->id}}">
                   <td>
                   <div class="flex justify-center items-center"> 
                    @can('permission-approvel')                  
                   <button type="button" onclick="approve('{{$key}}')"><img src="{{asset('dist/images/sparkout/check-circle (2).svg')}}" alt=""></button>
                    @endcan
                    @can('permission-deny')                  
                   <button type="button" onclick="deny('{{$key}}')"><img src="{{asset('dist/images/sparkout/x-circle.svg')}}" alt=""></button>
                   @endcan
                </div>
                </td>
                </tr>
        @endforeach
        </tbody> 
    </table>
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
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function approve(key) {
        var id = $('#id_'+key).val();
        var user_id = $('#user_id_'+key).val();
        var type = $('#type_id_'+key).val();
        var url = "{{ url('/')}}/employee/permission-approvel";
        $.ajax({
        url: url,
        type: 'POST',
        data: {
          id:id,
          user_id:user_id,
          type:type,
        },
        success: function(response) {
            window.location = "{{ url('/')}}/employee/permission";
        },
        error: function(error) {
          alert("Error");
        },
      });
   }
   function deny(key) {
    var id = $('#id_'+key).val();
    var user_id = $('#user_id_'+key).val();
    var type = $('#type_id_'+key).val();
    var url = "{{ url('/')}}/employee/permission-deny";
        $.ajax({
        url: url,
        type: 'POST',
        data: {
          id:id,
          user_id:user_id,
          type:type,
        },
        success: function(response) {
            window.location = "{{ url('/')}}/employee/permission";
        },
        error: function(error) {
          alert("Error");
        },
      });
   }
</script>
@endsection