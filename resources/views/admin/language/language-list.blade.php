@extends('../admin/layout/components/' . $layout)
@section('subhead')
<title>Language</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0 mb-3">
        <button class="btn btn-primary shadow-md mr-2"><a href="{{route('add-language')}}">Add Language</a></button> 
    </div>
</div>
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table id="employeelist" class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">SI.NO</th>
                <th class="whitespace-nowrap">LANGUAGE</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
            </tr>
        </thead>
    </table>
</div>
<script type="text/javascript" src="{{URL::asset('dist/js/adminlistpagination/language-list-pagination.js')}}"></script>

 @endsection