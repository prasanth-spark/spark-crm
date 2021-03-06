@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Employee Add</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0 mb-3">
        <button class="btn btn-primary shadow-md mr-2"> <a class="flex items-center mr-3" href="{{url('/')}}/admin/employee-edit/{{$employeeView->user->id}}">
                <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit</a>
        </button>
    </div>
</div>
<div class="grid grid-cols-12 gap-4  mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <div class="intro-y box">
            <!-- BEGIN: Form Validation -->
            <div id="form-validation" class="p-5">
                <div class="preview">
                    <!-- BEGIN: Validation Form -->
                    <div class="grid grid-cols-12 gap-4 mt-5">

                        <div class="col-span-12 md:col-span-5">
                            <div class="mr-auto flex items-center  gap-5  my-4">
                                <p class="font-medium w-4/12 w-4/12">Name:</p>
                                <div class="text-slate-500 w-8/12 w-8/12 mt-1">{{$employeeView->user->name}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Father Name:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->father_name}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Mother Name:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->mother_name}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Phone Number:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->phone_number}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Emergency Contact Number:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->emergency_contact_number}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Email:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->user->email}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Official Email:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->official_email}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Joined Date:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{date('d-m-Y', strtotime($employeeView->joined_date))}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Home Address:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->home_address}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12"> Date of Birth:</p>
                                
                                <div class="text-slate-500 w-8/12 mt-1">{{date('d-m-Y', strtotime($employeeView->date_of_birth))}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12"> Certificate Date of Birth:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{date('d-m-Y', strtotime($employeeView->certificate_date_of_birth))}}</div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-5">
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12"> Blood Group:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->blood_group}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Pan Number:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->pan_number}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Aadhar Number:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->aadhar_number}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Role:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->user->roleToUser->name}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Team:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->user->teamToUser->team}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Desigination:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->designation}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Bank Name:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->bankNameToEmployee ? $employeeView->bankNameToEmployee->bank_name : '' }}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Account Type:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->accountTypeToEmployee ? $employeeView->accountTypeToEmployee->account_type : '' }}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Account Holder Name:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->account_holder_name}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Account Number:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->account_number}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">IFSC Code:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->ifsc_code}}</div>
                            </div>
                            <div class="mr-auto flex items-center gap-5 my-4">
                                <p class="font-medium w-4/12">Branch Name:</p>
                                <div class="text-slate-500 w-8/12 mt-1">{{$employeeView->branch_name}}</div>
                            </div>

                        </div>
                        <div class="col-span-2">
                            <div class="flex-1 flex flex-col sm:flex-row items-center pr-5 lg:border-r border-slate-200/60 dark:border-darkmode-400">
                                <div class="sm:mr-5">
                                    <div class="w-20 h-20 image-fit">
                                        <img class="rounded-full" src="{{url('/')}}/uploads/employee-profile/{{$employeeView->user->photo}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="/admin/employee-list" class="btn btn-primary mt-5">Back</a>
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