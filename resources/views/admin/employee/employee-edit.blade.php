@extends('../admin/layout/components/' . $layout)

@section('subhead')
<title>Employee Add</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <div class="intro-y box">
            <!-- BEGIN: Form Validation -->
            <div class="p-5">
                <div class="preview">
                    <!-- BEGIN: Validation Form -->
                    <form action="{{route('employee-update')}}" method="post">
                        <input type="hidden" name="id" value="{{$employeeEdit->user->id}}">

                        @csrf
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                                        Name<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                                    </label>
                                    <input id="validation-form-1" type="text" class="form-control" placeholder="Name" name="name" value="{{$employeeEdit->user->name}}">
                                    @error('name')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-2" class="form-label w-full flex flex-col sm:flex-row">
                                        Father Name<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                                    </label>
                                    <input id="validation-form-2" type="text" class="form-control" placeholder="Father Name" name='father_name' value="{{$employeeEdit->father_name}}">
                                    @error('father_name')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                        Mother Name<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                                    </label>
                                    <input id="regular-form-3" type="text" class="form-control" placeholder="Mother Name" name='mother_name' value="{{$employeeEdit->mother_name}}">
                                    @error('mother_name')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                        Phone Number<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 10 characters</span>
                                    </label>
                                    <input id="regular-form-3" type="number" class="form-control" placeholder="Phone Number" name='phone_number' value="{{$employeeEdit->phone_number}}">
                                    @error('phone_number')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                        Emergency Contact Number<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 10 characters</span>
                                    </label>
                                    <input id="regular-form-3" type="number" class="form-control" placeholder="Emergency Contact Number" name='emergency_contact_number' value="{{$employeeEdit->emergency_contact_number}}">
                                    @error('emergency_contact_number')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Email<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, email address format</span>
                                    </label>
                                    <input id="regular-form-4" type="email" class="form-control" placeholder="Email" name='email' value="{{$employeeEdit->user->email}}">
                                    @error('email')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Official Email<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, email address format</span>
                                    </label>
                                    <input id="regular-form-4" type="email" class="form-control" placeholder="Official Email" name='official_email' value="{{$employeeEdit->official_email}}">
                                    @error('official_email')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Joined Date<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, date format</span>
                                    </label>
                                    <input id="regular-form-4" type="date" class="form-control" placeholder="Joined Date" name='joined_date' value="{{$employeeEdit->joined_date}}">
                                    @error('joined_date')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Home Address<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 10 characters</span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="Home Address" name='home_address' value="{{$employeeEdit->home_address}}">
                                    @error('home_address')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Data of Birth<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, date format</span>
                                    </label>
                                    <input id="regular-form-4" type="date" class="form-control" placeholder="Data of Birth" name='date_of_birth' value="{{$employeeEdit->date_of_birth}}">
                                    @error('date_of_birth')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Blood Group<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, blood group</span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="Blood Group" name='blood_group' value="{{$employeeEdit->blood_group}}">
                                    @error('blood_group')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Pan Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, pan number</span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="Pan Number" name='pan_number' value="{{$employeeEdit->pan_number}}">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Aadhar Number<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 12 characters</span>
                                    </label>
                                    <input id="regular-form-4" type="number" class="form-control" placeholder=" Aadhar Number" name='aadhar_number' value="{{$employeeEdit->aadhar_number}}">
                                    @error('aadhar_number')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Bank Name</label>

                                    <select placeholder="Bank Name" type="text" class="tom-select w-full" id="regular-form-4" name='bank_name'>
                                        <option value="{{$employeeEdit->bankNameToEmployee ? $employeeEdit->bankNameToEmployee->id : '' }}">{{$employeeEdit->bankNameToEmployee ? $employeeEdit->bankNameToEmployee->bank_name : '' }}</option>
                                        @foreach($bankName as $c)
                                        <option value="{{$c->id}}">{{$c->bank_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Account Type</label>

                                    <select placeholder="Account Type" type="text" class="tom-select w-full" id="regular-form-4" name='account_type' value="{{$employeeEdit->account_type}}">
                                        <option value="{{$employeeEdit->accountTypeToEmployee ? $employeeEdit->accountTypeToEmployee->id : '' }}">{{$employeeEdit->accountTypeToEmployee ? $employeeEdit->accountTypeToEmployee->account_type:''}}</option>
                                        @foreach($accountType as $c)
                                        <option value="{{$c->id}}">{{$c->account_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Role<span style="color:red">*</span></label>

                                    <select placeholder="Role" type="text" class="tom-select w-full" id="regular-form-4" name='role'>
                                        <option value="{{$employeeEdit->roleToUserDetails->id}}">{{$employeeEdit->roleToUserDetails->role}}</option>
                                        @foreach($role as $r)
                                        <option value="{{$r->id}}">{{$r->role}}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Team<span style="color:red">*</span></label>

                                    <select placeholder="Team Name" type="text" class="tom-select w-full" id="regular-form-4" name='team_name'>
                                        <option value="{{$employeeEdit->teamToUserDetails->id}}">{{$employeeEdit->teamToUserDetails->team}}</option>
                                        @foreach($team as $t)
                                        <option value="{{$t->id}}">{{$t->team}}</option>
                                        @endforeach
                                    </select>
                                    @error('team_name')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Account Holder Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters </span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="Account Holder Name" name='account_holder_name' value="{{$employeeEdit->account_holder_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">

                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Account Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only </span>
                                    </label>
                                    <input id="regular-form-4" type="number" class="form-control" placeholder="Account Number" name='account_number' value="{{$employeeEdit->account_number}}">
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        IFSC Code<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, IFSC code </span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="IFSC Code" name='ifsc_code' value="{{$employeeEdit->ifsc_code}}">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Branch Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, branch name</span>
                            </label>
                            <input id="regular-form-4" type="text" class="form-control" placeholder="Branch Name" name='branch_name' value="{{$employeeEdit->branch_name}}">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-5">Update</button>
                            <button class="btn btn-primary mt-5"><a href="/admin/employee-list">Back</a></button>
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

<script>

</script>
@endsection