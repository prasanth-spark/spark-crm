@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Role List</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <button class="btn btn-primary shadow-md mr-2"><a href="add-role-form">Add New Role</a></button>
</div>
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
                <a class="btn btn-primary" href={{"roles-permission-list/".$role['id']}}>Edit</a>
                <a class="btn btn-danger" data-toggle="modal" data-target="#delete-confirmation-modal-{{$role->id}}">
                <i data-feather="trash-2" class="w-4 h-3 mr-1"></i> Delete
                </a>
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
                                <div class="px-5 pb-8 text-center">
                                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                    <button type="submit" class="btn btn-danger w-24">Delete</button>
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

@endsection