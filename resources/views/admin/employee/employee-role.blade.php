@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Role List</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <a class="btn btn-primary" data-toggle="modal" data-target="#add-confirmation-modal">
                <i data-feather="trash-2" class="w-4 h-3 mr-1"></i> Add Role
                </a></div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table id="employeelist" class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">SL.NO</th>
                <th class="whitespace-nowrap">ROLE NAME</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
             <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$role->name}}</td>
                <td>
                <div class="flex justify-center items-center">                
                <a class="btn btn-primary" href={{"roles-permission-list/".$role['id']}}>Edit</a>
                <a class="btn btn-danger" data-toggle="modal" data-target="#delete-confirmation-modal-{{$role->id}}">
                <i data-feather="trash-2" class="w-4 h-3 mr-1"></i> Delete
                </a>
               </div>
                </td>
            </tr>
             <!-- BEGIN: Delete Confirmation Modal -->
             <div id="delete-confirmation-modal-{{$role->id}}" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="delete-role" method="post">
                    <input type="hidden" name="role_id" value="{{$role->id}}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="p-5 text-center">
                                    <em data-feather="x-circle" class="w-16 h-16 text-theme-21 mx-auto mt-3"></em>
                                    <div class="text-3xl mt-5">Are you sure?</div>
                                    <div class="text-gray-600 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                                </div>
                                <div class="px-5 pb-8 flex items-center justify-between">
                                    <div>
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                    </div>
                                    <div>
                                    <button type="submit" class="btn btn-danger w-24">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        @endforeach
      </tbody>
    </table>
</div>

<div id="add-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="add-role" method="post" id="form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-body p-0">
                            <div class="p-5 text-center">
                            <div class="col-span-12 md:col-span-6">
                                        <label for="regular-form-2" class="form-label w-full flex flex-col sm:flex-row">
                                            Role Name<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                                        </label>
                                        <input  type="text" class="form-control" placeholder="Role Name" name='name' id="role_name" onchange="role()">
                                    </div>
                                </div>
                            </div>
                                <div class="px-5 pb-8 flex items-center justify-between">
                                    <div>
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                    </div>
                                    <div>
                                    <button type="submit" class="btn btn-primary w-24">Add</button>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
function role() 
{
$("#role_name").css("border-color", 'unset'); 
}
$(document).ready(function(){
$("#form").submit(function(e) {
var Name = $("#role_name").val();
if (Name == null || Name == "") {
$("#role_name").css("border-color", 'red');
e.preventDefault();
}else{
$("#role_name").css("border-color", 'unset');
}
});
});
</script>