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
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0 mb-3">
        <button class="btn btn-primary shadow-md mr-2"><a href="{{route('employee-list')}}">Back</a></button>
    </div>
</div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table id="employeelist" class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">NAME</th>
                <th class="whitespace-nowrap">ROLE</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($newRegisterList as $list)
            <tr>
                <td>{{$list->name}}</td>
                <td>{{isset($list->roleToUser->role) ? $list->roleToUser->role:''}}</td>
                <td class="table-report__action w-56">
                    <div class="flex justify-center items-center space-x-6">
                        <a class="flex items-center text-theme-20" href="{{url('/')}}/admin/approved/{{$list->id}}">
                            <i data-feather="edit" class="w-4 h-4 mr-1"></i> Approved
                        </a>
                        <a class="flex items-center text-theme-21" href="{{url('/')}}/admin/rejected/{{$list->id}}">
                            <i data-feather="edit" class="w-4 h-4 mr-1"></i> Rejected
                        </a>
  
                    </div>
                </td>
            </tr>

            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-confirmation-modal-{{$list->id}}" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{route('employee-delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$list->id}}">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="p-5 text-center">
                                    <em data-feather="x-circle" class="w-16 h-16 text-theme-21 mx-auto mt-3"></em>
                                    <div class="text-3xl mt-5">Are you sure?</div>
                                    <div class="text-gray-600 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                                </div>
                                <div class="px-5 pb-8 text-center">
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                    <button type="submit" class="btn btn-danger w-24">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->
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