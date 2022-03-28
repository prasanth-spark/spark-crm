@extends('../employee/layout/components/' . $layout)

@section('subhead')
    <title>Task List</title>
    {{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}"> --}}
    <link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> 
   
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"></h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
           {{-- <button class="btn btn-primary shadow-md mr-2"><a href="{{route('file-upload')}}">File-Upload</a></button>   --}}
           <button class="btn btn-primary shadow-md mb-4"><a href="{{route('task-form')}}">Add Task</a></button>  
        </div>
    </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table id="tasklist" class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th scope="col">SI.No</th>
                        <th class="whitespace-nowrap">DATE</th>
                        <th class="whitespace-nowrap">PROJECT NAME</th>
                        <th class="whitespace-nowrap">TASK MODULE</th>
                        <th class="text-center whitespace-nowrap">ESTIMATED HOURS</th>
                        <th class="text-center whitespace-nowrap">WORKED HOURS</th>
                        <th class="text-center whitespace-nowrap">TASK STATUS</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
            </table>
        </div>
       
        
        <!-- END: Data List -->
       
        @extends('../layout/script')  

        <script>
            $(document).ready(function() {
                $('#tasklist').DataTable({
                "processing": true,
                "serverSide": true,
                paging: true,
                "searching": true,
                "ordering": false,
                "info": true,
                "lengthChange": true,
                "bProcessing": true,
                "bServerSide": true,
                "destroy": true,
                "sAjaxSource": "task-pagination",

                columns: [
                    { data: "id"},
                    { data: "date" },
                    { data: "project_name" },
                    { data: "task_module" },
                    { data: "estimated_hours"},
                    { data: "worked_hours"},
                    { data: "task_status"},
                    { data: "actions" },
                ],
            } );
        } );
        </script>

@endsection


