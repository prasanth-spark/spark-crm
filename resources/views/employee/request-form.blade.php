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

<div class="intro-y grid grid-cols-12 gap-6 mt-5">
    <div class="col-span-12 lg:col-span-12">
            <!-- Attendance card -->
        <div class="grid grid-cols-12">
         <div class="col-span-12 xl:col-span-12 2xl:col-span-12 z-12">
            <div class="intro-y box mt-5">
                    <div class="show box bg-theme-25 text-white flex items-center mb-12">
                        <span>
                            <button class="btn border-transparent bg-theme-25 dark:bg-dark-1">Attendance Detail</button>
                        </span>
                    </div>
            </div>
            <div class="mt-14 mb-3 grid grid-cols-12 sm:gap-10 intro-y">
                <div class="col-span-12 sm:col-span-6 md:col-span-6py-6 sm:pl-5 md:pl-0 lg:pl-5 relative text-center sm:text-left">
                    <div class="text-white text-sm 2xl:text-base font-medium -mb-1">
                          Hi {{$user['name']}} ,
                            <span class="text-theme-34 dark:text-gray-500 font-normal">Welcome!</span>
                            
                    </div>
                    <form action="{{route('leave-status')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="user_id" value="{{$user['id']}}">
                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center text-theme-34 dark:text-gray-500 leading-3 mt-14 2xl:mt-24 font-normal">
                            <p>Why are you availing leave ..?<p>
                            <input type="text" id="reason"  class="form-control text-theme-34 dark:text-gray-500 leading-3 mt-14 2xl:mt-24 font-normal" name ="reason">
                            </div>           
                            <div class="inline-block relative w-64">
                            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8" name="leave_type">Leave Type
                                    <option> ...</option>
                                    <option value="2">Sick Leave</option>
                                    <option value="3">Personal Leave </option>
                            </select>
                        </div>              

                        <div class="text-base 2xl:text-lg justify-center sm:justify-start flex items-center text-theme-34 dark:text-gray-500 leading-3 mt-14 2xl:mt-24 font-normal">
                            <p> Select date from and to you need a leave</p>
                        </div>
                        <div>   
                            <label  class="form-label text-theme-34 mt-2"  >From</label>
                            <input name="start_date" id="start_date" class="datepicker form-control" data-single-mode="true">
                            <label  class="form-label text-theme-34 mt-2">To</label>
                              <input name="end_date" id="end_date" class="datepicker form-control" data-single-mode="true">
                        </div>             
                        <button type="submit">Update</button>
                    </form>
                    <!-- <div class="text-theme-34 mt-5">Update Regularly</div> -->
                </div>
            </div>
         </div> 
    </div>
</div>        


@endsection