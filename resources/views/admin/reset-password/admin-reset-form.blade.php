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
                    <form action="{{route('admin-change-password')}}" method="post">
                        @csrf
                        <div class="intro-x mt-8"> 
                            <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Current Password" name="current_password" autocomplete="current-password">
                            @error('current_password')
                                 <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="intro-x mt-8"> 
                            <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="New Password" name="new_password" autocomplete="current-password">
                            @error('new_password')
                                 <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="intro-x mt-8"> 
                            <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="New Confirm Password" name="new_confirm_password" autocomplete="current-password">
                            @error('new_confirm_password')
                                 <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-4 align-top"> Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection