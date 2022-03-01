@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Employee Add</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box">
            <!-- BEGIN: Form Validation -->
            <div id="form-validation" class="p-5">
                <div class="preview">
                    <!-- BEGIN: Validation Form -->
                    <div class="input-form ">
                        <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                            Date
                        </label>
                        <input id="validation-form-1" type="text" class="form-control"  value="{{$taskList->date}}">
                    </div>
                    <div class="input-form mt-3">
                        <label for="regular-form-2" class="form-label w-full flex flex-col sm:flex-row">
                            Name
                        </label>
                        <input id="validation-form-2" type="text" class="form-control"   value="{{$taskList->taskToUser->name}}">
                    </div>
                    <div class="input-form mt-3">
                        <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                            Role
                        </label>
                        <input id="regular-form-3" type="text" class="form-control"  value="{{$taskList->taskToUser->roleToUser->role}}">
                    </div>
                    <div class="input-form mt-3">
                        <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                            Team
                        </label>
                        <input id="regular-form-3"  class="form-control"  value="{{$taskList->taskToUserDetails->teamToUserDetails->team}}">
                    </div>
                    <div class="input-form mt-3">
                        <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                            Project Name
                        </label>
                        <input id="regular-form-3"  class="form-control"  value="{{$taskList->project_name}}">
                    </div>
                    <div class="input-form mt-3">
                        <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                            Task Status
                        </label>
                        <input id="regular-form-4" type="email" class="form-control" value="{{($taskList->task_status == 1) ? 'pending' : 'completed';}}">
                    </div>
                    <div class="input-form mt-3">
                        <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                            Task Module
                        </label>
                        <input id="regular-form-4" type="email" class="form-control"  value="{{$taskList->task_module}}">
                    </div>
                    <div class="input-form mt-3">
                        <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                           Estimated Hours
                        </label>
                        <input id="regular-form-4"  class="form-control"  value="{{$taskList->estimated_hours}}">
                    </div>
                    <div class="input-form mt-3">
                        <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                          Worked Hours
                        </label>
                        <input id="regular-form-4" type="text" class="form-control"  value="{{$taskList->worked_hours}}">
                    </div>
                    <div>
                        <button class="btn btn-primary mt-5"><a href="/admin/task-list">Back</a></button>
                    </div>
                </div>
                <!-- END: Validation Form -->
            </div>
        </div>
    </div>
    <!-- END: Form Validation -->
</div>
</div>
@endsection