@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Permission List</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
</div>
<!-- BEGIN: Data List -->
<form action="{{route('add-permission-role')}}" method="post">
@csrf
<div class="grid grid-cols-12 gap-6 mt-5">
<input type="hidden" name="role_id" value="{{$id}}">
@foreach($permissionLists as $permissionList)
<div class="col-span-12 md:col-span-6">
  <input class="form-check-input" type="checkbox" value="{{$permissionList->id}}" name="permission_ids[]" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    {{$permissionList->name}}
  </label>
</div>
@endforeach
</div>
<br>
<div class="grid grid-cols-12 gap-4 lg:gap-6">
<div class="flex gap-2">
<button type="submit" class="btn btn-primary mt-5">Add</button>
 <a href="/admin/employee-role" class="btn btn-primary mt-5">Back</a>
</div>
</div>
</form>
@endsection