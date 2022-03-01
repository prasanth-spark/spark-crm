@extends('../employee/layout/components/' . $layout)

@section('subhead')
    <title>Task View</title>
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
                         <input id="validation-form-1" type="date" class="form-control" placeholder="Date" name="date" value="{{$taskView->date}}">       
                        </div>
                         <div class="input-form mt-3">
                            <label for="regular-form-2" class="form-label w-full flex flex-col sm:flex-row">
                                Project Name
                            </label>
                            <input id="validation-form-2" type="text" class="form-control" placeholder="Project Name" name='project_name' value="{{$taskView->project_name}}" >
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                Task Module
                            </label>
                            <textarea id="regular-form-3" type="text" class="form-control" placeholder="Task Module" name='task_module'>{{$taskView->task_module}}</textarea>
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                Estimated Hours
                            </label>
                            <input id="regular-form-3" type="text" class="form-control" placeholder="Estimated Hours" name='estimated_hours' value="{{$taskView->estimated_hours}}">
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                Worked Hours
                            </label>
                            <input id="regular-form-3" type="text" class="form-control" placeholder="Worked Hours" name='worked_hours' value="{{$taskView->worked_hours}}" >
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Task Status
                            </label>
                            <input id="regular-form-4" type="text" class="form-control" placeholder="Task Status" name='task_status' value="@if($taskView->task_status ==1) pending @else completed @endif" >
                            
                        </div>
                        
                        <div>
                            <button class="btn btn-primary mt-5"><a href="/employee/task-list">Back</a></button>
                        </div>
                    </div>
    <!-- END: Validation Form -->
                    </div>
                </div>
            </div>
            <!-- END: Form Validation -->
        </div>
    </div>

    <script>

        </script>
@endsection






