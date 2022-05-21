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
      {{--  <tbody>
            @foreach($languages as $language)
            <tr>
                <td>{{$language->id}}</td>
                 <td>{{$language->language}}</td>
                <td class="table-report__action w-56">
                    <div class="flex justify-center items-center">
                        <a class="flex items-center mr-3" href="{{url('/')}}/admin/language-edit/{{$language->id}}">
                            <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit
                        </a>
                        <a class="flex items-center text-theme-21" data-toggle="modal" data-target="#delete-confirmation-modal-{{$language->id}}">
                            <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                        </a>
                    </div>
                </td>
            </tr>

            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-confirmation-modal-{{$language->id}}" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{route('language-delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$language->id}}">
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
        </tbody> --}}
    </table>
</div>
   <script>
    $(document).ready(function() {
        $("#employeelist").dataTable().fnDestroy();
        var table = $('#employeelist').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
           
            paging: true,
            //pageLength: 10,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "{{route('language-list-pagination')}}",
            "bScrollInfinite": true,

            columns: [
                { data: 'id'},
                { data: 'language'},
                { data: 'action'},
            ],
        });
    });
    
</script>

 @endsection