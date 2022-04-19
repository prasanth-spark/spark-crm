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
                    <a href="{{route('edit-project',[$project->id])}}" class="btn btn-info btn-sm">Edit</a>
                    <a href="{{route('delete-project',[$project->id])}}" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>


<!-- END: Data List -->

@extends('../layout/script')
@endsection