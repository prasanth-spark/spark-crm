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
                    <form  action="{{route('employee-add')}}" method="post" id="myForm">
                        @csrf
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row" id="LabelName">
                                        Name<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                                    </label>
                                    <input id="Name" type="text" class="form-control" placeholder="Name" name="name" onchange="myFunctionname()">
                                    @error('name')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-2" class="form-label w-full flex flex-col sm:flex-row"id="LabelFather_name">
                                        Father Name<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                                    </label>
                                    <input id="Father_name" type="text" class="form-control" placeholder="Father Name" name="father_name" onchange="myFunction()">
                                    @error('father_name')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row" id="LabelMother_name">
                                        Mother Name<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters</span>
                                    </label>
                                    <input id="Mother_name" type="text" class="form-control" placeholder="Mother Name" name='mother_name' onchange="myFunction1()" >
                                    @error('mother_name')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row" id="LabelPhone_number">
                                        Phone Number<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 10 characters</span>
                                    </label>
                                    <input id="Phone_number" type="number" class="form-control" placeholder="Phone Number" name='phone_number' onchange="myFunction2()" >
                                    @error('phone_number')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-3" class="form-label w-full flex flex-col sm:flex-row" id="LabelEmergency_contact_number">
                                        Emergency Contact Number<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 10 characters</span>
                                    </label>
                                    <input id="Emergency_contact_number" type="number" class="form-control" placeholder="Emergency Contact Number" name='emergency_contact_number'onchange="myFunction3()"  >
                                    @error('emergency_contact_number')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelEmail">
                                        Email <span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, email address format</span>
                                    </label>
                                    <input id="Email" type="email" class="form-control" placeholder="Email" name='email' onchange="myFunction11()" >
                                    @error('email')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelOfficial_email">
                                        Official Email<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, email address format</span>
                                    </label>
                                    <input id="Official_email" type="email" class="form-control" placeholder="Official Email" name='official_email'onchange="myFunction4()" >
                                    @error('official_email')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelJoined_date">
                                        Joined Date<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, date format</span>
                                    </label>
                                    <input id="Joined_date" type="date" class="form-control" placeholder="Joined Date" name='joined_date' onchange="myFunction5()" >
                                    @error('joined_date')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelHome_address">
                                    Home_Address<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required</span>
                                  </label>
                                    <input id="Home_address" type="text" class="form-control" placeholder="Home Address" name="home_address" onchange="myFunction6()">
                                    @error('home_address')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelDate_of_birth">
                                        Data of Birth<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, date format</span>
                                    </label>
                                    <input id="Date_of_birth" type="date" class="form-control" placeholder="Date of Birth" name='date_of_birth'onchange="myFunction7()">
                                    @error('date_of_birth')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelBlood_group">
                                        Blood Group<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, blood group</span>
                                    </label>
                                    <input id="Blood_group" type="text" class="form-control" placeholder="Blood Group" name='blood_group' onchange="myFunction8()" >
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
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="Pan Number" name='pan_number' >
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelTeam">Team<span style="color:red">*</span></label>

                                    <select placeholder="Team Name" type="text" class="tom-select w-full" id="Team" name='team_name'onchange="myFunction10()" >
                                        <option value selected="selected" disabled="disabled"></option>
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
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelRole">Role<span style="color:red">*</span></label>

                                    <select placeholder="Role" type="text" class="tom-select w-full" id="Role" name='role'onchange="myFunction12()"  >
                                        <option value selected="selected" disabled="disabled"></option>
                                        @foreach($role as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
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
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelAadhar_number">
                                        Aadhar Number<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only & maximum 12 characters</span>
                                    </label>
                                    <input id="Aadhar_number" type="number" class="form-control" placeholder=" Aadhar Number" name='aadhar_number' onchange="myFunction9()" >
                                </div>
                                @error('aadhar_number')
                                          <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Bank Name</label>

                                    <select placeholder="Bank Name" type="text" class="tom-select w-full" id="regular-form-4" name='bank_name' >
                                        <option value selected="selected" disabled="disabled"></option>
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
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Account Holder Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, at least 2 characters </span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="Account Holder Name" name='account_holder_name' >
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Account Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only </span>
                                    </label>
                                    <input id="regular-form-4" type="number" class="form-control" placeholder="Account Number" name='account_number' >
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        IFSC Code<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, IFSC code </span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="IFSC Code" name='ifsc_code' >
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Branch Name<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, branch name</span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder="Branch Name" name='branch_name' >
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div >
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelPassword">
                                        Password<span style="color:red">*</span><span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Password</span>
                                    </label>
                                    <input id="Password" type="password" class="form-control" placeholder="Password" name='password' onchange="myFunction13()">
                                    @error('password')
                                          <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Account Type</label>

                                    <select placeholder="Account Type" type="text" class="tom-select w-full" id="regular-form-4" name='account_type'  >
                                        <option value selected="selected" disabled="disabled"></option>
                                        @foreach($accountType as $c)
                                        <option value="{{$c->id}}">{{$c->account_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-5">Add</button>
                            <button class="btn btn-primary mt-5"><a href="/admin/employee-list">Back</a></button>
                        </div>
                    </form>
                </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> 
    function myFunctionname() {
    $("#Name").css("border-color",'unset');
    }function myFunction() {
    $("#Father_name").css("border-color",'unset');
    }function myFunction1() {
    $("#Mother_name").css("border-color",'unset');
    }function myFunction2() {
    $("#Phone_number").css("border-color",'unset');
    }function myFunction3() {
    $("#Emergency_contact_number").css("border-color",'unset');
    }function myFunction4() {
    $("#Official_email").css("border-color",'unset');
    }function myFunction5() {
    $("#Joined_date").css("border-color",'unset');
    }function myFunction6() {
    $("#Home_address").css("border-color",'unset');
    }function myFunction7() {
    $("#Date_of_birth").css("border-color",'unset');
    }function myFunction8() {
    $("#Blood_group").css("border-color",'unset');
    }function myFunction9() {
    $("#Aadhar_number").css("border-color",'unset');
    }function myFunction10() {
    $("#LabelTeam").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
    }function myFunction11() {
    $("#Email").css("border-color",'unset');
    }function myFunction12() {
    $("#LabelRole").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
    }function myFunction13() {
    $("#Password").css("border-color",'unset');
    }

$(document).ready(function() {
$("#myForm").submit(function(e)
{
    var Name = $("#Name").val();
    var FatherName = $("#Father_name").val();
    var MotherName = $("#Mother_name").val();
    var PhoneNo = $("#Phone_number").val();
    var Emergency_contact_number = $("#Emergency_contact_number").val();
    var Email = $("#Email").val();
    var Official_email = $("#Official_email").val();
    var Joined_date = $("#Joined_date").val();
    var Home_address = $("#Home_address").val();
    var Date_of_birth = $("#Date_of_birth").val();
    var Blood_group = $("#Blood_group").val();
    var Team = $("#Team").val();
    var Role = $("#Role").val();
    var Aadhar_number = $("#Aadhar_number").val();
    var Password = $("#Password").val();
    if(Name == null || Name == "")
    {
      $("#Name").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Name").css("border-color",'unset');
    }
    if(FatherName == null || FatherName == "")
    {
      $("#Father_name").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Father_name").css("border-color",'unset');
    } 
     if(MotherName == null || MotherName == "")
    {
      $("#Mother_name").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Mother_name").css("border-color",'unset');
    }
    if(PhoneNo == null || PhoneNo == "")
    {
      $("#Phone_number").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Phone_number").css("border-color",'unset');
    }
    if( Emergency_contact_number == null ||  Emergency_contact_number == "")
    {
      $("#Emergency_contact_number").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Emergency_contact_number").css("border-color",'unset');
    }
    if(Email == null || Email == "")
    {
      $("#Email").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Email").css("border-color",'unset');
    }
    if(Official_email == null || Official_email == "")
    {
      $("#Official_email").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Official_email").css("border-color",'unset');

    }
    if(Joined_date == null || Joined_date == "")
    {
      $("#Joined_date").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Joined_date").css("border-color",'unset');
    }
    if(Home_address == null || Home_address == "")
    {
      $("#Home_address").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Home_address").css("border-color",'unset');
    }

    if(Date_of_birth == null || Date_of_birth == "")
    {
      $("#Date_of_birth").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Date_of_birth").css("border-color",'unset');
    }
    if(Blood_group == null || Blood_group == "")
    {
      $("#Blood_group").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Blood_group").css("border-color",'unset');
    }
    if(Team == null || Team == "")
    {
      $("#LabelTeam").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      e.preventDefault();
    }
    else
    {
     $("#LabelTeam").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
    }
    if(Role == null || Role == "")
    {
      $("#LabelRole").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      e.preventDefault();
    }
    else
    {
      $("#LabelRole").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
    }
    if(Aadhar_number == null || Aadhar_number == "")
    {
      $("#Aadhar_number").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Aadhar_number").css("border-color",'unset');

    }
    if(Password == null || Password == "")
    {
      $("#Password").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Password").css("border-color",'unset');
    }
    
});
});
</script>
@endsection