@extends('../employee/layout/components/' . $layout)
@section('subhead')
    <title>Dashboard Employee-CRM</title>
@endsection

@section('mobile-menu-modifier')
    mobile-menu--dashboard
@endsection

@section('content-modifier')
    content--dashboard
@endsection

@section('subcontent')
            <!-- Attendance card -->
            <div class="intro-y  mt-5">
                    <div class="show box bg-theme-25 text-white flex items-center mb-4">
                        <span>
                            <button class="btn border-transparent bg-theme-25 dark:bg-dark-1">Leave Detail</button>
                        </span>
                    </div>
            </div>
            <div class="mt-4 mb-4 grid grid-cols-12  intro-y">
                <div class="col-span-12  relative text-center sm:text-left">
                    <div class="text-white text-sm 2xl:text-base font-medium -mb-1">Hi {{$user['name']}} ,
                        <span class="text-theme-34 dark:text-gray-500 font-normal">Welcome!</span>   
                    </div>
                    <form action="{{route('leave-status')}}" method="post">
                      @csrf
                       <input type="hidden" name="id" id="user_id" value="{{$user['id']}}">
                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center text-theme-34 leading-2 mt-4 font-normal">
                                    <p>Why are you availing leave ..?<p>
                         <textarea id="reason" class="form-control text-theme-34  mt-4 font-normal" name ="reason" required></textarea>                       
                        </div>  

                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center  leading-2 mt-4 font-normal">
                            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8" name="leave_type">Leave Type
                                    <option> ...</option>
                                    <option value="2" class="text-theme-34 dark:text-gray-500">Sick Leave</option>
                                    <option value="3" class="text-theme-34 dark:text-gray-500">Personal Leave </option>
                            </select>
                        </div>              
                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center text-theme-34 dark:text-gray-500 leading-3 mt-14 2xl:mt-24 font-normal">
                            <p> Select date from and to you need a leave</p>
                        </div>
                        <div>   
                            <label  class="form-label text-theme-34 mt-2"  >From</label>
                            <input type="text" name="start_date" id="start_date" title="Make sure of your Start date" class="form-control" value ="{{$userLd['start_date']}}" data-single-mode="true">@error('start_date')<span style="color:red">{{$message}}</span>@enderror                     
                            <label  class="form-label text-theme-34 mt-2">To</label>
                              <input name="end_date" id="end_date" type="text" class="form-control" title="Make sure of your End date" value="{{$userLd['end_date']}}" data-single-mode="true">@error('end_date')<span style="color:red">{{$message}}</span>@enderror
                        </div>  

                        <button type="submit" id="submit" class="btn btn-warning w-32 mt-4">
                            <i data-feather="download" class="w-4 h-4 mr-2"></i> Submit
                        </button>   
                    </form>
                    <div class="text-theme-34 mt-5">Update Correctly</div>
                </div>
@endsection