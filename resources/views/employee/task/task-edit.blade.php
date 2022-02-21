@extends('../employee/layout/components/' . $layout)

@section('subhead')
    <title>Task Edit</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
    <!-- BEGIN: Form Validation -->
                <div id="form-validation" class="p-5">
                    <div class="preview">
        <!-- BEGIN: Validation Form -->
            <form class="validate-form" action="{{route('task-update')}}" method="post" id="theForm">
                <input  type="hidden" name="id"  value="{{$taskEdit->id}}">
                
                        @csrf
                        <div class="input-form ">
                            <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                                Date
                            </label>
                         <input id="validation-form-1" type="date" class="form-control" placeholder="Date" name="date" value="{{$taskEdit->date}}" required>       
                        </div>
                         <div class="input-form mt-3">
                            <label for="regular-form-2" class="form-label w-full flex flex-col sm:flex-row">
                                Project Name
                            </label>
                            <input id="validation-form-2" type="text" class="form-control" placeholder=" Project Name" name='project_name' value="{{$taskEdit->project_name}}" required>
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                Task Module
                            </label>
                            <input id="regular-form-3" type="text" class="form-control" placeholder="Task Module" name='task_module' value="{{$taskEdit->task_module}}" required>
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                Estimated Hours
                            </label>
                            <input id="regular-form-3" type="text" class="form-control" placeholder=" Estimated Hours" name='estimated_hours' value="{{$taskEdit->estimated_hours}}" required>
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                Worked Hours
                            </label>
                            <input id="regular-form-3" type="text" class="form-control" placeholder="Worked Hours" name='worked_hours' value="{{$taskEdit->worked_hours}}" required>
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Status
                            </label>
                            <input id="regular-form-4" type="text" class="form-control" placeholder="Status" name='status' value="{{$taskEdit->status}}" >
                        </div>
                        
                        <div>
                            <button type="submit" class="btn btn-primary mt-5">Update</button>
                            <button class="btn btn-primary mt-5"><a href="/employee/task-list">Back</a></button>
                        </div>
                     </form>
                    </div>
    <!-- END: Validation Form -->

                    </div>
                </div>
            </div>
            <!-- END: Form Validation -->
        </div>
    </div>

@endsection






