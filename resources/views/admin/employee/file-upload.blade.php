@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Employee Add</title>
@endsection

@section('subcontent')
<div class="flex justify-center">
    <div class="card-body">
        <form action="{{route('employee-list-import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <br>
            <button class="btn btn-success">Import Employee Data</button>
            <a class="btn btn-warning" href="/employee-list-export">Export Employee Data</a>
        </form>
    </div>

</div>
@endsection