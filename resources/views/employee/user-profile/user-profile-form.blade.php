@extends('../employee/layout/components/' . $layout)

@section('subhead')
<title>User Profile</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <div class="intro-y box">
            <!-- BEGIN: Form Validation -->
            <div class="p-5">
                <div class="preview">
                    <!-- BEGIN: Validation Form -->
                    <form action="{{route('user-profile-add')}}" method="post" id="myForm">
                        @csrf
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-2" class="form-label w-full flex flex-col sm:flex-row" id="LabelFather_name">
                                        Father Name<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                                    </label>
                                    <input id="Father_name" type="text" class="form-control" value="{{(isset($userdetails->userDetail->father_name) ? $userdetails->userDetail->father_name : '') }}" placeholder="Father Name" name='father_name' onchange="myFunction()">
                                    @error('father_name')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row" id="LabelMother_name">
                                        Mother Name<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                                    </label>
                                    <input id="Mother_name" type="text" class="form-control" value="{{(isset($userdetails->userDetail->mother_name) ? $userdetails->userDetail->mother_name : '') }}" placeholder="Mother Name" name='mother_name' onchange="myFunction1()">
                                    @error('mother_name')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                        Phone Number<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 10 characters</span>
                                    </label>
                                    <input id="Phone_number" type="number" min="0" class="form-control" value="{{(isset($userdetails->userDetail->father_name) ? $userdetails->userDetail->phone_number : '') }}" placeholder="Phone Number" name='phone_number' onchange="myFunction2()">
                                    @error('phone_number')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                        Emergency Contact Number<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 10 characters</span>
                                    </label>
                                    <input id="Emergency_contact_number" type="number" class="form-control" value="{{(isset($userdetails->userDetail->emergency_contact_number) ? $userdetails->userDetail->emergency_contact_number : '') }}" placeholder="Emergency Contact Number" name='emergency_contact_number' onchange="myFunction3()">
                                    @error('emergency_contact_number')
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
                                    <input id="Official_email" type="email" class="form-control" value="{{(isset($userdetails->userDetail->official_email) ? $userdetails->userDetail->official_email : '') }}" placeholder="Official Email" name='official_email' onchange="myFunction4()">
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
                                    <input id="Joined_date" type="date" class="form-control" value="{{(isset($userdetails->userDetail->joined_date) ? $userdetails->userDetail->joined_date : '') }}" placeholder="Joined Date" name='joined_date' onchange="myFunction5()">
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
                                    <input id="Home_address" type="text" class="form-control" value="{{(isset($userdetails->userDetail->home_address) ? $userdetails->userDetail->home_address : '') }}" placeholder="Home Address" name='home_address' onchange="myFunction6()">
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
                                    <input id="Date_of_birth" type="date" class="form-control" value="{{(isset($userdetails->userDetail->date_of_birth) ? $userdetails->userDetail->date_of_birth : '') }}" placeholder="Date of Birth" name='date_of_birth' onchange="myFunction7()">
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
                                    <input id="Blood_group" type="text" class="form-control" value="{{(isset($userdetails->userDetail->blood_group) ? $userdetails->userDetail->blood_group : '') }}" placeholder="Blood Group" name='blood_group' onchange="myFunction8()">
                                    @error('blood_group')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 Team1">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelTeam">Team<span style="color:red">*</span></label>

                                    <select placeholder="Team Name" type="text" class="tom-select w-full" name='team_name' id="Team" onchange="myFunction10()">
                                        <option value="{{(isset($userdetails->teamToUser->id) ? $userdetails->teamToUser->id : '') }}">{{(isset($userdetails->teamToUser->team) ? $userdetails->teamToUser->team : '') }}</option>
                                        @foreach($team as $t)
                                        <option value="{{$t->id}}">{{$t->team}}</option>
                                        @endforeach
                                    </select>
                                    @error('team_name')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Aadhar Number<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 12 characters</span>
                                    </label>
                                    <input id="Aadhar_number" type="number" class="form-control" value="{{(isset($userdetails->userDetail->aadhar_number) ? $userdetails->userDetail->aadhar_number : '') }}" placeholder=" Aadhar Number" name='aadhar_number' onchange="myFunction9()">
                                </div>
                                @error('aadhar_number')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Pan Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, pan number</span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" value="{{(isset($userdetails->userDetail->pan_number) ? $userdetails->userDetail->pan_number : '') }}" placeholder="Pan Number" name='pan_number'>
                                </div>
                            </div>

                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Bank Name</label>

                                    <select placeholder="Bank Name" type="text" class="tom-select w-full" id="regular-form-4" value="{{(isset($userdetails->userDetail->bank_name) ? $userdetails->userDetail->bank_name : '') }}" name='bank_name'>
                                        <option value="{{(isset($userdetails->userDetail->bankNameToEmployee->id) ? $userdetails->userDetail->bankNameToEmployee->id : '') }}">{{(isset($userdetails->userDetail->bankNameToEmployee->bank_name) ? $userdetails->userDetail->bankNameToEmployee->bank_name : '') }}</option>
                                        @foreach($bankName as $c)
                                        <option value="{{$c->id}}">{{$c->bank_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Account Holder Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters </span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" value="{{(isset($userdetails->userDetail->account_holder_name) ? $userdetails->userDetail->account_holder_name : '') }}" placeholder="Account Holder Name" name='account_holder_name'>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Account Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only </span>
                                    </label>
                                    <input id="regular-form-4" type="number" class="form-control" value="{{(isset($userdetails->userDetail->account_number) ? $userdetails->userDetail->account_number : '') }}" placeholder="Account Number" name='account_number'>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        IFSC Code<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, IFSC code </span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" value="{{(isset($userdetails->userDetail->ifsc_code) ? $userdetails->userDetail->ifsc_code : '') }}" placeholder="IFSC Code" name='ifsc_code'>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Account Type</label>

                                    <select placeholder="Account Type" type="text" class="tom-select w-full" id="regular-form-4" value="{{(isset($userdetails->userDetail->account_type) ? $userdetails->userDetail->account_type : '') }}" name='account_type'>
                                        <option value="{{(isset($userdetails->userDetail->accountTypeToEmployee->id) ? $userdetails->userDetail->accountTypeToEmployee->id : '') }}">"{{(isset($userdetails->userDetail->accountTypeToEmployee->account_type) ? $userdetails->userDetail->accountTypeToEmployee->account_type : '') }}"</option>
                                        @foreach($accountType as $c)
                                        <option value="{{$c->id}}">{{$c->account_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Branch Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, branch name</span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" value="{{(isset($userdetails->userDetail->branch_name) ? $userdetails->userDetail->branch_name : '') }}" placeholder="Branch Name" name='branch_name'>
                                </div>
                            </div>

                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-5">Add</button>
                            <a href="/employee/employee_dashboard" class="btn btn-primary mt-5">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <!-- BEGIN: Form Validation -->
                    <div class="p-5">
                        <div class="preview">
                            <!-- BEGIN: Validation Form -->
                            <form action="{{route('user-language-add')}}" method="post" id="Form">
                                @csrf
                                <div class="grid grid-cols-12 gap-6 mt-5">
                                    <div class="col-span-12 md:col-span-6">
                                        <div id="tab_logic" class="flex justify-between">
                                            <p for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row"  id="Language">Language Skills</p>
                                            <a class="btn btn-success w-40 mb-4 add-more">+ Add More</a>
                                        </div>
                                        <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row"></label>
                                    <select placeholder="Language Skill" type="text" class="tom-select w-full" id="Language-Skill" name='language[]'>
                                        <option value selected="selected" disabled="disabled">Language Skill</option>
                                        @foreach($language as $skill)
                                        <option value="{{$skill->id}}">{{$skill->language}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="col-span-12 md:col-span-6">
                                        <p for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="Levels">
                                            Level
                                        </p>
                                        <div class="flex items-center space-x-4">

                                         <div class="form-check form-check-inline" >
                                            <input class="form-check-input" style="display:none" type="radio" name='language_level[0]' id="level" value="0">
                                          </div>

                                         <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name='language_level[0]'  value="1">
                                            <label class="form-check-label text-black">Beginer</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name='language_level[0]' value="2">
                                            <label class="form-check-label text-black">Intermediate</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name='language_level[0]' value="3">
                                            <label class="form-check-label text-black">Advanced</label>
                                        </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-6 mt-5">
                                    <div class="col-span-12 md:col-span-6">
                                        <div class="more-field">

                                        </div>
                                    </div>

                                    <div class="col-span-12 md:col-span-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="levela">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary mt-5">Add</button>
                                    <a href="/employee/employee_dashboard" class="btn btn-primary mt-5">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    <script type="text/javascript" src="{{URL::asset('dist/js/jquery.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            var id = 0;
            $(".add-more").click(function() {
                id++;
                var language = '<div id="tab_logic"><p for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" >Language Skills</p><select placeholder="Language Skill" type="text" class="tom-select w-full" id="laguage_skill" name="language[]" required><option value selected="selected" disabled="disabled"></option><?php foreach ($language as $skill) { ?><option value="{{$skill->id}}">{{$skill->language}}</option><?php } ?></select></div></div>';
                var languageLevel = '<div class="flex items-center space-x-4 level"><input id="regular-form-4" type="radio" name="language_level[' + id + ']" value="1"><label class="form-check-label text-black">Beginer</label><input id="regular-form-4" type="radio" name="language_level[' + id + ']" value="2"><label class="form-check-label text-black">Intermediate</label><input id="regular-form-4" type="radio" name="language_level[' + id + ']" value="3"><label class="form-check-label text-black">Advanced</label></div></div>';

                $(".more-field").append(language);
                $(".levela").append(languageLevel);

            });
            $("body").on("click", ".remove", function() {
                $(this).parents("#tab_logic").remove();
            });
            $("#Form").submit(function(e)
             {
            var Language = $("#Language-Skill").val();
            if(Language == null || Language == "")
                {
                $("#Language").css({
                'font-family': 'ArvoBold',
                'color': 'red',
                'font-size': '120%'
                 });
                e.preventDefault();
               }        
                if($('input[type=radio][name="language_level[0]"]:checked').length == 0)
                {
               $("#Levels").css({
                'font-family': 'ArvoBold',
                'color': 'red',
                'font-size': '120%'
                });
                e.preventDefault();          
                }   
             });
             $('select').on('change', function() {
                $("#Language").css({
                'font-family': 'unset',
                'color': 'unset',
                'font-size': 'unset'
                 });
            });
            $('input[type=radio][name="language_level[0]"]').on('change', function() {
                $("#Levels").css({
                'font-family': 'unset',
                'color': 'unset',
                'font-size': 'unset'
                 });
            });
        });

    </script>