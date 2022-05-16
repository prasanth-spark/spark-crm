@extends('../employee/layout/components/' . $layout)

@section('subhead')
<title>User Profile</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .w-50 {
        width: 50%;
    }
    </style>
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
                                    <input id="Father_name" type="text" class="form-control" value="{{(isset($userdetails->father_name) ? $userdetails->father_name : '') }}" placeholder="Father Name" name='father_name'onchange="myFunction()">
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
                                    <input id="Mother_name" type="text" class="form-control"  value="{{(isset($userdetails->mother_name) ? $userdetails->mother_name : '') }}" placeholder="Mother Name" name='mother_name' onchange="myFunction1()">
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
                                    <input id="Phone_number" type="number" min="0" class="form-control" value="{{(isset($userdetails->father_name) ? $userdetails->phone_number : '') }}" placeholder="Phone Number" name='phone_number'onchange="myFunction2()" >
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
                                    <input id="Emergency_contact_number" type="number" class="form-control" value="{{(isset($userdetails->emergency_contact_number) ? $userdetails->emergency_contact_number : '') }}" placeholder="Emergency Contact Number" name='emergency_contact_number'onchange="myFunction3()" >
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
                                    <input id="Official_email" type="email" class="form-control"  value="{{(isset($userdetails->official_email) ? $userdetails->official_email : '') }}"placeholder="Official Email" name='official_email'onchange="myFunction4()" >
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
                                    <input id="Joined_date" type="date" class="form-control" value="{{(isset($userdetails->joined_date) ? $userdetails->joined_date : '') }}" placeholder="Joined Date" name='joined_date' onchange="myFunction5()" >
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
                                    <input id="Home_address" type="text" class="form-control" value="{{(isset($userdetails->home_address) ? $userdetails->home_address : '') }}" placeholder="Home Address" name='home_address'onchange="myFunction6()" >
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
                                    <input id="Date_of_birth" type="date" class="form-control"  value="{{(isset($userdetails->date_of_birth) ? $userdetails->date_of_birth : '') }}"placeholder="Date of Birth" name='date_of_birth'onchange="myFunction7()" >
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
                                    <input id="Blood_group" type="text" class="form-control" value="{{(isset($userdetails->blood_group) ? $userdetails->blood_group : '') }}" placeholder="Blood Group" name='blood_group'onchange="myFunction8()" >
                                    @error('blood_group')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 Team1">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" id="LabelTeam">Team<span style="color:red">*</span></label>

                                    <select placeholder="Team Name" type="text" class="tom-select w-full" name='team_name' id="Team"  onchange="myFunction10()"> 
                                        <option value="{{(isset($userdetails->teamToUserDetails->id) ? $userdetails->teamToUserDetails->id : '') }}">{{(isset($userdetails->teamToUserDetails->team) ? $userdetails->teamToUserDetails->team : '') }}</option>
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
                                    <input id="Aadhar_number" type="number" class="form-control"  value="{{(isset($userdetails->aadhar_number) ? $userdetails->aadhar_number : '') }}" placeholder=" Aadhar Number" name='aadhar_number' onchange="myFunction9()">
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
                                    <input id="regular-form-4" type="text" class="form-control" value="{{(isset($userdetails->pan_number) ? $userdetails->pan_number : '') }}" placeholder="Pan Number" name='pan_number'>
                                </div>
                            </div>

                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Bank Name</label>

                                    <select placeholder="Bank Name" type="text" class="tom-select w-full" id="regular-form-4" value="{{(isset($userdetails->bank_name) ? $userdetails->bank_name : '') }}" name='bank_name'>
                                        <option value="{{(isset($userdetails->bankNameToEmployee->id) ? $userdetails->bankNameToEmployee->id : '') }}">{{(isset($userdetails->bankNameToEmployee->bank_name) ? $userdetails->bankNameToEmployee->bank_name : '') }}</option>
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
                                    <input id="regular-form-4" type="text" class="form-control" value="{{(isset($userdetails->account_holder_name) ? $userdetails->account_holder_name : '') }}" placeholder="Account Holder Name" name='account_holder_name'>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Account Number<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, integer only </span>
                                    </label>
                                    <input id="regular-form-4" type="number" class="form-control" value="{{(isset($userdetails->account_number) ? $userdetails->account_number : '') }}" placeholder="Account Number" name='account_number'>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        IFSC Code<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, IFSC code </span>
                                    </label>
                                    <input id="regular-form-4" type="text" class="form-control" value="{{(isset($userdetails->ifsc_code) ? $userdetails->ifsc_code : '') }}" placeholder="IFSC Code" name='ifsc_code'>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div>
                                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Account Type</label>

                                    <select placeholder="Account Type" type="text" class="tom-select w-full" id="regular-form-4" value="{{(isset($userdetails->account_type) ? $userdetails->account_type : '') }}" name='account_type'>
                                        <option value="{{(isset($userdetails->accountTypeToEmployee->id) ? $userdetails->accountTypeToEmployee->id : '') }}">"{{(isset($userdetails->accountTypeToEmployee->account_type) ? $userdetails->accountTypeToEmployee->account_type : '') }}"</option>
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
                                    <input id="regular-form-4" type="text" class="form-control" value="{{(isset($userdetails->branch_name) ? $userdetails->branch_name : '') }}" placeholder="Branch Name" name='branch_name'>
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
                    <form action="{{route('user-language-add')}}" method="post">
                        @csrf
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 md:col-span-6">
                                <div id="tab_logic">
                                    <!-- <p for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row" >Language Skills</p><a class="btn btn-success add-more">+ Add More</a>

                                    <select placeholder="Language Skill" type="text" class="tom-select w-full" id="laguage_skill" name='language' multiselect required>
                                        <option value selected="selected" disabled="disabled">Language Skill</option>
                                        @foreach($language as $skill)
                                        <option value="{{$skill->id}}">{{$skill->language}}</option>
                                        @endforeach
                                    </select> -->
                                <p for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row"  name="Language Skills">Language Skills</p>
                                @foreach($language as $skill)
                                <div class="flex gap-4">
                                    <div class="w-50">
                                        <input type="checkbox" id="{{$skill->id}}" name="language[]" value="{{$skill->language}}">
                                        <label for="language-{{$skill->id}}"> {{$skill->language}}</label>
                                    </div>
                                    <div class="w-50">
                                        
                                        <div class="level-{{$skill->id}}" id ="append"></div>
                               
                                    </div>
                                </div>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-6">
                                <div id="tab_logic">
                                <div class="col-span-12 md:col-span-6 more-feilds">
                                <div class="remove-button"></div>

                                
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function myFunction() {
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
    }
$(document).ready(function() {
$("#myForm").submit(function(e)
{
    var FatherName = $("#Father_name").val();
    var MotherName = $("#Mother_name").val();
    var PhoneNo = $("#Phone_number").val();
    var Emergency_contact_number = $("#Emergency_contact_number").val();
    var Official_email = $("#Official_email").val();
    var Joined_date = $("#Joined_date").val();
    var Home_address = $("#Home_address").val();
    var Date_of_birth = $("#Date_of_birth").val();
    var Blood_group = $("#Blood_group").val();
    var Team = $("#Team").val();
    var Aadhar_number = $("#Aadhar_number").val();
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
    
    if(Aadhar_number == null || Aadhar_number == "")
    {
      $("#Aadhar_number").css("border-color",'red');
      e.preventDefault();
    }
    else
    {
      $("#Aadhar_number").css("border-color",'unset');
    }    
});
});


$(document).ready(function() {


    $(":checkbox").on("click", function(){
    if($(this).is(":checked")) {
        var id = $(this).attr('id');
        var level = '<div class="col-span-12 md:col-span-6" id="remove'+id+'"><p for="regular-form-'+id+'" class="form-label w-full flex flex-col sm:flex-row">Level</p> <div class="flex items-center space-x-4"><div class="flex items-center"><input id="regular-form-'+id+'" type="radio"  name="language_level[]-'+id+'" value="1" required><label class="form-check-label text-black" >Beginer</label></div><div class="flex items-center"><input id="regular-form-'+id+'" type="radio"  name="language_level[]-'+id+'" value="2" required><label class="form-check-label text-black" >Intermediate</label></div><div class="flex items-center"><input id="regular-form-'+id+'" type="radio"  name="language_level[]-'+id+'" value="3" required><label class="form-check-label text-black">Advanced</label></div></div></div>';
          $(".level-"+id).append(level);
    } else {
        $("#remove"+id).remove();
    }
});
});

        </script>

