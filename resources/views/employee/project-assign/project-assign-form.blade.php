@extends('../employee/layout/components/' . $layout)

@section('subhead')
<title>Add Project</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <div class="intro-y box">
            <!-- BEGIN: Form Validation -->
            <div class="p-5">
                <div class="preview">
                    <!-- BEGIN: Validation Form -->
                    <form action="{{route('add-project-form')}}" method="post">
                        @csrf
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-2" class="form-label w-full flex flex-col sm:flex-row">
                                        Title<span style="color:red">*</span>
                                    </label>
                                    <input id="validation-form-2" type="text" class="form-control"  placeholder="Title" name='title' required>
                                    @error('title')
                                    <span style="color:red">{{$message}}</span>              
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                        Description<span style="color:red">*</span>
                                    </label>
                                    <input id="regular-form-3" type="text" class="form-control"   placeholder="Description" name='description' required>
                                    @error('description')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                           <div class="col-span-12 md:col-span-12">
                           <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Team</label>

                                    <select placeholder="Team" type="text" class="tom-select w-full" id="regular-form-4" name='team_id' >
                                        <option value selected="selected" disabled="disabled"></option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-5">Add</button>
                            <button class="btn btn-primary mt-5"><a href="/employee/project-list">Back</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection


 


