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
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <div class="intro-y box">
            <!-- BEGIN: Form Validation -->
            <div id="form-validation" class="p-5">
                <div class="preview">
                    <!-- BEGIN: Validation Form -->
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="pb-6">
                                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                        <img alt="Tinker Tailwind HTML Admin Template" class="rounded-full" src="{{url('/')}}/uploads/employee-profile/{{$employeeView->user->photo}}">
                                    </div>
                                    <div class="ml-5">
                                        <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{$employeeView->user->name}}</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="mr-auto">
                                    <p class="font-medium">Name</p>
                                    <div class="text-slate-500 mt-1">{{$employeeView->user->name}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="mr-auto">
                                    <p class="font-medium">Father Name</p>
                                    <div class="text-slate-500 mt-1">{{$employeeView->father_name}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="mr-auto">
                                    <p class="font-medium">Mother Name</p>
                                    <div class="text-slate-500 mt-1">{{$employeeView->mother_name}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="mr-auto">
                                    <p class="font-medium">Phone Number</p>
                                    <div class="text-slate-500 mt-1">{{$employeeView->phone_number}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="mr-auto">
                                    <p class="font-medium">Emergency Contact Number</p>
                                    <div class="text-slate-500 mt-1">{{$employeeView->emergency_contact_number}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="mr-auto">
                                    <p class="font-medium">Email</p>
                                    <div class="text-slate-500 mt-1">{{$employeeView->user->email}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="mr-auto">
                                    <p class="font-medium">Official Email</p>
                                    <div class="text-slate-500 mt-1">{{$employeeView->official_email}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="mr-auto">
                                    <p class="font-medium">Joined Date</p>
                                    <div class="text-slate-500 mt-1">{{$employeeView->joined_date}}</div>
                                </div>
                            </div>
                            <div>
                                <div class="mr-auto">
                                    <p class="font-medium">Home Address</p>
                                    <div class="text-slate-500 mt-1">{{$employeeView->home_address}}</div>
                                </div>
                            </div>
                           
                           
                        </div>
                        <div class="col-span-12 md:col-span-6">
                           
                           <div>
                                <label for="regular-form-3" class="form-label">
                                  Data of Birth:
                                </label>
                                <p class="ml-2">{{$employeeView->date_of_birth }}</p>
                            </div>

                            <div>
                                <label for="regular-form-3" class="form-label">
                                Blood Group:
                                </label>
                                <p class="ml-2">{{$employeeView->blood_group}}</p>
                            </div>


                            <div>
                                <label for="regular-form-3" class="form-label">
                                Pan Number:
                                </label>
                                <p class="ml-2">{{$employeeView->pan_number}}</p>
                            </div>

                            <div>
                                <label for="regular-form-3" class="form-label">
                                Aadhar Number:
                                </label>
                                <p class="ml-2">{{$employeeView->aadhar_number}}</p>
                            </div>
                            <div>
                                <label for="regular-form-3" class="form-label">
                                Role:
                                </label>
                                <p class="ml-2">{{$employeeView->roleToUserDetails->name}}</p>
                            </div>

                            <div>
                                <label for="regular-form-3" class="form-label">
                                Bank Name:
                                </label>
                                <p class="ml-2">{{$employeeView->bankNameToEmployee ? $employeeView->bankNameToEmployee->bank_name : '' }}</p>
                            </div>
                            <div>
                                <label for="regular-form-3" class="form-label">
                                Account Type:
                                </label>
                                <p class="ml-2">{{$employeeView->accountTypeToEmployee ? $employeeView->accountTypeToEmployee->account_type : '' }}</p>
                            </div>
                           
                            <div>
                                <label for="regular-form-3" class="form-label">
                                Desigination:
                                </label>
                                <p class="ml-2">{{$employeeView->designation}}</p>
                            </div>
                            <div>
                                <label for="regular-form-3" class="form-label">
                                Team:
                                </label>
                                <p class="ml-2">{{$employeeView->teamToUserDetails->team}}</p>
                            </div>
                            <div>
                                <label for="regular-form-3" class="form-label">
                                Account Holder Name:
                                </label>
                                <p class="ml-2">{{$employeeView->account_holder_name}}</p>
                            </div>
                            <div>
                                <label for="regular-form-3" class="form-label">
                                Account Number:
                                </label>
                                <p class="ml-2">{{$employeeView->account_number}}</p>
                            </div>
                            <div>
                                <label for="regular-form-3" class="form-label">
                                IFSC Code:
                                </label>
                                <p class="ml-2">{{$employeeView->ifsc_code}}</p>
                            </div>
                            <div>
                                <label for="regular-form-3" class="form-label">
                                Branch Name:
                                </label>
                                <p class="ml-2">{{$employeeView->branch_name}}</p>
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