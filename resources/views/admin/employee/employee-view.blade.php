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
                            <div class="input-form ">
                                <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                                    Name
                                </label>
                                <input id="validation-form-1" type="text" class="form-control" placeholder="Name" name="name" value="{{$employeeView->user->name}}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form ">
                                <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                                    Father Name
                                </label>
                                <input id="validation-form-1" type="text" class="form-control" placeholder="Father Name" name="father_name" value="{{$employeeView->father_name}}" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                    Mother Name
                                </label>
                                <input id="regular-form-3" type="text" class="form-control" placeholder="Mother Name" name='mother_name' value="{{$employeeView->mother_name}}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                    Phone Number
                                </label>
                                <input id="regular-form-3" type="number" class="form-control" placeholder="Phone Number" name='phone_number' value="{{$employeeView->phone_number}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                    Emergency Contact Number
                                </label>
                                <input id="regular-form-3" type="number" class="form-control" placeholder="Emergency Contact Number" name='emergency_contact_number' value="{{$employeeView->emergency_contact_number}}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Email
                                </label>
                                <input id="regular-form-4" type="email" class="form-control" placeholder="Email" name='email' value="{{$employeeView->user->email}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Official Email
                                </label>
                                <input id="regular-form-4" type="email" class="form-control" placeholder="Official Email" name='official_email' value="{{$employeeView->official_email}}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Joined Date
                                </label>
                                <input id="regular-form-4" type="date" class="form-control" placeholder="Joined Date" name='joined_date' value="{{$employeeView->joined_date}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Home Address
                                </label>
                                <input id="regular-form-4" type="text" class="form-control" placeholder="Home Address" name='home_address' value="{{$employeeView->home_address}}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Data of Birth
                                </label>
                                <input id="regular-form-4" type="date" class="form-control" placeholder="Data of Birth" name='data_of_birth' value="{{$employeeView->date_of_birth}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Blood Group
                                </label>
                                <input id="regular-form-4" type="text" class="form-control" placeholder="Blood Group" name='blood_group' value="{{$employeeView->blood_group}}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Pan Number
                                </label>
                                <input id="regular-form-4" type="text" class="form-control" placeholder="Pan Number" name='pan_number' value="{{$employeeView->pan_number}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Aadhar Number
                                </label>
                                <input id="regular-form-4" type="number" class="form-control" placeholder=" Aadhar Number" name='aadhar_number' value="{{$employeeView->aadhar_number}}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                    Bank Name
                                </label>
                                <input id="regular-form-3" type="text" class="form-control" name='bank_name' value="{{$employeeView->bankNameToEmployee ? $employeeView->bankNameToEmployee->bank_name : '' }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Account Holder Name
                                </label>
                                <input id="regular-form-4" type="text" class="form-control" placeholder="Account Holder Name" name='account_holder_name' value="{{$employeeView->account_holder_name}}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Account Number
                                </label>
                                <input id="regular-form-4" type="number" class="form-control" placeholder="Account Number" name='account_number' value="{{$employeeView->account_number}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    IFSC Code
                                </label>
                                <input id="regular-form-4" type="text" class="form-control" placeholder="IFSC Code" name='ifsc_code' value="{{$employeeView->ifsc_code}}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                    Branch Name
                                </label>
                                <input id="regular-form-4" type="text" class="form-control" placeholder="Branch Name" name='branch_name' value="{{$employeeView->branch_name}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-form mt-3">
                                <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                    Account Type
                                </label>
                                <input id="regular-form-3" class="form-control" value="{{$employeeView->accountTypeToEmployee ? $employeeView->accountTypeToEmployee->account_type : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">

                            <div class="input-form mt-3">
                                <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                    Role
                                </label>
                                <input id="regular-form-3" class="form-control" value="{{$employeeView->roleToUserDetails ? $employeeView->roleToUserDetails->role : '' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="input-form mt-3">
                        <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                            Team
                        </label>
                        <input id="regular-form-3" class="form-control" value="{{$employeeView->teamToUserDetails ? $employeeView->teamToUserDetails->team : '' }}" readonly>
                    </div>
                    <div>
                        <button class="btn btn-primary mt-5"><a href="/admin/employee-list">Back</a></button>
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