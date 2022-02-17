@extends('../admin/layout/components/' . $layout)
@section('subhead')
    <title>Employee Add</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
    <!-- BEGIN: Form Validation -->
                <div id="form-validation" class="p-5">
                    <div class="preview">
        <!-- BEGIN: Validation Form -->
            <form class="validate-form" action="{{route('employee-add')}}" method="post" id="theForm">
              @csrf
                   <div class="grid grid-cols-12 gap-6 mt-5">
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                                Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                            </label>
                            <input id="validation-form-1" type="text" class="form-control" placeholder="Name" name="name" required>       
                        </div>
                      </div>
                      <div class="col-span-12 md:col-span-6">
                         <div class="input-form mt-3">
                            <label for="regular-form-2" class="form-label w-full flex flex-col sm:flex-row">
                                Father Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                            </label>
                            <input id="validation-form-2" type="text" class="form-control" placeholder="Father Name" name='father_name' required>
                          </div>
                      </div>
                    </div>    
                   <div class="grid grid-cols-12 gap-6 mt-5">
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                Mother Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                            </label>
                            <input id="regular-form-3" type="text" class="form-control" placeholder="Mother Name" name='mother_name' required>
                        </div>
                      </div>  
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                Phone Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 10 characters</span>
                            </label>
                            <input id="regular-form-3" type="number" class="form-control" placeholder="Phone Number" name='phone_number' required>
                        </div>
                     </div> 
                    </div>    
                   <div class="grid grid-cols-12 gap-6 mt-5">
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                Emergency Contact Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 10 characters</span>
                            </label>
                            <input id="regular-form-3" type="number" class="form-control" placeholder="Emergency Contact Number" name='emergency_contact_number' required>
                        </div>
                      </div> 
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Email<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, email address format</span>
                            </label>
                            <input id="regular-form-4" type="email" class="form-control" placeholder="Email" name='email' required>
                        </div>
                      </div> 
                    </div>    
                   <div class="grid grid-cols-12 gap-6 mt-5">
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Official Email<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, email address format</span>
                            </label>
                            <input id="regular-form-4" type="email" class="form-control" placeholder="Official Email" name='official_email'required >
                        </div>
                      </div>  
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Joined Date<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, date format</span>
                            </label>
                            <input id="regular-form-4" type="date" class="form-control" placeholder="Joined Date" name='joined_date' required>
                         </div>
                      </div>
                   </div>    
                   <div class="grid grid-cols-12 gap-6 mt-5">
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Home Address<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 10 characters</span>
                            </label>
                            <input id="regular-form-4" type="text" class="form-control" placeholder="Home Address" name='home_address' required>
                        </div>
                    </div> 
                    <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Data of Birth<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, date format</span>
                            </label>
                            <input id="regular-form-4" type="date" class="form-control" placeholder="Data of Birth" name='data_of_birth'required >
                        </div>
                     </div>    
                    </div>  
                   <div class="grid grid-cols-12 gap-6 mt-5">
                     <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Blood Group<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, blood group</span>
                            </label>
                            <input id="regular-form-4" type="text" class="form-control" placeholder="Blood Group" name='blood_group' required>
                        </div>
                     </div>  
                     <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Pan Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, pan number</span>
                            </label>
                            <input id="regular-form-4" type="text" class="form-control" placeholder="Pan Number" name='pan_number'required >
                        </div>
                      </div>  
                    </div>  
                   <div class="grid grid-cols-12 gap-6 mt-5">
                     <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Aadhar Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 16 characters</span>
                            </label>
                            <input id="regular-form-4" type="number" class="form-control" placeholder=" Aadhar Number" name='aadhar_number' required>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Bank Name</label>
                            
                               <select placeholder="Bank Name" type="text" class="tom-select w-full" id="regular-form-4" name='bank_name' required>
                               <option value selected="selected" disabled="disabled" ></option>
                                    @foreach($bankName as $c)
                                      <option value="{{$c->id}}">{{$c->bank_name}}</option>
                                    @endforeach
                               </select>
                        </div>
                     </div>  
                    </div>
                    <div class="col-span-12 md:col-span-6">
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Account Holder Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters </span>
                            </label>
                            <input id="regular-form-4" type="text" class="form-control" placeholder="Account Holder Name" name='account_holder_name' required>
                        </div>
                      </div>
                      <div class="col-span-12 md:col-span-6">
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                Account Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only </span>
                            </label>
                            <input id="regular-form-4" type="number" class="form-control" placeholder="Account Number" name='account_number' required>
                        </div>
                     </div>
                    </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                IFSC Code<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, IFSC code </span>
                            </label>
                            <input id="regular-form-4" type="text" class="form-control" placeholder="IFSC Code" name='ifsc_code' required>
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-4"class="form-label w-full flex flex-col sm:flex-row">
                                Branch Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, branch name</span>
                            </label>
                            <input id="regular-form-4" type="text" class="form-control" placeholder="Branch Name" name='branch_name' required>
                        </div>
                        <div class="input-form mt-3">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Account Type</label>
                            
                               <select placeholder="Account Type" type="text" class="tom-select w-full" id="regular-form-4" name='account_type' required>
                               <option value selected="selected" disabled="disabled" ></option>
                                    @foreach($accountType as $c)
                                      <option value="{{$c->id}}" >{{$c->account_type}}</option>
                                    @endforeach
                               </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-5">Add</button>
                            <button class="btn btn-primary mt-5"><a href="/employee-list">Back</a></button>
                        </div>
                     </form>
                    </div>
    <!-- END: Validation Form -->
                        <!-- BEGIN: Success Notification Content -->
                        <div
                            id="success-notification-content"
                            class="toastify-content hidden flex"
                        >
                            <i class="text-theme-20" data-feather="check-circle"></i>
                            <div class="ml-4 mr-4">
                            <div class="font-medium">Registration success!</div>
                            <div class="text-gray-600 mt-1">
                                Please check your e-mail for further info!
                            </div>
                            </div>
                        </div>
                        <!-- END: Success Notification Content -->
                        <!-- BEGIN: Failed Notification Content -->
                        <div
                            id="failed-notification-content"
                            class="toastify-content hidden flex"
                        >
                            <i class="text-theme-21" data-feather="x-circle"></i>
                            <div class="ml-4 mr-4">
                            <div class="font-medium">Registration failed!</div>
                            <div class="text-gray-600 mt-1">
                                Please check the fileld form.
                            </div>
                            </div>
                        </div>
                        <!-- END: Failed Notification Content -->
                    </div>
                </div>
            </div>
            <!-- END: Form Validation -->
        </div>
    </div>

    <script>

        </script>
@endsection






