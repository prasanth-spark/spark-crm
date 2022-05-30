@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Employee List</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0 mb-3">
        <button class="btn btn-primary shadow-md mr-2"><a href="{{route('file-upload')}}">File-Upload</a></button> 
        <button class="btn btn-primary shadow-md mr-2"><a href="{{route('employee-form')}}">Add New Employee</a></button>
      {{--  <button class="btn btn-primary shadow-md mr-2"><a href="{{route('new-register-list')}}">New Register List</a></button>--}}
    </div>
</div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table id="employeelist" class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">EMPLOYEE-ID</th>
                <th class="whitespace-nowrap">NAME</th>
                <th class="text-center whitespace-nowrap">PHONE</th>
                <th class="whitespace-nowrap">ROLE NAME</th>
                <th class="text-center whitespace-nowrap">TEAM</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
            </tr>
        </thead>
    </table>
</div>

<!-- END: Data List -->
<script type="text/javascript" src="{{URL::asset('dist/js/adminlistpagination/employee-list-pagination.js')}}"></script>



@endsection