@extends('../employee/layout/components/' . $layout)

@section('subhead')
<title>Project List</title>
{{-- <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}"> --}}
<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <button class="btn btn-primary shadow-md mb-4"><a href="{{route('project-assign-form')}}">Add Project</a></button>
    </div>
</div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table id="tasklist" class="table table-report -mt-2">
        <thead>
            <tr>
                <th scope="col">SI.No</th>
                <th class="whitespace-nowrap">PROJECT NAME</th>
                <th class="whitespace-nowrap">PROJECT DESCRIPTION</th>
                <th class="whitespace-nowrap">USERS</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
             @foreach($projects as $key => $project)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$project->title}}</td>
                <td>{{$project->description}}</td>

                <td>
                    @foreach($project->users as $key =>$value)

                    {{(count($project->users->toArray()) > $key+1) ? $value->name.',' :$value->name}}

                    @endforeach
                </td>

                <td class="text-center whitespace-nowrap">
                    <a class="flex items-center mr-3" href="{{route('edit-project',[$project->id])}}">
                            <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit
                        </a>
                    <a class="flex items-center text-theme-21" data-toggle="modal" data-target="#delete-confirmation-modal-{{$project->id}}">
                            <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                    </a>
                </td>
            </tr>
             <!-- BEGIN: Delete Confirmation Modal -->
             <div id="delete-confirmation-modal-{{$project->id}}" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{route('delete-project',[$project->id])}}" method="post">
                        @csrf
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

@extends('../layout/script')
@endsection