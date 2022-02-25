@extends('../employee/layout/components/' . $layout)

@section('subhead')
    <title>Task List</title>
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
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
           {{-- <button class="btn btn-primary shadow-md mr-2"><a href="{{route('file-upload')}}">File-Upload</a></button>   --}}
           <button class="btn btn-primary shadow-md mr-2"><a href="{{route('task-form')}}">Add Task</a></button>  
        </div>
    </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table id="tasklist" class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">DATE</th>
                        <th class="whitespace-nowrap">PROJECT NAME</th>
                        <th class="whitespace-nowrap">TASK MODULE</th>
                        <th class="text-center whitespace-nowrap">ESTIMATED HOURS</th>
                        <th class="text-center whitespace-nowrap">WORKED HOURS</th>
                        <th class="text-center whitespace-nowrap">TASK STATUS</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
              @foreach($tasks as $task)
                        <tr>
                            <td>{{$task->date}}</td>
                            <td>{{$task->project_name}}</td>
                            <td>{{$task->task_module}}</td>  
                            <td>{{$task->estimated_hours}}</td>  
                            <td>{{$task->worked_hours}}</td>
                            @if($task->task_status == 1)
                            <td>Pending</td>
                            @else 
                            <td>Completed</td>
                            @endif
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{url('/')}}/employee/task-details/{{$task->id}}">
                                        <em data-feather="check-square" class="w-4 h-4 mr-1"></em> view
                                    </a>
                                    <a class="flex items-center mr-3" href="{{url('/')}}/employee/task-edit/{{$task->id}}">
                                        <em data-feather="check-square" class="w-4 h-4 mr-1"></em> Edit
                                    </a>
                                   
                                </div>
                            </td>
                        </tr>

             @endforeach
                </tbody>
            </table>
        </div>

        <!-- END: Data List -->
        <script>
            $(document).ready( function () {
                $('#tasklist').DataTable()
            } );
            </script>
      
   
@endsection


